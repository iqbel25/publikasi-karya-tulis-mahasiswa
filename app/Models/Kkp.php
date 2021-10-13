<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kkp extends Model
{
    use HasFactory;

    protected $table = 'tbl_kkp';
    protected $fillable = [
        'id_kkp', 'nama_penulis', 'judul', 'tahun_lulus', 'prodi', 'abstrak', 'bab1', 'bab2', 'bab3', 'bab4', 'bab5', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_kkp');
    }
}
