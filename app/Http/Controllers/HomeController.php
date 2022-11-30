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
        /**
         * Memuat view update profile yang mana 
         * pada view tersebut kita memiliki 2 form 
         * 1. Untuk update data users
         * 2. Untuk update password 
         */
        return view('update-profile');
    }

    public function updateProfile(Request $request)
    {
        /**
         * Untuk method ini jika user menambahkan inputan berupa gambar
         * lakukan proses pengecekan apakah user tersebut sudah menyimpan
         * gambar sebelumnya. Jika ada hapus gambar tersebut dan ganti
         * dengan file gambar yang baru.
         * 
         * Disini proses validasi bisa ditambahkan menggunakan method validate()
         * atau menggunakan form request.
         * sesuaikan dengan keperluan masing-masing
         * 
         */
        
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

        /**
         * Menjalankan proses update table users
         */
        $userImage->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
       
        return to_route('edit-profile');
    }
    
    public function updatePassword(Request $request)
    {
        /**
         * Pada method ini kita menjalankan proses update password
         * dengan helper bcrypt kita melakukan proses enkripsi data password
         * yang di inputkan pada properti input dengan name-nya new_password
         * 
         * Silahkan tambahkan validasi sesuai keperluan masing-masing. 
         */
        $request->user()->update([
            'password' => bcrypt($request->input('new_password'))
        ]);
        return to_route('edit-profile');
    }
}
