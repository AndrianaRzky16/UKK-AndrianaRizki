@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Siswa</title>
    </head>

    <body>
        <div class="container">
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            {{-- @if ($messege = Session::get('success'))
                <div class="aler alert-danger alert-blok">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>$messege</strong>
            @endif --}}
            <h1>Index Student</h1>
            <div class="container">
                <br>
                <a href="{{ route('siswa.create') }}" class="btn btn-success">
                    <small>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </small></a>
                <br>
                <br>
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Nisn</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Spp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $siswa)
                            <tr>
                                <td>{{ $siswa->nisn }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->nama_kelas }}</td>
                                <td>{{ $siswa->alamat }}</td>
                                <td>{{ $siswa->no_telpon }}</td>
                                <td><b>Spp</b> tahun {{ substr($siswa->tahun_masuk, 0, 4) }} -
                                    {{ substr($siswa->tahun_keluar, -4, 4) }}</td>

                                <td>
                                    <form action="{{ route('siswa.destroy', $siswa->nisn) }}" method="POST"
                                        onsubmit="return confirm('Yakin akan di hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                        <a href="{{ route('siswa.show', $siswa->nisn) }}" class="btn btn-primary">
                                            <i class="fa fa-street-view" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('siswa.edit', $siswa->nisn) }}" class="btn btn-warning"><i
                                                class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection
