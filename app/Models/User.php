<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image', /** Menambahkan field baru pada method fillable */
    ];

    /**
     * Membuat accessor getImage
     * Ketika user memiliki gambar tampilkan gambar yang tersimpan pada 
     * folder imageProfile. Jika user tidak menyimpan gambar muat gambar template
     * dari url yang sudah di definisikan seperti dibawah.
     */
    public function getImage()
    {
        if (substr($this->image,0,5) == "https") {
            return $this->image;
        }

        if ($this->image) {
            return asset('imageProfile/'.$this->image);
        }

        return 'https://ui-avatars.com/api/?name=' . str_replace(
            ' ',
            '+',
            $this->name
        ) . '&background=4e73df&color=ffffff&size=100';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
