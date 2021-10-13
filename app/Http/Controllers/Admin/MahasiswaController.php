<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class MahasiswaController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == '1') {
            $semuaMahasiswa = Mahasiswa::with('user')->latest()->paginate(10);
        }elseif (auth()->user()->level == '2') {
            $prodi = Prodi::with('user')->where('id_prodi', auth()->user()->id)->first();
            $semuaMahasiswa = Mahasiswa::with('user')->where('prodi', $prodi->prodi)->latest()->paginate(10);
        }

        return view('admin.mahasiswa.index', compact('semuaMahasiswa'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'  => ['required', 'string', 'max:100'],
                'nim'   => ['required', 'numeric', 'min:10|max:12', 'unique:tbl_mahasiswa'],
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

        $foto->storeAs('public/uploads/mahasiswa/', $fileName);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => '4',
        ])->id;

        $mahasiswa = Mahasiswa::create([
            'id_mahasiswa'  => $user,
            'nim'           => $request->nim,
            'nama'          => $request->name,
            'prodi'         => $request->prodi,
            'jenis_kelamin' => $request->jk,
            'no_hp'         => $request->hp,
            'foto'          => $fileName
        ]);

        if ($mahasiswa) {
            // redirect dengan pesan sukses
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Di Tambahkan');
        } else {
            // redirect dengan pesan error
            return redirect()->route('mahasiswa.index')->with('error', 'Mahasiswa Gagal Di Tambahkan');
        }
    }

    public function edit($id) {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        echo json_encode($mahasiswa);
    }

    public function update(Request $request, $id) {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        $this->validate(
            $request,
            [
                'name'  => ['required', 'string', 'max:100'],
                'nim'  => ['required', 'numeric', 'min:10|max:12', 'unique:tbl_mahasiswa,nim,'.$mahasiswa->id],
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
                    'regex:/(.*)@ft-umt\.ac\.id/i', 'unique:users,email,'.$mahasiswa->user->id
                ],
            ]
        );

        $fileName = $mahasiswa->foto;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $fileName = \Str::slug($request->name) . time() . '.' . $foto->getClientOriginalExtension();

            File::delete((public_path('storage/uploads/mahasiswa/' . $mahasiswa->foto)));

            $foto->storeAs('public/uploads/mahasiswa/', $fileName);
        }

        if ($request->password == "") {
            $user = User::findOrFail($mahasiswa->id_mahasiswa);
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            $mahasiswa->update([
                'nim'          => $request->nim,
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jk,
                'no_hp'         => $request->hp,
                'foto'          => $fileName
            ]);
        } else {
            $user = User::findOrFail($mahasiswa->id_mahasiswa);
            $user->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $mahasiswa->update([
                'nim'          => $request->nim,
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jk,
                'no_hp'         => $request->hp,
                'foto'          => $fileName
            ]);
        }

        if ($mahasiswa) {
            // redirect dengan pesan sukses
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Di Ubah');
        } else {
            // redirect dengan pesan error
            return redirect()->route('mahasiswa.index')->with('error', 'Mahasiswa Gagal Di Ubah');
        }
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $mahasiswa = Mahasiswa::where('id_mahasiswa', $id)->first();
        File::delete(public_path('storage/uploads/mahasiswa/' . $mahasiswa->foto));
        $user->delete();

        if ($user) {
            // redirect dengan pesan sukses
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Di Hapus');
        } else {
            // redirect dengan pesan error
            return redirect()->route('mahasiswa.index')->with('error', 'Mahasiswa Gagal Di Hapus');
        }
    }
}
