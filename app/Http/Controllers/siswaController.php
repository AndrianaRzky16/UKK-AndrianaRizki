<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Spp;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class siswaController extends Controller
{

    // public function json()
    // {
    //     return DataTable::of(Siswa::all())->make(true);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('siswa')
            ->join('spp', 'spp.id_spp', '=', 'siswa.id_spp')
            ->join('kelas', 'kelas.id', '=', 'siswa.id_kelas')
            ->get();
        // $data = Siswa::latest()->paginate(30);
        // $kelas = Kelas::all();
        // $spp = Spp::all();
        // $pembayaran = Pembayaran::all();
        // dd($data)
        return view('admin.siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('admin.siswa.create', compact('kelas', 'spp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $nisn = Siswa::where('nisn', $request->nisn)->get();

        if (sizeof($nisn) == 1) {
            return redirect()->back()->with('error', 'Siswa dengan NISN : ' . $request['nisn'] . ' sudah ada sebelumnya.');
        }

        Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'id_spp' => $request->id_spp,
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->nis . '@gmail.com',
            'level' => 'siswa',
            'nisn' => $request->nisn,
            'password' => Hash::make($request->nis),
        ]);
        if ($request) {
            return redirect()->route('siswa.index')->with('success', 'data berhasil masuk');
        } else {
            return redirect()->back()->with('error', 'data gagal masuk');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $bulan = DB::table('siswa')
            ->where('pembayaran.nisn', $siswa->nisn)
            ->join('pembayaran', 'siswa.nisn', '=', 'pembayaran.nisn')
            ->get();

        $membayar = Pembayaran::where('nisn', $siswa->nisn)->count();
        // dd($membayar);


        return view('admin.siswa.show', compact('siswa', 'bulan', 'membayar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($siswa)
    {
        $kelas = Kelas::all();
        $s = Spp::all();
        $siswa = siswa::where('nisn', '=', $siswa)->first();
        return view('admin.siswa.edit', compact('siswa', 'kelas', 's'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $nisn)
    {
        $user = User::where('name', $nisn->nama)->first();
        // dd($user);
        $request->validate([
            'nisn' => 'required | string',
            'nis' => 'required | string',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'id_spp' => 'required',
        ]);

        $user->update([
            'name' => $request->nama,
            'email' => $request->nis . '@gmail.com',
            'level' => 'siswa',
            'password' => Hash::make($request->nis),
        ]);

        $nisn->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'id_spp' => $request->id_spp,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($siswa)
    {
        // $a=Siswa::where('nisn', $siswa);
        // $a->delete();
        Siswa::where('nisn', $siswa)->delete();
        User::where('id', $siswa)->delete();
        return redirect()->route('siswa.index');
    }
}
