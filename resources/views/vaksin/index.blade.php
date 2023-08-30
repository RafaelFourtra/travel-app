@extends('layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="index.html">Vaksin</a></li>
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
                                            <label>Nama Jamaah</label>
                                            <input type="text" placeholder="Nama Jamaah" name="nama"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Vaksin</label>
                                            <select class="form-control select2" style="width: 100%;" id="vaksin"
                                                name="vaksin">
                                                <option disabled selected>Pilih Vaksin</option>
                                                <option value="1">
                                                    Vaksin 1</option>
                                                <option value="2">
                                                    Vaksin 2</option>
                                                <option value="3">
                                                    Vaksin 3</option>
                                            </select>
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
                            <table class="table table-striped display" id="vaksin-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jamaah</th>
                                        <th>Vaksin</th>
                                        <th>Tanggal</th>
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

    <form id='vaksin-submit' action="{{ route('vaksin.store') }}">
        @csrf
        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Tambah Jamaah-Vaksin </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Jamaah</label>
                            <select class="form-control select2" style="width: 100%;" id="jamaah_id" name="jamaah_id">
                                <option disabled selected>Pilih Jamaah</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->namajamaah }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Vaksin</label>
                            <select class="form-control select2" style="width: 100%;" id="vaksin-form" name="vaksin"
                                required>
                                <option disabled selected>Pilih Vaksin</option>
                                <option value="1">
                                    Vaksin 1</option>
                                <option value="2">
                                    Vaksin 2</option>
                                <option value="3">
                                    Vaksin 3</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
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



    <form id='vaksin-submit-edit'>
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
            $('.select2').select2()
            $('#vaksin-submit').on('submit', function(e) {
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
                                text: 'Data Jamaah-Vaksin berhasil ditambahkan.',
                                didClose: () => {
                                    $('#inlineForm').modal('hide')
                                    $('#vaksin-submit').trigger('reset')
                                    $('#vaksin-table').DataTable().ajax.reload()
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

            $('#vaksin-submit-edit').on('submit', function(e) {
                e.preventDefault()
                const id = $('#id-edit').val()
                const url = 'update-vaksin/' + id
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
                                text: 'Data Jamaah-Vaksin berhasil diupdate.',
                                didClose: () => {
                                    $('#inlineFormEdit').modal('hide')
                                    $('#vaksin-submit-edit').trigger('reset')
                                    $('#vaksin-table').DataTable().ajax.reload()
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

            showVaksin()
        })
        const showVaksin = (filterData = $('#cari').serialize()) => {
            const columns = [{
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'jamaah',
                    render: function(data) {
                        if (data.length > 0) {
                            return data[0].namajamaah;
                        }
                        return '';
                    },
                },
                {
                    data: "vaksin",
                    render: function(data, type, full, row) { 
                        return 'Vaksin ke -' + data
                    }
                },
                {
                    data: "tanggal"
                },
                {
                    render: function(data, type, full, row) {
                        return `<div style='width:85px'>` +
                            ` <button type="button" class="btn btn-warning btn-sm" onClick="editVaksin(${full.id})"><i class="fa-solid fa-pen-to-square"></i></button> ` +
                            ` <button type="button" class="btn btn-danger btn-sm" onClick="deleteVaksin(${full.id})"><i class="fa-solid fa-trash"></i></button>` +
                            `</div>`
                    }
                },
            ];

            var table = $('#vaksin-table').DataTable({
                searching: false,
                destroy: true,
                lengthChange: false,
                ajax: {
                    url: "{{ route('vaksin.get') }}" + `?${filterData}`,
                    // data: filterData
                },
                columns: columns
            });

        }
        const cari = () => {
            showVaksin($('#cari').serialize());
        }

        const editVaksin = (id) => {
            $.ajax({
                url: `vaksin/${id}/edit`,
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

        const deleteVaksin = (id) => {
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
                        url: `{{ route('vaksin.destroy', ['vaksin' => ':id']) }}`.replace(':id', id),
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
                                    $('#vaksin-table').DataTable().ajax.reload()
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
