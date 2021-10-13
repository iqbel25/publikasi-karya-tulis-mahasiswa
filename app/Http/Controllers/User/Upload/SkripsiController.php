<?php

namespace App\Http\Controllers\User\Upload;

use App\Http\Controllers\Controller;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use File;

class SkripsiController extends Controller
{
    public function index()
    {
        $skripsi = Skripsi::where('id_skripsi', auth()->user()->id)->first();
        return view('user.uploads.skripsi.index', compact('skripsi'));
    }

    public function edit($id)
    {
        $skripsi = Skripsi::findOrFail($id);
        echo json_encode($skripsi);
    }

    public function update(Request $request, $id)
    {
        $skripsi = Skripsi::findOrFail($id);

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

        $fileNameBab1 = $skripsi->bab1;
        $fileNameBab2 = $skripsi->bab2;
        $fileNameBab3 = $skripsi->bab3;
        $fileNameBab4 = $skripsi->bab4;
        $fileNameBab5 = $skripsi->bab5;

        if ($request->hasFile('bab1')) {
            $fileBab1 = $request->file('bab1');

            $fileNameBab1 = \Str::slug('bab1 skripsi') . time() . '.' . $fileBab1->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/skripsi/' . $skripsi->bab1));
            File::delete(public_path('storage/uploads/repository/' . $skripsi->bab1));

            $fileBab1->storeAs('public/uploads/skripsi/', $fileNameBab1);
            $fileBab1->storeAs('public/uploads/repository/', $fileNameBab1);
        }

        if ($request->hasFile('bab2')) {
            $fileBab2 = $request->file('bab2');

            $fileNameBab2 = \Str::slug('bab2 skripsi') . time() . '.' . $fileBab2->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/skripsi/' . $skripsi->bab2));

            $fileBab2->storeAs('public/uploads/skripsi/', $fileNameBab2);
        }

        if ($request->hasFile('bab3')) {
            $fileBab3 = $request->file('bab3');

            $fileNameBab3 = \Str::slug('bab3 skripsi') . time() . '.' . $fileBab3->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/skripsi/' . $skripsi->bab3));

            $fileBab3->storeAs('public/uploads/skripsi/', $fileNameBab3);
        }

        if ($request->hasFile('bab4')) {
            $fileBab4 = $request->file('bab4');

            $fileNameBab4 = \Str::slug('bab4 skripsi') . time() . '.' . $fileBab4->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/skripsi/' . $skripsi->bab4));

            $fileBab4->storeAs('public/uploads/skripsi/', $fileNameBab4);
        }

        if ($request->hasFile('bab5')) {
            $fileBab5 = $request->file('bab5');

            $fileNameBab5 = \Str::slug('bab5 skripsi') . time() . '.' . $fileBab5->getClientOriginalExtension();

            File::delete(public_path('storage/uploads/skripsi/' . $skripsi->bab5));

            $fileBab5->storeAs('public/uploads/skripsi/', $fileNameBab5);
        }

        $skripsi->update([
            'nama_penulis' => $request->nama_penulis,
            'judul'        => $request->judul,
            'tahun_lulus'  => $request->tahun_lulus,
            'prodi'        => $request->prodi,
            'abstrak'      => $request->abstrak,
            'status'       => 'Menunggu',
            'bab1'         => $fileNameBab1,
            'bab2'         => $fileNameBab2,
            'bab3'         => $fileNameBab3,
            'bab4'         => $fileNameBab4,
            'bab5'         => $fileNameBab5,
        ]);

        if ($skripsi) {
            // redirect dengan pesan sukses
            return redirect()->route('upload.skripsi')->with('success', 'Skripsi Berhasil Di Update');
        } else {
            // redirect dengan pesan error
            return redirect()->route('upload.skripsi')->with('error', 'Skripsi Gagal Di Update');
        }
    }
}
