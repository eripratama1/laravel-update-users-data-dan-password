<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function editProfile()
    {
        return view('update-profile');
    }

    public function updateProfile(Request $request)
    {
        $userImage = User::findOrFail(auth()->user()->id);

        if ($request->hasFile('image')) {
            if (File::exists('imageProfile/' . $userImage->image)) {
                File::delete('imageProfile/' . $userImage->image);
            }
            $file = $request->file('image');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('imageProfile/', $uploadFile);
            $userImage->image = $uploadFile;
        }

        $userImage->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        // return dd($user);
        return to_route('edit-profile');
    }
    
    public function updatePassword(Request $request)
    {
        $request->user()->update([
            'password' => bcrypt($request->input('new_password'))
        ]);
        return to_route('edit-profile');
    }
}
