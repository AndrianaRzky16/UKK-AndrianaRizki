@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: lightgrey">
                        <li class="breadcrumb-item" aria-current="page">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">History</li>
                    </ol>
                </nav>

                <div class="card p-4">

                    <div class="card-body">

                        @if (Session::get('success'))
                            <div class="alert alert-success mt-2 mb-2" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::get('error'))
                            <div class="alert alert-danger mt-2 mb-2" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif


                        <h3>History</h3>

                        <div class="button-tambah mt-4 mb-3 ml-3">
                            <a href="{{ route('history.export_excel') }}" class="btn btn-success modalbutton">
                                <small>
                                    <i class="fa fa-file-excel-o"></i>
                                </small>
                            </a>



                        </div>

                        <div class="table">
                            <table class="table table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tanggal Bayar</th>
                                        <th scope="col">Bulan Dibayar</th>
                                        {{-- <th scope="col">Tahun Dibayar</th> --}}
                                        <th scope="col">Tahun Masuk</th>
                                        <th scope="col">Jumlah Bayar</th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $p)
                                        <tr>
                                            <td>{{ $p->siswa->nama }}</td>
                                            <td>{{ $p->tgl_bayar }}</td>
                                            <td>{{ $p->bulan_dibayar }} - {{ $p->tahun_dibayar }}</td>
                                            {{-- <td></td> --}}
                                            <td>{{ $p->spp->tahun_masuk }}</td>
                                            <td>{{ $p->jumlah_bayar }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <script>
                                $(document).ready(function() {
                                    $('#table').DataTable();
                                });
                            </script>
                        @endsection
