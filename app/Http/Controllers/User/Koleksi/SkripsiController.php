<?php

namespace App\Http\Controllers\User\Koleksi;

use App\Http\Controllers\Controller;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class SkripsiController extends Controller
{
    public function index()
    {
        $semuaSkripsi = Skripsi::with('user')->when(
            request()->q,
            function ($skripsi) {
                $skripsi->where('judul', 'like', '%' . request()->q . '%');
            }
        )->when(
            request()->t,
            function ($skripsi) {
                $skripsi->where('tahun_lulus', 'like', '%' . request()->t . '%');
            }
        )->when(
            request()->p,
            function ($skripsi) {
                $skripsi->where('prodi', 'like', '%' . request()->p . '%');
            }
        )->where('status', 'Diterima')->paginate(10);

        return view('user.koleksi.skripsi', compact('semuaSkripsi'));
    }
}
