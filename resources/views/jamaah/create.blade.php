@extends('layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="index.html">Jemaah</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create
    </li>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fa-solid fa-user-plus" style="margin-right: 10px"></i>Data Jamaah</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('jamaah.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>NIJ</label>
                                <input type="text" class="form-control @error('nij') is-invalid @enderror" id="nij"
                                    name="nij" placeholder="NIJ" value="{{ old('nij') }}">
                                @error('nij')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama Jamaah</label>
                                <input type="text" class="form-control @error('namajamaah') is-invalid @enderror"
                                    id="namajamaah" name="namajamaah" placeholder="Nama Jamaah" value="{{ old('namajamaah') }}">
                                @error('namajamaah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control select2 @error('jenis_kelamin') is-invalid @enderror"
                                    style="width: 100%;" id="jenis_kelamin" name="jenis_kelamin">
                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Perempuan" @if(old('jenis_kelamin') === 'Perempuan') selected @endif>Perempuan</option>
                                    <option value="Laki-Laki" @if(old('jenis_kelamin') === 'Laki-Laki') selected @endif>Laki-Laki</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>No KTP</label>
                                <input type="number" class="form-control @error('no_ktp') is-invalid @enderror"
                                    id="no_ktp" name="no_ktp" placeholder="No KTP" value="{{ old('no_ktp') }}">
                                @error('no_ktp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>No Passport</label>
                                <input type="number" class="form-control @error('no_passport') is-invalid @enderror"
                                    id="no_passport" name="no_passport" placeholder="No Passport" value="{{ old('no_passport') }}">
                                @error('no_passport')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp"
                                    placeholder="No HP" value="{{ old('no_hp') }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir"
                                    placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tgl Lahir</label>
                                <input type="date" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    id="tgl_lahir" name="tgl_lahir"  value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="5">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="5">{{ old('keterangan') }}</textarea>
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
                            <a href="{{ route('jamaah.create') }}" class="btn btn-danger me-2" id="btn-delete">Reset</a>
                            <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2()
        })
    </script>
@endsection
