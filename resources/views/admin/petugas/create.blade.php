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
            <h1>Create Petugas</h1>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('employ.store') }}">
                            @csrf
                            {{-- <div class="form-group row">
                                <label for="id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('ID Petugas') }}</label>

                                <div class="col-md-6">
                                    <input id="id" type="text"
                                        class="form-control @error('id') is-invalid @enderror" name="id"
                                        value="{{ old('id') }}" required autocomplete="id" autofocus>

                                    @error('id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="nama_petugas"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama Petugas') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_petugas" type="text"
                                        class="form-control @error('nama_petugas') is-invalid @enderror" name="nama_petugas"
                                        value="{{ old('nama_petugas') }}" required autocomplete="nama_petugas" autofocus>

                                    @error('nama_petugas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="disable">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="level"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                                <div class="col-md-6">
                                    <select name="level" id="level"
                                        class="form-control @error('level') is-invalid @enderror" required autofocus>
                                        <option value="">--PILIH LEVEL--</option>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        {{-- <option value="siswa">Siswa</option> --}}
                                    </select>

                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>





                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Simpan
                                    </button>
                                    {{-- <a href="{{ route('employ') }}" class="btn btn-primary btn-sm">Kembali</a> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
