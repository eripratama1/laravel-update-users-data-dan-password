@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Update Profile</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <h2>Update Profile</h2>
                            <div class="col-md-4">
                                {{-- 
                                    Akses method auth()->user() dan accessor getImage()
                                    Untuk memuat file gambar dari tabel users
                                --}}
                                <img src="{{ auth()->user()->getImage() }}" style="width:100%" class="img-fluid" alt="">
                            </div>

                            <div class="col-md-8">
                                <form action="{{ route('update-profile',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                    {{-- 
                                        tag form yang pertama ini akan di arahkan ke route update-profile 
                                        ketika button submit diklik untuk melakukan proses update data.

                                        Route method yang digunakan PATCH.
                                    --}}
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group mb-3">
                                        <label for="">Name</label>
                                        {{-- Menggunakan method auth()->user() untuk menampilkan value dari 
                                             field yang ada pada tabel users 
                                        --}}
                                        <input type="text" value="{{ auth()->user()->name }}" name="name" class="form-control" id="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="{{ auth()->user()->email }}" class="form-control" id="">
                                    </div>
            
                                    <div class="form-group mb-3">
                                        <label for="">Foto Profile</label>
                                        <input type="file" name="image" class="form-control" id="">
                                    </div>
            
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <hr>
                        <h2>Update Password</h2>
                        <form action="{{ route('update-password') }}" method="POST">
                            {{-- 
                                Tag form kedua ini akan di arahkan ke route update-password  
                                untuk melakukan proses update password.
                                
                                Method yang digunakan sama seperti update profile diatas
                                yaiut PATCH.
                            --}}
                            @csrf
                            @method('PATCH')
                            <div class="form-group mb-3">
                                <label for="">Password Baru</label>
                                <input type="password" name="new_password" class="form-control" id="">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirm" class="form-control" id="">
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">Update Password</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
