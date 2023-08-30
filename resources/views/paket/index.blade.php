@extends('layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="index.html">Paket</a></li>
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
                                <button type="button" id="btn-tambah" class="btn btn-primary btn-sm mt-27"
                                    data-bs-toggle="modal" data-bs-target="#inlineForm">
                                    <i class="fa-solid fa-plus"></i> Tambah
                                </button>
                            </div>
                            <div class="col-lg-11">
                                <form class="row justify-content-end" id="cari">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Nama Paket</label>
                                            <input type="text" placeholder="Nama Paket" name="nama"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tgl Keberangkatan</label>
                                            <input type="date" class="form-control" id="tglkeberangkatan"
                                                name="tglkeberangkatan">
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
                            <table class="table table-striped display" id="paket-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga Paket</th>
                                        <th>Tgl Keberangkatan</th>
                                        <th>Aksi</th>
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

    <form id='paket-submit' action="{{ route('paket.store') }}">
        @csrf
        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Tambah Paket </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Paket </label>
                            <input type="text" placeholder="Nama Paket" name="nama" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Harga Paket </label>
                            <input type="number" placeholder="Harga Paket" name="harga_paket" class="form-control"
                                required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Tgl Keberangkatan</label>
                            <input type="date" class="form-control" id="tgl_keberangkatan" name="tgl_keberangkatan">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <form id='paket-submit-edit'>
        @csrf
        <div class="modal fade text-left" id="inlineFormEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content" id="modal-content-edit">

                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#paket-submit').on('submit', function(e) {
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
                                text: 'Paket berhasil ditambahkan.',
                                didClose: () => {
                                    $('#inlineForm').modal('hide')
                                    $('#paket-submit').trigger('reset')
                                    $('#paket-table').DataTable().ajax.reload()
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                icon: 'error',
                                didClose: () => {
                                    $('#inlineForm').modal('hide')
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

            $('#paket-submit-edit').on('submit', function(e) {
                e.preventDefault()
                const id = $('#id-edit').val()
                const url = 'update-paket/' + id
                const data = new FormData(this)
                $.ajax({
                    url: url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.code === 1) {
                            Swal.fire({
                                title: 'Berhasil!',
                                icon: 'success',
                                text: 'Paket berhasil diupdate.',
                                didClose: () => {
                                    $('#inlineFormEdit').modal('hide')
                                    $('#paket-submit-edit').trigger('reset')
                                    $('#paket-table').DataTable().ajax.reload()
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                icon: 'error',
                                didClose: () => {
                                    $('#inlineFormEdit').modal('hide')
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

            showPaket()
        })
        const showPaket = (filterData = $('#cari').serialize()) => {
            const columns = [{
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: "nama"
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
                    data: "tgl_keberangkatan"
                },
                {
                    render: function(data, type, full, row) {
                        return `<div style='width:85px'>` +
                            ` <button type="button" class="btn btn-warning btn-sm" onClick="editPaket(${full.id})"><i class="fa-solid fa-pen-to-square"></i></button> ` +
                            ` <button type="button" class="btn btn-danger btn-sm" onClick="deletePaket(${full.id})"><i class="fa-solid fa-trash"></i></button>` +
                            `</div>`
                    }
                },
            ];

            var table = $('#paket-table').DataTable({
                searching: false,
                destroy: true,
                lengthChange: false,
                ajax: {
                    url: "{{ route('paket.get') }}" + `?${filterData}`,
                    // data: filterData
                },
                columns: columns
            });

        }
        const cari = () => {
            showPaket($('#cari').serialize());
        }

        const editPaket = (id) => {
            $.ajax({
                url: `paket/${id}/edit`,
                type: 'GET',
                success: function(res) {
                    $('#modal-content-edit').html(res)
                    $('#inlineFormEdit').modal('show')
                },
                error: function(res) {
                    alert(res.responseText);
                }
            })
        }

        const deletePaket = (id) => {
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
                        url: `{{ route('paket.destroy', ['paket' => ':id']) }}`.replace(':id', id),
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
                                    $('#paket-table').DataTable().ajax.reload()
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
