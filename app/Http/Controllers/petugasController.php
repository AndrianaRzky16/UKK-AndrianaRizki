<?php

namespace App\Http\Controllers;

use App\Models\petugas;
use App\Models\User;
use App\Models\Siswa;
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
    public function edit($id)
    {
        return view('admin.petugas.edit', compact('id'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(petugas $id)
    {
        $id->delete();

        return redirect('employ')->with('sukses', 'Akun Berhasil Dihapus !');
    }
}
