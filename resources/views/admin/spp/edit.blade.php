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
                        <form action="{{ route('spp.update', $spp->id_spp) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <strong>Tahun</strong>
                                <input type="text" name="tahun_masuk" value="{{ $spp->tahun_masuk }}"
                                    class="form-control">
                                <strong>Tahun</strong>
                                <input type="text" name="tahun_keluar" value="{{ $spp->tahun_keluar }}"
                                    class="form-control">
                                <strong>Nominal</strong>
                                <input type="text" name="nominal" value="{{ $spp->nominal }}" class="form-control">
                            </div>
                            <button type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
