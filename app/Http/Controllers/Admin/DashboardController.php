<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kkp;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 1) {
            $jumlahSkripsi     = Skripsi::count();
            $jumlahKkp         = Kkp::count();
            $jumlahProdi       = Prodi::count();
            $jumlahDosen       = Dosen::count();
            $jumlahMahasiswa   = Mahasiswa::count();
        } elseif (auth()->user()->level == 2) {
            $jumlahProdi       = Prodi::with('user')->where('id_prodi', auth()->user()->id)->first();
            $jumlahSkripsi     = Skripsi::where('prodi', $jumlahProdi->prodi)->count();
            $jumlahKkp         = Kkp::where('prodi', $jumlahProdi->prodi)->count();
            $jumlahDosen       = Dosen::where('prodi', $jumlahProdi->prodi)->count();
            $jumlahMahasiswa   = Mahasiswa::where('prodi', $jumlahProdi->prodi)->count();
        }
        return view('admin.index', compact('jumlahSkripsi', 'jumlahKkp', 'jumlahProdi', 'jumlahDosen', 'jumlahMahasiswa'));
    }
}
