<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'tbl_prodi';
    protected $fillable = [
        'id_prodi', 'nidn', 'nama', 'prodi', 'jenis_kelamin', 'no_hp', 'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_prodi');
    }
}
