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
        <h1>Create Class</h1>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('kelas.store')}}" method="POST">
                    @csrf
                     <div class="form-group">
                         <strong>Nama Kelas</strong>
                         <input type="text" name="nama_kelas" class="form-control">
                         <strong>Kompetensi Kealian</strong>
                         <input type="text" name="kompetensi_keahlian" class="form-control">
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