<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Exports\PembayaranExport;
use App\Models\petugas;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    public function index()
    {
        $data = DB::table('pembayaran')
            ->join('siswa', 'siswa.nisn', '=', 'pembayaran.nisn')
            ->join('spp', 'spp.id_spp', '=', 'pembayaran.id_spp')
            ->join('petugas', 'petugas.id', '=', 'pembayaran.id_petugas')
            ->get();
        if (auth()->user()->role == 'admin' or auth()->user()->role == 'petugas') {
            $pembayaran = Pembayaran::all();
        } else {
            $user = auth()->user()->id;
            $siswa = Siswa::where('nis', $user)->pluck('nisn');
            $pem = Pembayaran::where('nisn', $siswa)->get();
        }

        return View('admin.history.index', compact('pem'));
    }

    public function indexx()
    {
        $siswa = Siswa::all();
        // $petugas = petugas::all();
        $pembayaran = Pembayaran::all();
        return view('admin.history.indexx', compact('pembayaran', 'siswa'));
    }

    public function export_excel()
    {
        return Excel::download(new PembayaranExport, 'spp.xlsx');
    }
}
