<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class pembayaranExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pembayaran::join('siswa', 'siswa.nisn', '=', 'pembayaran.nisn')
            ->join('spp', 'spp.id_spp', '=', 'siswa.id_spp')
            ->select('nama', 'tgl_bayar', 'bulan_dibayar', 'tahun_dibayar', 'jumlah_bayar')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama', 'Tanggal Bayar', 'Bulan Dibayar', 'Tahun Dibayar', 'Jumlah Bayar'
        ];
    }

    public function view(): View
    {
        if (auth()->user()->level == 'siswa') {
            $pembayaranAll = Pembayaran::where('email', '=', auth()->user()->email)->get();
        } else {
            $pembayaranAll = Pembayaran::all();
        }
        return view('pembayaran.excel.export', [
            'pembayaranAll' => $pembayaranAll,
        ]);
    }
}
