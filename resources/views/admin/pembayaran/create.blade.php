@extends('layouts.app')

@section('activePembayaran')
    active
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">

                {{-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: lightgrey">
                        <li class="breadcrumb-item" aria-current="page">Home</li>
                        <li class="breadcrumb-item" aria-current="page">pembayaran</li>
                        <li class="breadcrumb-item active" aria-current="page">create</li>
                    </ol>
                </nav> --}}

                <div class="card p-4">

                    <div class="card-body">

                        @if (Session::get('tjumlah_bayar'))
                            <div class="alert alert-danger mt-2 mb-2" role="alert">
                                {{ Session::get('tjumlah_bayar') }}
                            </div>
                        @endif

                        @if (Session::get('error'))
                            <div class="alert alert-danger mt-2 mb-2" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <h3>Pembayaran</h3>

                        <div class="form p-2">
                            <form action="{{ route('pembayaran.store') }}" class="mt-3" method="post">
                                @csrf

                                @if ($siswa->count() == 0)
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-danger text-white"
                                            value="Belum ada siswa, Silahkan dilengkapi terlebih dahulu">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="form-label">NISN</label>
                                        <select name="nisn" id="nisn" required="required" class="form-control">
                                            <option value="">-- Pilih Siswa --</option>
                                            @foreach ($siswa as $siswa)
                                                <option value="{{ $siswa->nisn }}">{{ $siswa->nama }} --
                                                    {{ $siswa->nisn }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <div class="form-group">
                                        <label for="nisn">NISN</label>
                                        <select name="nisn" id="nisn" style="width: 100%">
                                            <option disabled selected>== Pilih Siswa ==</option>
                                            @foreach ($siswa as $siswa)
                                                <option value="{{ $siswa->nisn }}">{{ $siswa->nama }} --
                                                    {{ $siswa->nis }} </option>
                                            @endforeach
                                        </select> --}}

                                        @error('nisn')
                                            <div class="error p-2" style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="berapa">Bayar Berapa Bulan</label>
                                    <select name="bayar_berapa" id="berapa" class="form-control">
                                        <option value="1">1 Bulan</option>
                                        <option value="2">2 Bulan</option>
                                        <option value="3">3 Bulan</option>
                                        <option value="4">4 Bulan</option>
                                        <option value="5">5 Bulan</option>
                                        <option value="6">6 Bulan</option>
                                        <option value="7">7 Bulan</option>
                                        <option value="8">8 Bulan</option>
                                        <option value="9">9 Bulan</option>
                                        <option value="10">10 Bulan</option>
                                        <option value="11">11 Bulan</option>
                                        <option value="12">12 Bulan</option>
                                        <option value="13">13 Bulan</option>
                                        <option value="14">14 Bulan</option>
                                        <option value="15">15 Bulan</option>
                                        <option value="16">16 Bulan</option>
                                        <option value="17">17 Bulan</option>
                                        <option value="18">18 Bulan</option>
                                        <option value="19">19 Bulan</option>
                                        <option value="20">20 Bulan</option>
                                        <option value="21">21 Bulan</option>
                                        <option value="22">22 Bulan</option>
                                        <option value="23">23 Bulan</option>
                                        <option value="24">24 Bulan</option>
                                        <option value="25">25 Bulan</option>
                                        <option value="26">26 Bulan</option>
                                        <option value="27">27 Bulan</option>
                                        <option value="28">28 Bulan</option>
                                        <option value="29">29 Bulan</option>
                                        <option value="30">30 Bulan</option>
                                        <option value="31">31 Bulan</option>
                                        <option value="32">32 Bulan</option>
                                        <option value="33">33 Bulan</option>
                                        <option value="34">34 Bulan</option>
                                        <option value="35">35 Bulan</option>
                                        <option value="36">36 Bulan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nominal">Harga SPP</label>
                                    <input type="text" id="spp" class="form-control" readonly
                                        placeholder="Nominal Spp">
                                </div>

                                <div class="form-group">
                                    <label for="nominal">total Bayar</label>
                                    <input type="text" name="total" id="nominal" class="form-control" readonly
                                        placeholder="Nominal Rupiah">
                                </div>

                                <div class="form-group">
                                    <label for="waktuTerakhir">Waktu Terakhir Bayar</label>
                                    <input type="text" id="waktuTerakhir" class="form-control" readonly
                                        placeholder="Waktu terakhir bayar">
                                </div>

                                {{-- <div class="col-md-6" hidden> --}}
                                <div class="form-group">
                                    <label for="jumlah_bayar">Jumlah Bayar :</label>
                                    <input type="number" class="form-control" name="jumlah_bayar" id="jumlah_bayar">
                                </div>
                        </div>

                        {{-- <div class="form-group">
                                    <label for="jumlah_bayar">jumlah_bayar</label>
                                    <input type="text" min="20000" maxlength="11"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" id="jumlah_bayar"
                                        class="form-control @error('jumlah_bayar')
invalid
@enderror"
                                        placeholder="Masukan jumlah_bayar spp" required>

                                    @error('jumlah_bayar')
                                        <div class="error p-2" style="color: red">
                                            {{ $message }}
                                        </div>
                                    @enderror --}}

                        @if (Session::get('tjumlah_bayar'))
                            <div class="error p-2" style="color: red">
                                {{ Session::get('tnominal') }}
                            </div>
                        @endif

                    </div>

                    @if ($siswa->count() == 0)
                        {{-- <div class="form-group">
                            <a href="{{ route('pembayaran.index') }}" class="btn btn-dark">
                                Back <i class="fa fa-fire-extinguisher" aria-hidden="true"></i>
                            </a>
                        </div> --}}
                    @else
                        <div class="form-group">
                            <button type="submit" id="buttonSubmit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#nisn').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#berapa').select2();
        });
    </script>


    <script>
        $('#nisn').on('change', function() {
            var nisn = $('#nisn').val();
            var berapa = $('#berapa').val();

            $.ajax({
                url: "{{ url('pembayaran/getData/') }}" + "/" + nisn + "/" + berapa,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);

                    if (data['bulan'] == "sudah lunas") {
                        var waktu = data['bulan'] + " " + data["tahun"];
                        $('#spp').val(data['nominal']);
                        $('#nominal').val(data['nominal']);
                        $('#waktuTerakhir').val(waktu);

                        $('#jumlah_bayar').prop('readonly', 'true');
                        $('#buttonSubmit').prop('disabled', 'true');
                    } else {
                        var waktu = data['bulan'] + " " + data["tahun"];
                        $('#nominal').val(data['nominal']);
                        $('#waktuTerakhir').val(waktu);
                        $('#spp').val(data['nominal']);

                        $('#jumlah_bayar').prop('min', data['nominal']);

                        $('#jumlah_bayar').removeAttr('readonly', 'true');
                        $('#buttonSubmit').removeAttr('disabled', 'true');
                    }


                }
            });
        });
    </script>

    <script>
        $('#berapa').on('change', function() {
            var brp = $(this).val();
            var spp = $('#spp').val();
            var total = spp * brp;
            $('#nominal').val(total);
        });


        $('#jumlah_bayar').keyup(function() {
            var sanitized = $(this).val().replace(/[^0-9]/g, '');

            $(this).val(sanitized);
        });
    </script>



@endsection
