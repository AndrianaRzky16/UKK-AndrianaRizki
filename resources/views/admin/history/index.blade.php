@extends('layouts.app')
@section('content')
    <div class="table">
        <table class="table table-hover" id="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Bayar</th>
                    <th scope="col">Bulan Dibayar</th>
                    <th scope="col">Tahun Dibayar</th>
                    <th scope="col">Tahun Masuk</th>
                    <th scope="col">Jumlah Bayar</th>
                    {{-- <th scope="col">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $p)
                    <tr>
                        {{-- <td>{{$p->id_pembayaran}}</td> --}}
                        {{-- <td>{{ $p->petugas->nama_petugas }}</td> --}}
                        <td>{{ $p->siswa->nama }}</td>
                        <td>{{ $p->tgl_bayar }}</td>
                        <td>{{ $p->bulan_dibayar }}</td>
                        <td>{{ $p->tahun_dibayar }}</td>
                        <td>{{ $p->spp->tahun_masuk }}</td>
                        <td>{{ $p->jumlah_bayar }}</td>
                    </tr>
                @endforeach
            </tbody>
            {{-- <td> <a href="" class="btn btn-success" target="_blank">Export</a></td> --}}

        </table>

        <script>
            $(document).ready(function() {
                $('#table_id').DataTable();
            });
        </script>
    @endsection
