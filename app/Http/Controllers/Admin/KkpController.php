<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kkp;
use App\Models\Prodi;
use Illuminate\Http\Request;
use File;

class KkpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == 1) {
            $semuaKkp = Kkp::latest()->paginate(10);
        } elseif (auth()->user()->level == 2) {
            $prodi        = Prodi::with('user')->where('id_prodi', auth()->user()->id)->first();
            $semuaKkp     = Kkp::where('prodi', $prodi->prodi)->latest()->paginate(10);
        }
        return view('admin.kkp.index', compact('semuaKkp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama_penulis' => 'required|string',
                'judul'        => 'required|string',
                'tahun_lulus'  => 'required|numeric',
                'prodi'        => 'required|string',
                'abstrak'      => 'required|string',
                'bab1'         => 'required|mimes:pdf|max:5120',
                'bab2'         => 'required|mimes:pdf|max:5120',
                'bab3'         => 'required|mimes:pdf|max:5120',
                'bab4'         => 'required|mimes:pdf|max:5120',
                'bab5'         => 'required|mimes:pdf|max:5120',
            ]
        );

        $bab1 = $request->file('bab1');
        $bab2 = $request->file('bab2');
        $bab3 = $request->file('bab3');
        $bab4 = $request->file('bab4');
        $bab5 = $request->file('bab5');

        $bab1Name = \Str::slug('bab1 kkp') . time() . '.' . $bab1->getClientOriginalExtension();
        $bab2Name = \Str::slug('bab2 kkp') . time() . '.' . $bab2->getClientOriginalExtension();
        $bab3Name = \Str::slug('bab3 kkp') . time() . '.' . $bab3->getClientOriginalExtension();
        $bab4Name = \Str::slug('bab4 kkp') . time() . '.' . $bab4->getClientOriginalExtension();
        $bab5Name = \Str::slug('bab5 kkp') . time() . '.' . $bab5->getClientOriginalExtension();

        $bab1->storeAs('public/uploads/repository/', $bab1Name);
        $bab1->storeAs('public/uploads/kkp/', $bab1Name);
        $bab2->storeAs('public/uploads/kkp/', $bab2Name);
        $bab3->storeAs('public/uploads/kkp/', $bab3Name);
        $bab4->storeAs('public/uploads/kkp/', $bab4Name);
        $bab5->storeAs('public/uploads/kkp/', $bab5Name);

        $kkp = Kkp::create([
            'id_kkp'       => auth()->user()->id,
            'nama_penulis' => $request->nama_penulis,
            'judul'        => $request->judul,
            'tahun_lulus'  => $request->tahun_lulus,
            'prodi'        => $request->prodi,
            'abstrak'      => $request->abstrak,
            'bab1'         => $bab1Name,
            'bab2'         => $bab2Name,
            'bab3'         => $bab3Name,
            'bab4'         => $bab4Name,
            'bab5'         => $bab5Name,
        ]);

        if (auth()->user()->level == '4') {
            if ($kkp) {
                // redirect dengan pesan sukses
                return redirect()->route('upload.kkp')->with('success', 'Kkp Berhasil Di Tambahkan');
            } else {
                // redirect dengan pesan error
                return redirect()->route('upload.kkp')->with('error', 'Kkp Gagal Di Tambahkan');
            }
        } else {
            if ($kkp) {
                // redirect dengan pesan sukses
                return redirect()->route('kkp.index')->with('success', 'Kkp Berhasil Di Tambahkan');
            } else {
                // redirect dengan pesan error
                return redirect()->route('kkp.index')->with('error', 'Kkp Gagal Di Tambahkan');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kkp = Kkp::findOrFail($id);
        echo json_encode($kkp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kkp = Kkp::findOrFail($id);
        echo json_encode($kkp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

            $fileBab1->storeAs('public/uploads/kkp/', $fileNameBab1);
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
            'bab1'         => $fileNameBab1,
            'bab2'         => $fileNameBab2,
            'bab3'         => $fileNameBab3,
            'bab4'         => $fileNameBab4,
            'bab5'         => $fileNameBab5,
        ]);

        if ($kkp) {
            // redirect dengan pesan sukses
            return redirect()->route('kkp.index')->with('success', 'Kkp Berhasil Di Update');
        } else {
            // redirect dengan pesan error
            return redirect()->route('kkp.index')->with('error', 'Kkp Gagal Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kkp = Kkp::findOrFail($id);
        File::delete(public_path('storage/uploads/repository/' . $kkp->bab1));
        File::delete(public_path('storage/uploads/kkp/' . $kkp->bab1));
        File::delete(public_path('storage/uploads/kkp/' . $kkp->bab2));
        File::delete(public_path('storage/uploads/kkp/' . $kkp->bab3));
        File::delete(public_path('storage/uploads/kkp/' . $kkp->bab4));
        File::delete(public_path('storage/uploads/kkp/' . $kkp->bab5));
        $kkp->delete();

        if ($kkp) {
            // redirect dengan pesan sukses
            return redirect()->route('kkp.index')->with('success', 'Kkp Berhasil Di Hapus');
        } else {
            // redirect dengan pesan error
            return redirect()->route('kkp.index')->with('error', 'Kkp Gagal Di Hapus');
        }
    }

    public function accept(Request $request, $id)
    {
        $kkp = Kkp::findOrFail($id);

        $kkp->update([
            'status' => 'Diterima',
        ]);

        if ($kkp) {
            // redirect dengan pesan sukses
            return redirect()->route('kkp.index')->with('success', 'Kkp Berhasil Di Accept');
        } else {
            // redirect dengan pesan error
            return redirect()->route('kkp.index')->with('error', 'Kkp Gagal Di Accept');
        }
    }

    public function reject(Request $request, $id)
    {
        $kkp = Kkp::findOrFail($id);

        $kkp->update([
            'status' => 'Ditolak',
        ]);

        if ($kkp) {
            // redirect dengan pesan sukses
            return redirect()->route('kkp.index')->with('success', 'Kkp Berhasil Di Tolak');
        } else {
            // redirect dengan pesan error
            return redirect()->route('kkp.index')->with('error', 'Kkp Gagal Di Tolak');
        }
    }
}
