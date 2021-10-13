<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'tbl_mahasiswa';
    protected $fillable = [
        'id_mahasiswa', 'nim', 'nama', 'prodi', 'jenis_kelamin', 'no_hp', 'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }
}
