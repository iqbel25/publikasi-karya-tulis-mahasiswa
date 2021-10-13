<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == '1') {
            $semuaDosen = Dosen::with('user')->latest()->paginate(10);
        }elseif (auth()->user()->level == '2') {
            $prodi = Prodi::with('user')->where('id_prodi', auth()->user()->id)->first();
            $semuaDosen = Dosen::with('user')->where('prodi', $prodi->prodi)->latest()->paginate(10);
        }
        return view('admin.dosen.index', compact('semuaDosen'));
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
                'name'  => ['required', 'string', 'max:100'],
                'nidn'  => ['required', 'numeric', 'min:10|max:12', 'unique:tbl_dosen'],
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

        $foto->storeAs('public/uploads/dosen/', $fileName);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => '3',
        ])->id;

        $dosen = Dosen::create([
            'id_dosen'      => $user,
            'nidn'          => $request->nidn,
            'nama'          => $request->name,
            'prodi'         => $request->prodi,
            'jenis_kelamin' => $request->jk,
            'no_hp'         => $request->hp,
            'foto'          => $fileName
        ]);

        if ($dosen) {
            // redirect dengan pesan sukses
            return redirect()->route('dosen.index')->with('success', 'Dosen Berhasil Di Tambahkan');
        } else {
            // redirect dengan pesan error
            return redirect()->route('dosen.index')->with('error', 'Dosen Gagal Di Tambahkan');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dosen = Dosen::with('user')->findOrFail($id);
        echo json_encode($dosen);
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
        $dosen = Dosen::with('user')->findOrFail($id);
        $this->validate(
            $request,
            [
                'name'  => ['required', 'string', 'max:100'],
                'nidn'  => ['required', 'numeric', 'min:10|max:12', 'unique:tbl_dosen,nidn,' . $dosen->id],
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
                    'regex:/(.*)@ft-umt\.ac\.id/i', 'unique:users,email,' . $dosen->user->id
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
            return redirect()->route('dosen.index')->with('success', 'Dosen Berhasil Di Ubah');
        } else {
            // redirect dengan pesan error
            return redirect()->route('dosen.index')->with('error', 'Dosen Gagal Di Ubah');
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
        $user  = User::findOrFail($id);
        $dosen = Dosen::where('id_dosen', $id)->first();
        // dd($dosen->foto);
        File::delete(public_path('storage/uploads/dosen/' . $dosen->foto));
        $user->delete();

        if ($user) {
            // redirect dengan pesan sukses
            return redirect()->route('dosen.index')->with('success', 'Dosen Berhasil Di Hapus');
        } else {
            // redirect dengan pesan error
            return redirect()->route('dosen.index')->with('error', 'Dosen Gagal Di Hapus');
        }
    }
}
