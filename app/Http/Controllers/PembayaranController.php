<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Models\Pembayaran;
use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
// use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use PDF;

class PembayaranController extends Controller
{

    public function index()
    {
        $data = Pembayaran::latest()->paginate(30);
        $kelas = petugas::all();
        $spp = Spp::all();
        return view('admin.Pembayaran.index', compact('data', 'kelas', 'spp'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $spp = Spp::all();
        return view('admin.pembayaran.create', compact('siswa', 'spp'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric',
        ]);


        // dd($request->bayar_berapa);
        for ($i = 0; $i < $request->bayar_berapa; $i++) {
            $idPetugas = Petugas::where('email', '=', auth()->user()->email)->first();
            $bulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

            $siswa = Siswa::where('nisn', '=', $request->nisn)->first();
            $spp = Spp::where('id_spp', '=', $siswa->id_spp)->first();
            $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)->get();

            if ($pembayaran->isEmpty()) {
                $bln = 6;
                $tahun = substr($spp->tahun, 0, 4);
            } else {
                $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)
                    ->orderBy('id_pembayaran', 'Desc')->latest()
                    ->first();

                $bln = array_search($pembayaran->bulan_dibayar, $bulan);

                if ($bln == 11) {
                    $bln = 0;
                    $tahun = $pembayaran->tahun_dibayar + 1;
                } else {
                    $bln = $bln + 1;
                    $tahun = $pembayaran->tahun_dibayar;
                }

                if ($pembayaran->tahun_dibayar == substr($spp->tahun, -4, 4) && $pembayaran->bulan_dibayar == 'mei') {
                    return back()->with('error', 'sudah lunas');
                }
            }

            if ($request->jumlah_bayar < $spp->nominal) {
                return back()->with('tjumlah_bayar', 'Uang yang dimasukan tidak sesuai');
            }

            $pembayaranSimpan = Pembayaran::create([
                'id_petugas' => Auth::user()->id,
                'nisn' => $request->nisn,
                'tgl_bayar' => Carbon::now()->timezone('asia/jakarta'),
                'bulan_dibayar' => $bulan[$bln],
                'tahun_dibayar' => $tahun,
                'id_spp' => $spp->id_spp,
                'jumlah_bayar' => $request->jumlah_bayar
            ]);
        }

        if ($pembayaranSimpan) {
            return redirect()->route('pembayaran.index')->with('success', 'data berhasil masuk');
        } else {
            return redirect()->back()->with('error', 'data gagal masuk');
        }
    }

    public function edit(Pembayaran $pembayaran)
    {
        $siswa = Siswa::all();
        return view('admin.pembayaran.edit', compact('pembayaran', 'siswa'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $this->validate($request, [
            'nisn' => 'required|numeric',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required',
            // 'jumlah_bayar' => 'required|numeric',
        ]);

        $data = $request->all();

        $pembayaranUpdate = $pembayaran->update($data);

        if ($pembayaranUpdate) {
            return redirect()->route('pembayaran.index')->with('success', 'data berhasil diedit');
        } else {
            return redirect()->back()->with('error', 'data gagal diedit');
        }
    }

    public function export_excel()
    {
        return Excel::download(new PembayaranExport, 'spp.xlsx');
    }

    public function show(Pembayaran $pembayaran)
    {
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaranHapus = $pembayaran->delete();

        if ($pembayaranHapus) {
            return redirect()->route('pembayaran.index')->with('success', 'data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'data gagal dihapus');
        }
    }

    public function excelExport()
    {
        return $this->download(new PembayaranExport, 'users.xlsx');
    }

    public function generatePDF($nisn)
    {
        $data = Pembayaran::where('nisn', '=', $nisn)->first();
        // dd($data);
        $siswa = Siswa::where('nisn', '=', $nisn)->first();
        // dd($siswa);
        $spp = Spp::where('id_spp', '=', $siswa->id_spp)->first();
        // dd($spp);
        $invoice = Pembayaran::where('created_at', '=', $data->created_at)->get();
        // dd($invoice);
        $pdf = PDF::loadview('myPDF', compact('data', 'siswa', 'spp', 'invoice'));
        // dd($pdf);
        return $pdf->download('struk.pdf');
        // return view('myPDF', compact('data', 'siswa', 'invoice', 'spp'));
        // if ($pdf) {
        //     return redirect()->route('pembayaran.index')->with('success', 'data berhasil masuk');
        // } else {
        //     return redirect()->back()->with('error', 'gagal');
        // }
    }

    public function riwayat()
    {

        if (Auth::user()->level == 'admin' or Auth::user()->level == 'petugas') {
            $pembayaran = Pembayaran::orderBy('created_at', 'DESC')->get();
        } elseif (Auth::user()->level == 'siswa') {
            $pembayaran = Pembayaran::orderBy('created_at', 'DESC')->where('nama', Auth::user()->name)->get();
        }

        return view('laporan.index', compact('pembayaran'));
    }

    public function getData($nisn, $berapa)
    {
        // dd($nisn);
        $siswa = Siswa::where('nisn', '=', $nisn)->first();
        $spp = Spp::where('id_spp', '=', $siswa->id_spp)->first();
        $pembayaran = Pembayaran::where('nisn', '=', $nisn)
            ->orderBy('id_pembayaran', 'Desc')->latest()
            ->first();


        if ($pembayaran == null) {
            $data = [
                'nominal' => $spp->nominal * $berapa,
                'bulan' => 'belum pernah bayar',
                'tahun' => '',
            ];
        } else {

            if ($pembayaran->tahun_dibayar == substr($spp->tahun, -4, 4) && $pembayaran->bulan_dibayar == 'juni') {
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => 'sudah lunas',
                    'tahun' => '',
                ];
            } else {
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => $pembayaran->bulan_dibayar,
                    'tahun' => $pembayaran->tahun_dibayar,
                ];
            }
        }

        return response()->json($data);
    }

    public function history()
    {
        $data = DB::table('pembayaran')
            ->join('siswa', 'siswa.nisn', '=', 'pembayaran.nisn')
            ->join('spp', 'spp.id_spp', '=', 'pembayaran.id_spp')
            ->join('petugas', 'petugas.id', '=', 'pembayaran.id_petugas')
            ->get();
        if (auth()->user()->level == 'siswa') {
            $siswa = Siswa::where('email', '=', auth()->user()->email)->first();
            $historyAll = Pembayaran::where('nisn', '=', $siswa->nisn)->get();
        } else {
            $historyAll = Pembayaran::all();
        }

        return view('pembayaran.history', compact('historyAll'));
    }
}
