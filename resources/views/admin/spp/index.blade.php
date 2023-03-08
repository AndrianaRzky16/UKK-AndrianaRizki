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
            {{-- @if ($messege = Session::get('success'))
            <div class="aler alert-danger alert-blok">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>$messege</strong>
            @endif --}}
            <h1>Index Spp</h1>
            <div class="container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <br>
                <a href="{{ route('spp.create') }}" class="btn btn-success">
                    <small>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </small></a>
                <br>
                <br>
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Tahun Masuk - Tahun Keluar</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $spp)
                            <tr>
                                <td>{{ $spp->tahun_masuk }} - {{ $spp->tahun_keluar }}</td>
                                <td>{{ $spp->nominal }}</td>
                                <td>
                                    <form action="{{ route('spp.destroy', $spp->id_spp) }}" method="POST"
                                        onsubmit="return confirm('Yakin akan di hapus {{ $spp->nominal }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-2">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        <a href="{{ route('spp.edit', $spp->id_spp) }}" style="color: white"
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
