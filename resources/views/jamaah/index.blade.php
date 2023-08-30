@extends('layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="index.html">Jemaah</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Dashboard
    </li> --}}
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1">
                                <a href="{{ route('jamaah.create') }}" class="btn btn-primary btn-sm mt-27"
                                    id="btn-tambah"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                    Tambah
                                </a>
                            </div>
                            <div class="col-lg-11">
                                <form class="row justify-content-end" id="cari">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Nama </label>
                                            <input type="text" placeholder="Nama Jemaah" name="nama"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Tgl Lahir</label>
                                            <input type="date" class="form-control" id="tgllahir" name="tgllahir">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-primary btn-sm" style="margin-top: 27px;"
                                            onclick="cari()"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </button>
                        <div class="table-responsive">
                            <table class="table table-striped display" id="jamaah-table">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>NIJ</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>No Ktp</th>
                                        <th>No Passport</th>
                                        <th>No Hp</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tgl Lahir</th>
                                        <th>Umur</th>
                                        <th>Keterangan</th>
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
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            showJamaah()
        })
        const showJamaah = (filterData = $('#cari').serialize()) => {
            const columns = [{
                    render: function(data, type, full, row) {
                        return `<div style='width:85px'>` +
                            ` <button type="button" class="btn btn-warning btn-sm" onClick="editJamaah(${full.id})"><i class="fa-solid fa-pen-to-square"></i></button> ` +
                            ` <button type="button" class="btn btn-danger btn-sm" onClick="deleteJamaah(${full.id})"><i class="fa-solid fa-trash"></i></button>` +
                            `</div>`
                    }
                },
                {
                    data: "nij"
                },
                {
                    data: "namajamaah"
                },
                {
                    data: "jenis_kelamin"
                },
                {
                    data: "alamat"
                },
                {
                    data: "no_ktp"
                },
                {
                    data: "no_passport"
                },
                {
                    data: "no_hp"
                },
                {
                    data: "tempat_lahir"
                },
                {
                    data: "tgl_lahir"
                },
                {
                    data: "umur",
                    render: function(data, type, row, meta) {
                        return data + ' Tahun';
                    }
                },
                {
                    data: "keterangan"
                },
            ];

            var table = $('#jamaah-table').DataTable({
                searching: false,
                destroy: true,
                lengthChange: false,
                ajax: {
                    url: "{{ route('jamaah.get') }}" + `?${filterData}`,
                    // data: filterData
                },
                columns: columns
            });

        }
        const cari = () => {
            showJamaah($('#cari').serialize());
        }

        const editJamaah = (id) => {
           window.location.href =  `{{ route('jamaah.edit', ['jamaah' => ':id']) }}`.replace(':id', id)
        }

        const deleteJamaah = (id) => {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "untuk menghapus data tersebut!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('jamaah.destroy', ['jamaah' => ':id']) }}`.replace(':id', id),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Deleted!',
                                icon: 'success',
                                text: 'Data berhasil dihapus.',
                                didClose: () => {
                                    $('#jamaah-table').DataTable().ajax.reload()
                                }
                            })
                        },
                        error: function(err) {
                            console.log(err.responseText)
                        }
                    })

                }
            })
        }
    </script>
@endsection
