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
                    <form action="{{route('kelas.update', $kela->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <strong>Nama Kelas</strong>
                        <input type="text" name="nama_kelas" value="{{$kela->nama_kelas}}" class="form-control">
                        <strong>Kompetensi Keahlian</strong>
                        <input type="text" name="kompetensi_keahlian" value="{{$kela->kompetensi_keahlian}}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    
@endsection