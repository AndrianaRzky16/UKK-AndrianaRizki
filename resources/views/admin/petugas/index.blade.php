@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Petugas</title>
    </head>

    <body>
        <div class="container">
            {{-- @if ($messege = Session::get('success'))
            <div class="aler alert-danger alert-blok">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>$messege</strong>
            @endif --}}
            <h1>Index Petugas</h1>
            <div class="container">
                <a href="{{ route('employ.create') }}" class="btn btn-success">
                    <small>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </small></a>
                <br>
                <br>
                <table class="table table-bordered" id="table">
                    <thead>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Email</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->level }}</td>
                                <td>{{ $data->email }}</td>
                                <td>

                                    <form action="{{ route('employ.destroy', $data->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin akan di hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-2">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        <a href="{{ route('employ.edit', $data->id) }}" style="color: white"
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
