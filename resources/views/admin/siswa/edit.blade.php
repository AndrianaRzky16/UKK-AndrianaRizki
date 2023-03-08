@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Spp</title>
    </head>

    <body>
        <div class="container">
            <h1>Edit Spp</h1>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('siswa.update', $siswa->nisn) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <strong>Nisn</strong>
                                <input type="number" name="nisn" class="form-control" value="{{ $siswa->nisn }}">
                                <strong> Nis</strong>
                                <input type="number" name="nis" class="form-control" value="{{ $siswa->nis }}">
                                <strong> Nama</strong>
                                <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}">

                                <strong>Kelas:</strong>
                                <select class="form-control" name="id_kelas" value='Kode Distributor'>

                                    @foreach ($kelas as $a)
                                        <option @if ($siswa->id_kelas == $a->id) selected @endif
                                            value="{{ $a->id }}">{{ $a->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                <strong>Spp</strong>
                                <select class="form-control" name="id_spp" value='Kode Distributor'>

                                    @foreach ($s as $a)
                                        <option @if ($siswa->id_spp == $a->id) selected @endif
                                            value="{{ $a->id }}">{{ $a->nominal }} {{ $a->tahun }}</option>
                                    @endforeach
                                </select>
                                <strong>Alamat</strong>
                                <input type="text" name="alamat" class="form-control" value="{{ $siswa->alamat }}">
                                <strong>No Telpon</strong>
                                <input type="number" name="no_telpon" class="form-control"
                                    value="{{ $siswa->no_telpon }}">
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
