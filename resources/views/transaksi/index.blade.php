@extends('layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="index.html">Transaksi</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Dashboard
    </li> --}}
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="transaksi-tab" data-bs-toggle="tab" href="#transaksi" role="tab"
                                    aria-controls="profile" aria-selected="false">Transaksi</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pelunasan-tab" data-bs-toggle="tab" href="#pelunasan" role="tab"
                                    aria-controls="contact" aria-selected="false">Pelunasan</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <form class="row justify-content-end" id="cari">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Nama Jamaah</label>
                                                                    <input type="text" placeholder="Nama Jemaah"
                                                                        name="nama" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Kode Transaksi</label>
                                                                    <input type="text" placeholder="Kode Transaksi"
                                                                        name="kodetransaksi" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Tgl Transaksi</label>
                                                                    <input type="date" class="form-control"
                                                                        id="tgltransaksi" name="tgltransaksi"  value="{{ date('Y-m-d') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    style="margin-top: 27px;" onclick="cari()"
                                                                   ><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </button>
                                                <div class="table-responsive">
                                                    <table class="table table-striped display" id="transaksi-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Tgl Transaksi</th>
                                                                <th>Kode Transaksi</th>
                                                                <th>Jamaah</th>
                                                                <th>Nama Paket</th>
                                                                <th>Harga Paket</th>
                                                                <th>Tanggal Keberangkatan</th>
                                                                <th>Saldo</th>
                                                                <th>Status</th>
                                                                <th>Keterangan</th>
                                                                {{-- <th>Aksi</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"><i class="fa-solid fa-credit-card"
                                                    style="margin-right: 10px"></i>Transaksi</h4>
                                        </div>

                                        <div class="card-body">
                                            <form action="{{ route('transaksi.store') }}" id="transaksi-store">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Jamaah</label>
                                                            <select
                                                                class="form-control select2 @error('jamaah_id') is-invalid @enderror"
                                                                style="width: 100%;" id="jamaah_id_transaksi"
                                                                name="jamaah_id">
                                                                <option disabled selected>Pilih Jamaah</option>
                                                                @foreach ($jamaah as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        data-jamaah="{{ $item->namajamaah }}">
                                                                        {{ $item->namajamaah }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('jamaah_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <input type="hidden" name="namajamaah"
                                                                id="namajamaah_transaksi">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Paket</label>
                                                            <select
                                                                class="form-control select2 @error('paket_id') is-invalid @enderror"
                                                                style="width: 100%;" id="paket_id_transaksi"
                                                                name="paket_id">
                                                                <option disabled selected>Pilih Paket</option>
                                                                @foreach ($paket as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        data-harga-paket="{{ $item->harga_paket }}">
                                                                        {{ $item->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('paket_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Harga Paket</label>
                                                            <input type="number"
                                                                class="form-control @error('harga_paket') is-invalid @enderror"
                                                                id="harga_paket_transaksi" name="harga_paket"
                                                                placeholder="Harga Paket"
                                                                value="{{ old('harga_paket') }}" readonly>
                                                            @error('harga_paket')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Pembayaran</label>
                                                            <input type="number"
                                                                class="form-control @error('pembayaran') is-invalid @enderror"
                                                                id="pembayaran" name="pembayaran" min="0"
                                                                placeholder="Pembayaran" value="{{ old('pembayaran') }}">
                                                            @error('pembayaran')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <input type="text"
                                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                                id="keterangan" name="keterangan" min="0"
                                                                placeholder="Keterangan" value="{{ old('keterangan') }}">
                                                            @error('keterangan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-12 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-danger me-2"
                                                            id="btn-reset">Reset</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            id="btn-save">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pelunasan" role="tabpanel" aria-labelledby="pelunasan-tab">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"><i class="fa-solid fa-credit-card"
                                                    style="margin-right: 10px"></i>Pelunasan</h4>
                                        </div>

                                        <div class="card-body">
                                            <form id="pelunasan-store" action="{{ route('transaksi.pelunasan') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Kode Transaksi</label>
                                                            <select
                                                                class="form-control select2 @error('transaksi_id') is-invalid @enderror"
                                                                style="width: 100%;" id="transaksi_id"
                                                                name="transaksi_id">
                                                                <option disabled selected>Pilih Transaksi</option>
                                                                @foreach ($transaksi as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        data-harga-paket="{{ $item->harga_paket }}"
                                                                        data-saldo="{{ $item->saldo }}">
                                                                        {{ $item->kode_transaksi }} -
                                                                        {{ $item->namajamaah }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('transaksi_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <input type="hidden" name="saldo_old" id="saldo_old">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Harga Paket</label>
                                                            <input type="number"
                                                                class="form-control @error('harga_paket') is-invalid @enderror"
                                                                id="harga_paket" name="harga_paket"
                                                                placeholder="Harga Paket"
                                                                value="{{ old('harga_paket') }}" readonly>
                                                            @error('harga_paket')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Jumlah Yang Harus Dilunaskan</label>
                                                            <input type="number"
                                                                class="form-control @error('jumlah_pelunasan') is-invalid @enderror"
                                                                id="jumlah_pelunasan" name="jumlah_pelunasan"
                                                                placeholder="Jumlah Pelunasan"
                                                                value="{{ old('jumlah_pelunasan') }}" readonly>
                                                            @error('jumlah_pelunasan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Pembayaran</label>
                                                            <input type="number"
                                                                class="form-control @error('pembayaran') is-invalid @enderror"
                                                                id="pembayaran_pelunas" name="pembayaran" min="0"
                                                                placeholder="Pembayaran" value="{{ old('pembayaran') }}">
                                                            @error('pembayaran')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Sisa Pembayaran</label>
                                                            <input type="number"
                                                                class="form-control @error('sisa_pembayaran') is-invalid @enderror"
                                                                id="sisa_pembayaran" name="sisa_pembayaran"
                                                                placeholder="Sisa Pembayaran" min="0"
                                                                value="{{ old('sisa_pembayaran') }}" readonly>
                                                            @error('sisa_pembayaran')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-12 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-danger me-2"
                                                            id="btn-reset">Reset</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            id="btn-save">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2()

            $('#pembayaran').on('input', function() {
                var pembayaranValue = parseFloat($(this).val());
                var hargaPaketValue = parseFloat($('#harga_paket_transaksi').val());

                if (!isNaN(pembayaranValue) && !isNaN(hargaPaketValue)) {
                    if (pembayaranValue > hargaPaketValue) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                }
            });

            $('#pembayaran_pelunas').on('input', function() {
                var pembayaranValue = parseFloat($(this).val());
                var hargaPaketValue = parseFloat($('#jumlah_pelunasan').val());

                if (!isNaN(pembayaranValue) && !isNaN(hargaPaketValue)) {
                    if (pembayaranValue > hargaPaketValue) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                }
            });

            $('#paket_id_transaksi').change(function() {
                var hargaPaketTrans = $('#paket_id_transaksi option:selected').attr('data-harga-paket')
                $('#harga_paket_transaksi').val(hargaPaketTrans)
            })

            $('#jamaah_id_transaksi').change(function() {
                var namaJamaahTrans = $('#jamaah_id_transaksi option:selected').attr('data-jamaah')
                $('#namajamaah_transaksi').val(namaJamaahTrans)
            })

            $('#transaksi_id').change(function() {
                var hargaPaketPelunas = $('#transaksi_id option:selected').attr('data-harga-paket')
                var saldoPelunas = $('#transaksi_id option:selected').attr('data-saldo')

                $('#harga_paket').val(hargaPaketPelunas)
                $('#saldo_old').val(saldoPelunas)
                $('#jumlah_pelunasan').val(hargaPaketPelunas - saldoPelunas)
            })

            $('#pembayaran_pelunas').keyup(function() {
                var hargaPaketPelunas = $('#harga_paket').val()
                var jumlahPelunasan = $('#jumlah_pelunasan').val()
                var pembayaran = $('#pembayaran_pelunas').val()

                var saldoakhir = parseFloat(jumlahPelunasan) - parseFloat(pembayaran)

                $('#sisa_pembayaran').val(saldoakhir)
            })

            $('#transaksi-store').on('submit', function(e) {
                e.preventDefault()
                const url = this.getAttribute('action')
                $.ajax({
                    url: url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.code === 1) {
                            Swal.fire({
                                title: 'Berhasil!',
                                icon: 'success',
                                text: 'Transaksi berhasil.',
                                didClose: () => {
                                    $('#transaksi-store').trigger('reset')
                                    $('#paket_id_transaksi').val('Pilih Paket').change()
                                    $('#jamaah_id_transaksi').val('Pilih Jamaah').change()
                                    $('#transaksi-table').DataTable().ajax.reload()
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                icon: 'error',
                                didClose: () => {

                                }
                            })
                        }
                    },
                    error: function(res) {
                        try {
                            const errors = JSON.parse(res.responseText).errors;
                            for (const fieldName in errors) {
                                const input = $(`[name="${fieldName}"]`);
                                const errorMessage = errors[fieldName][0];
                                input.addClass('is-invalid');
                                input.siblings('.invalid-feedback').text(errorMessage);
                            }
                        } catch (e) {
                            alert('Terjadi kesalahan: ' + res.responseText);
                        }
                    }
                })
            })

            $('#pelunasan-store').on('submit', function(e) {
                e.preventDefault()
                const url = this.getAttribute('action')
                $.ajax({
                    url: url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.code === 1) {
                            Swal.fire({
                                title: 'Berhasil!',
                                icon: 'success',
                                text: 'Pelunasan berhasil.',
                                didClose: () => {
                                    $('#pelunasan-store').trigger('reset')
                                    $('#transaksi-table').DataTable().ajax.reload()
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                icon: 'error',
                                didClose: () => {

                                }
                            })
                        }
                    },
                    error: function(res) {
                        try {
                            const errors = JSON.parse(res.responseText).errors;
                            for (const fieldName in errors) {
                                const input = $(`[name="${fieldName}"]`);
                                const errorMessage = errors[fieldName][0];
                                input.addClass('is-invalid');
                                input.siblings('.invalid-feedback').text(errorMessage);
                            }
                        } catch (e) {
                            alert('Terjadi kesalahan: ' + res.responseText);
                        }
                    }
                })
            })

            showTransaksi()
        })

        const showTransaksi = (filterData = $('#cari').serialize()) => {
            const columns = [{
                    data: "tanggal_transaksi"
                },
                {
                    data: "kode_transaksi"
                },
                {
                    data: "jamaah",
                    render: function(data) {
                        if (data.length > 0) {
                            return data[0].namajamaah;
                        }
                        return '';
                    },
                },
                {
                    data: "paket",
                    render: function(data) {
                        if (data.length > 0) {
                            return data[0].nama;
                        }
                        return '';
                    },
                },
                {
                    data: "harga_paket",
                    render: function(data, type, row) {
                        var formattedPrice = 'Rp ' + Math.floor(data).toLocaleString('id-ID');

                        if (type === 'display' || type === 'filter') {
                            return formattedPrice;
                        }
                        return data;
                    }
                },
                {
                    data: "paket",
                    render: function(data) {
                        if (data.length > 0) {
                            return data[0].tgl_keberangkatan;
                        }
                        return '';
                    },
                },
                {
                    data: "saldo"
                },
                {
                    data: "is_lunas",
                    render: function(data) {
                        if (data == 0) {
                            return 'Belum Lunas'
                        } else {
                            return 'Lunas'
                        }
                    },
                },
                {
                    data: "keterangan"
                },
            ];

            var table = $('#transaksi-table').DataTable({
                searching: false,
                destroy: true,
                lengthChange: false,
                ajax: {
                    url: "{{ route('transaksi.get') }}" + `?${filterData}`,
                    // data: filterData
                },
                columns: columns
            });

        }
        const cari = () => {
            showTransaksi($('#cari').serialize());
        }
    </script>
@endsection
