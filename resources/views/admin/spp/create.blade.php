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
            <h1>Create Spp</h1>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('spp.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <strong>Tahun Masuk</strong>
                                <input type="text" name="tahun_masuk" class="form-control">
                                <strong>Tahun Keluar</strong>
                                <input type="text" name="tahun_keluar" class="form-control">
                                <strong>Nominal</strong>
                                <input type="number" name="nominal" class="form-control">
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
