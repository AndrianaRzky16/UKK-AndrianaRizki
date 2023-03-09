<?php

namespace App\Http\Controllers;

use App\Models\petugas;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class petugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = petugas::orderBy('created_at', 'DESC')->get();
        return view('admin.petugas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        petugas::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'nama_petugas' => $request['nama_petugas'],
            'password' => Hash::make($request['username']),
            'level' => $request['level'],
        ]);

        User::create([
            'name' => $request->username,
            'email' => $request->email . '@gmail.com',
            'level' => $request->level,
            'password' => Hash::make($request->username),
        ]);
        return redirect('/employ')->with('sukses', 'Akun Berhasil Ditambahkan !');
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
    public function edit(Petugas $id)
    {
        return view('admin.petugas.edit', compact('id'));
    }


    public function update(Request $request, Petugas $petugas)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama_petugas' => 'required',
            'level' => 'required'
        ]);
        $petugas = Petugas::where('id', $petugas)->update([
            'username' => $request->username,
            'password' => $request->password,
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level
        ]);
        return redirect()->route('admin.petugas.index')->with('success', 'Berhasil Diupdate');
    }
    /**
     * Remove the specified resource from storage.
     *
     *  @param  \App\Models\Petugas  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(petugas $id)
    {
        $id->delete();

        return redirect('employ')->with('sukses', 'Akun Berhasil Dihapus !');
    }
}
