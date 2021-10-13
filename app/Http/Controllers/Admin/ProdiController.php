<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class ProdiController extends Controller
{
    public function index()
    {
        $semuaProdi = Prodi::with('user')->latest()->paginate(10);
        // dd($semuaProdi);

        return view('admin.prodi.index', compact('semuaProdi'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'  => ['required', 'string', 'max:100'],
                'nidn'  => ['required', 'numeric', 'min:10|max:12', 'unique:tbl_prodi'],
                'prodi' => ['required', 'string'],
                'jk'    => ['required', 'string'],
                'hp'    => ['required', 'numeric', 'min:10'],
                'foto'  => 'required|mimes:jpg,jpeg,png|max:2400',
                'password' => 'required|confirmed',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'regex:/(.*)@ft-umt\.ac\.id/i', 'unique:users'
                ],
            ]
        );

        $foto = $request->file('foto');

        $fileName = \Str::slug($request->name) . time() . '.' . $foto->getClientOriginalExtension();

        $foto->storeAs('public/uploads/prodi/', $fileName);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => '2',
        ])->id;

        $prodi = Prodi::create([
            'id_prodi'      => $user,
            'nidn'          => $request->nidn,
            'nama'          => $request->name,
            'prodi'         => $request->prodi,
            'jenis_kelamin' => $request->jk,
            'no_hp'         => $request->hp,
            'foto'          => $fileName
        ]);

        if ($prodi) {
            // redirect dengan pesan sukses
            return redirect()->route('prodi.index')->with('success', 'Prodi Berhasil Di Tambahkan');
        } else {
            // redirect dengan pesan error
            return redirect()->route('prodi.index')->with('error', 'Prodi Gagal Di Tambahkan');
        }
    }

    public function edit($id)
    {
        $prodi = Prodi::with('user')->findOrFail($id);
        echo json_encode($prodi);
    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::with('user')->findOrFail($id);
        $this->validate(
            $request,
            [
                'name'  => ['required', 'string', 'max:100'],
                'nidn'  => ['required', 'numeric', 'min:10|max:12', 'unique:tbl_prodi,nidn,'.$prodi->id],
                'prodi' => ['required', 'string'],
                'jk'    => ['required', 'string'],
                'hp'    => ['required', 'numeric', 'min:10'],
                'foto'  => 'mimes:jpg,jpeg,png|max:2400',
                'password' => 'confirmed',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'regex:/(.*)@ft-umt\.ac\.id/i', 'unique:users,email,'.$prodi->user->id
                ],
            ]
        );

        $fileName = $prodi->foto;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $fileName = \Str::slug($request->name) . time() . '.' . $foto->getClientOriginalExtension();

            File::delete((public_path('storage/uploads/prodi/' . $prodi->foto)));

            $foto->storeAs('public/uploads/prodi/', $fileName);
        }

        if ($request->password == "") {
            $user = User::findOrFail($prodi->id_prodi);
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            $prodi->update([
                'nidn'          => $request->nidn,
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jk,
                'no_hp'         => $request->hp,
                'foto'          => $fileName
            ]);
        } else {
            $user = User::findOrFail($prodi->id_prodi);
            $user->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $prodi->update([
                'nidn'          => $request->nidn,
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jk,
                'no_hp'         => $request->hp,
                'foto'          => $fileName
            ]);
        }

        if ($prodi) {
            // redirect dengan pesan sukses
            return redirect()->route('prodi.index')->with('success', 'Prodi Berhasil Di Ubah');
        } else {
            // redirect dengan pesan error
            return redirect()->route('prodi.index')->with('error', 'Prodi Gagal Di Ubah');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $prodi = Prodi::where('id_prodi', $id)->first();
        File::delete(public_path('storage/uploads/prodi/' . $prodi->foto));
        $user->delete();

        if ($user) {
            // redirect dengan pesan sukses
            return redirect()->route('prodi.index')->with('success', 'Prodi Berhasil Di Hapus');
        } else {
            // redirect dengan pesan error
            return redirect()->route('prodi.index')->with('error', 'Prodi Gagal Di Hapus');
        }
    }
}
