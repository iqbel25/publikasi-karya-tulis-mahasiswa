<?php

namespace App\Http\Controllers\User\Koleksi;

use App\Http\Controllers\Controller;
use App\Models\Kkp;
use Illuminate\Http\Request;

class KkpController extends Controller
{
    public function index()
    {
        $semuaKkp = Kkp::with('user')->when(
            request()->q,
            function ($kkp) {
                $kkp->where('judul', 'like', '%' . request()->q . '%');
            }
        )->when(
            request()->t,
            function ($kkp) {
                $kkp->where('tahun_lulus', 'like', '%' . request()->t . '%');
            }
        )->when(
            request()->p,
            function ($kkp) {
                $kkp->where('prodi', 'like', '%' . request()->p . '%');
            }
        )->where('status', 'Diterima')->paginate(10);

        return view('user.koleksi.kkp', compact('semuaKkp'));
    }
}
