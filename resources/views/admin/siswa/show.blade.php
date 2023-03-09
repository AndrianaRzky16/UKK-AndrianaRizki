@extends('layouts.app')

@section('activePembayaran')
    active
@endsection
@php $i = 0; @endphp
@section('content')
    <div class="card p-4" onclick="window.print()">
        <div class="container">
            <div class="siswa justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card" style="width: 18rem;">
                                            {{-- <div class="d-flex align-content-stretch flex-wrap"> --}}
                                        </div>
                                        <!-- Modal -->
                                        <h3 class="col d-flex justify-content-center"> Detail Pembayaran Siswa</h3>
                                        <div class="card-body">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">NISN</th>
                                                    <th>: {{ $siswa->nisn }}</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">NIS</th>
                                                    <th>: {{ $siswa->nis }}</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Nama Siswa</th>
                                                    <th>: {{ $siswa->nama }}</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Kelas</th>
                                                    <th>: {{ $siswa->kelas->nama_kelas }}</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Alamat</th>
                                                    <th>: {{ $siswa->alamat }}</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Nomor Telepon
                                                    </th>
                                                    <th>: {{ $siswa->no_telpon }}</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Spp</th>
                                                    <th>: {{ $siswa->spp->nominal }}</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Bulan Dibayar :
                                                    </th>
                                                    @foreach ($bulan as $b)
                                                        <th colspan="2">{{ $b->bulan_dibayar }} - {{ $b->tahun_dibayar }}
                                                        </th>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Jumlah Bayar :
                                                    </th>
                                                    <th>{{ $siswa->spp->nominal * $i }}</th>
                                                </tr>
                                            </table>
                                        @endsection
