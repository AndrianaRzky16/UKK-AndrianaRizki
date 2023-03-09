@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Kelas</title>
    </head>

    <body>
        <div class="container">
            @if ($messege = Session::get('success'))
                <div class="aler alert-danger alert-blok">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>$messege</strong>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color: lightgrey">
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Kelas</li>
                        </ol>
                    </nav>


                    <h1>Index Kelas</h1>
                    <div class="container">
                        <a href="{{ route('kelas.create') }}" class="btn btn-success">
                            <small>
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </small></a>

                        <br>
                        <br>
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>Nama Kelas</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $kelas)
                                    <tr>
                                        <td>{{ $kelas->nama_kelas }}</td>
                                        <td>{{ $kelas->kompetensi_keahlian }}</td>
                                        <td>
                                            <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin akan di hapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-2">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <a href="{{ route('kelas.edit', $kelas->id) }}" style="color: white"
                                                    class="btn btn-warning mb-2"><i class="fa fa-pencil-square"></i></a>
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
