<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'tbl_dosen';
    protected $fillable = [
        'id_dosen', 'nidn', 'nama', 'prodi', 'jenis_kelamin', 'no_hp', 'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_dosen');
    }
}
