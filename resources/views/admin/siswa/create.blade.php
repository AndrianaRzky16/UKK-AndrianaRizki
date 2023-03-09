@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>spp</title>
    </head>

    <body>
        <div class="container">
            <h1>Create Student</h1>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('siswa.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <strong>Nisn</strong>
                                <input type="number" name="nisn" class="form-control">
                                <strong> Nis</strong>
                                <input type="number" name="nis" class="form-control">
                                <strong> Nama</strong>
                                <input type="text" name="nama" class="form-control">
                                <strong>Kelas</strong>
                                <select name="id_kelas" id="id_kelas" class="form-control">
                                    <option value="" selected>Pilih Kelas</option>
                                    @foreach ($kelas as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                <strong>Spp</strong>
                                <select name="id_spp" id="id_spp" class="form-control">
                                    <option value="" selected>Pilih Spp</option>
                                    @foreach ($spp as $s)
                                        <option value="{{ $s->id_spp }}">{{ $s->nominal }} || {{ $s->tahun }}
                                    @endforeach
                                </select>
                                <strong>Alamat</strong>
                                <input type="text" name="alamat" class="form-control">
                                {{-- <strong>Tanggal Masuk</strong>
                                <input type="text" name="id_masuk" class="form-control"> --}}
                                <strong>No Telpon</strong>
                                <input type="number" name="no_telpon" class="form-control">
                            </div>
                            @if (Session::get('error'))
                                <div class="error p-2" style="color: red">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
