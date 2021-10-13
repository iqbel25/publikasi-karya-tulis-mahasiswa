<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) :
            return asset($this->avatar);
        else :
            return 'https://ui-avatars.com/api/?name=' . str_replace(
                ' ',
                '+',
                $this->name
            ) . '&background=4e73df&color=ffffff&size=100';
        endif;
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function skripsi()
    {
        return $this->hasMany(Skripsi::class);
    }

    public function kkp()
    {
        return $this->hasMany(Kkp::class);
    }

    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }
}
