<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel33">Edit Paket </h4>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>Nama Paket </label>
        <input type="text" placeholder="Nama Paket" name="nama" id="nama_edit" class="form-control" required  value="{{ $data->nama }}">
        <div class="invalid-feedback"></div>
        <input type="hidden" name="id" id="id-edit" value="{{ $data->id }}">
    </div>
    <div class="form-group">
        <label>Harga Paket </label>
        <input type="number" placeholder="Harga Paket" name="harga_paket" id="harga_paket_edit" class="form-control"
            required  value="{{ $data->harga_paket }}">
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group">
        <label>Tgl Keberangkatan</label>
        <input type="date" class="form-control" name="tgl_keberangkatan"
            id="tglkeberangkatan_edit"  value="{{ $data->tgl_keberangkatan }}">
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
