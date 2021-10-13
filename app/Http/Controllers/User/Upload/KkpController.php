<?php

namespace App\Http\Controllers\User\Upload;

use App\Http\Controllers\Controller;
use App\Models\Kkp;
use Illuminate\Http\Request;
use File;

class KkpController extends Controller
{
    public function index()
    {
        $kkp = Kkp::where('id_kkp', auth()->user()->id)->first();
        return view('user.uploads.kkp.index', compact('kkp'));
    }

    public function edit($id)
    {
        $kkp = Kkp::findOrFail($id);
        echo json_encode($kkp);
    }

    public function update(Request $request, $id)
    {
        $kkp = Kkp::findOrFail($id);

        $this->validate(
            $request,
            [
                'nama_penulis' => 'required|string',
                'judul'        => 'required|string',
                'tahun_lulus'  => 'required|',
                'prodi'        => 'required|string',
                'abstrak'      => 'required|string',
                'bab1'         => 'mimes:pdf|max:5120',
                'bab2'         => 'mimes:pdf|max:5120',
                'bab3'         => 'mimes:pdf|max:5120',
                'bab4'         => 'mimes:pdf|max:5120',
                'bab5'         => 'mimes:pdf|max:5120',
            ]
        );

        $fileNameBab1 = $kkp->bab1;
        $fileNameBab2 = $kkp->bab2;
        $fileNameBab3 = $kkp->bab3;
        $fileNameBab4 = $kkp->bab4;
        $fileNameBab5 = $kkp->bab5;

        if ($request->hasFile('bab1')) {
            $fileBab1 = $request->file('bab1');

            $fileNameBab1 = \Str::slug('bab1 kkp') . time() . '.' . $fileBab1->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/kkp/' . $kkp->bab1));
            File::delete(public_path('storage/uploads/repository/' . $kkp->bab1));

            $fileBab1->storeAs('public/uploads/kkp/', $fileNameBab1);
            $fileBab1->storeAs('public/uploads/repository/', $fileNameBab1);
        }

        if ($request->hasFile('bab2')) {
            $fileBab2 = $request->file('bab2');

            $fileNameBab2 = \Str::slug('bab2 kkp') . time() . '.' . $fileBab2->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/kkp/' . $kkp->bab2));

            $fileBab2->storeAs('public/uploads/kkp/', $fileNameBab2);
        }

        if ($request->hasFile('bab3')) {
            $fileBab3 = $request->file('bab3');

            $fileNameBab3 = \Str::slug('bab3 kkp') . time() . '.' . $fileBab3->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/kkp/' . $kkp->bab3));

            $fileBab3->storeAs('public/uploads/kkp/', $fileNameBab3);
        }

        if ($request->hasFile('bab4')) {
            $fileBab4 = $request->file('bab4');

            $fileNameBab4 = \Str::slug('bab4 kkp') . time() . '.' . $fileBab4->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/kkp/' . $kkp->bab4));

            $fileBab4->storeAs('public/uploads/kkp/', $fileNameBab4);
        }

        if ($request->hasFile('bab5')) {
            $fileBab5 = $request->file('bab5');

            $fileNameBab5 = \Str::slug('bab5 kkp') . time() . '.' . $fileBab5->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/kkp/' . $kkp->bab5));

            $fileBab5->storeAs('public/uploads/kkp/', $fileNameBab5);
        }

        $kkp->update([
            'nama_penulis' => $request->nama_penulis,
            'judul'        => $request->judul,
            'tahun_lulus'  => $request->tahun_lulus,
            'prodi'        => $request->prodi,
            'abstrak'      => $request->abstrak,
            'status'        => 'Menunggu',
            'bab1'         => $fileNameBab1,
            'bab2'         => $fileNameBab2,
            'bab3'         => $fileNameBab3,
            'bab4'         => $fileNameBab4,
            'bab5'         => $fileNameBab5,
        ]);

        if ($kkp) {
            // redirect dengan pesan sukses
            return redirect()->route('upload.kkp')->with('success', 'Kkp Berhasil Di Update');
        } else {
            // redirect dengan pesan error
            return redirect()->route('upload.kkp')->with('error', 'Kkp Gagal Di Update');
        }
    }
}
