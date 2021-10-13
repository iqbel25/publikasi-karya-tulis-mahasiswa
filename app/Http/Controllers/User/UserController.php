<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kkp;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Skripsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;
use File;

class UserController extends Controller
{
    public function index()
    {
        $skripsi = Skripsi::with('user')->when(
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
        )->where('status', 'Diterima')->get();

        $kkp     = Kkp::with('user')->when(
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
        )->where('status', 'Diterima')->get();

        $allRepository = $skripsi->merge($kkp);

        return view('user.index', compact('allRepository'));
    }

    public function profileAdmin()
    {
        return view('user.profile.admin.index');
    }

    public function updateProfileAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate(
            $request,
            [
                'name'  => ['required', 'string', 'max:100'],
                'password' => 'confirmed',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'regex:/(.*)@ft-umt\.ac\.id/i', 'unique:users,email,' . $user->id
                ],
            ]
        );

        if ($request->password == "") {
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
        } else {
            $user->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        if ($user) {
            // redirect dengan pesan sukses
            return redirect()->route('profile.admin')->with('success', 'Profile Berhasil Di Ubah');
        } else {
            // redirect dengan pesan error
            return redirect()->route('profile.admin')->with('error', 'Profile Gagal Di Ubah');
        }
    }

    public function profileProdi()
    {
        $prodi = Prodi::where('id_prodi', auth()->user()->id)->firstOrFail();
        return view('user.profile.prodi.index', compact('prodi'));
    }

    public function editProfileProdi($id)
    {
        $prodi = Prodi::where('id_prodi', $id)->firstOrfail();
        echo json_encode($prodi);
    }

    public function updateProfileProdi(Request $request, $id)
    {
        $prodi = Prodi::with('user')->where('id_prodi',$id)->firstOrFail();
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
            return redirect()->route('profile.prodi')->with('success', 'Profile Berhasil Di Ubah');
        } else {
            // redirect dengan pesan error
            return redirect()->route('profile.prodi')->with('error', 'Profile Gagal Di Ubah');
        }
    }

    public function profileDosen()
    {
        $dosen = Dosen::where('id_dosen', auth()->user()->id)->firstOrFail();
        return view('user.profile.dosen.index', compact('dosen'));
    }

    public function editProfileDosen($id)
    {
        $dosen = Dosen::where('id_dosen', $id)->firstOrfail();
        echo json_encode($dosen);
    }

    public function updateProfileDosen(Request $request, $id)
    {
        $dosen = Dosen::with('user')->where('id_dosen',$id)->firstOrFail();
        $this->validate(
            $request,
            [
                'name'  => ['required', 'string', 'max:100'],
                'nidn'  => ['required', 'numeric', 'min:10|max:12', 'unique:tbl_dosen,nidn,'.$dosen->id],
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
                    'regex:/(.*)@ft-umt\.ac\.id/i', 'unique:users,email,'.$dosen->user->id
                ],
            ]
        );

        $fileName = $dosen->foto;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $fileName = \Str::slug($request->name) . time() . '.' . $foto->getClientOriginalExtension();

            File::delete((public_path('storage/uploads/dosen/' . $dosen->foto)));

            $foto->storeAs('public/uploads/dosen/', $fileName);
        }

        if ($request->password == "") {
            $user = User::findOrFail($dosen->id_dosen);
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            $dosen->update([
                'nidn'          => $request->nidn,
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jk,
                'no_hp'         => $request->hp,
                'foto'          => $fileName
            ]);
        } else {
            $user = User::findOrFail($dosen->id_dosen);
            $user->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $dosen->update([
                'nidn'          => $request->nidn,
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jk,
                'no_hp'         => $request->hp,
                'foto'          => $fileName
            ]);
        }

        if ($dosen) {
            // redirect dengan pesan sukses
            return redirect()->route('profile.dosen')->with('success', 'Profile Berhasil Di Ubah');
        } else {
            // redirect dengan pesan error
            return redirect()->route('profile.dosen')->with('error', 'Profile Gagal Di Ubah');
        }
    }

    public function profileMahasiswa()
    {
        $mahasiswa = Mahasiswa::where('id_mahasiswa', auth()->user()->id)->firstOrFail();
        return view('user.profile.mahasiswa.index', compact('mahasiswa'));
    }

    public function editProfileMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::where('id_mahasiswa', $id)->firstOrfail();
        echo json_encode($mahasiswa);
    }

    public function updateProfileMahasiswa(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::with('user')->where('id_mahasiswa',$id)->firstOrFail();
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
                'nim'           => $request->nim,
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
                'nim'           => $request->nim,
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jk,
                'no_hp'         => $request->hp,
                'foto'          => $fileName
            ]);
        }

        if ($mahasiswa) {
            // redirect dengan pesan sukses
            return redirect()->route('profile.mahasiswa')->with('success', 'Profile Berhasil Di Ubah');
        } else {
            // redirect dengan pesan error
            return redirect()->route('profile.mahasiswa')->with('error', 'Profile Gagal Di Ubah');
        }
    }
}
