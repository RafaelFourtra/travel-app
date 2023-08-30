<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel33">Edit Jamaah-Vaksin </h4>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>Nama Jamaah</label>
        <select class="form-control select2" style="width: 100%;" id="jamaah_id_edit" name="jamaah_id">
            <option disabled selected>Pilih Vaksin</option>
            @foreach ($query as $item)
                <option value="{{ $item->id }}" @if ($data->jamaah_id === $item->id) selected @endif>{{ $item->namajamaah }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback"></div>
        <input type="hidden" name="id" id="id-edit" value="{{ $data->id }}">
    </div>
    <div class="form-group">
        <label>Vaksin</label>
        <select class="form-control select2" style="width: 100%;" id="vaksin_edit" name="vaksin" required>
            <option disabled selected>Pilih Vaksin</option>
            <option value="1" @if ($data->vaksin === '1') selected @endif>
                Vaksin 1</option>
            <option value="2" @if ($data->vaksin === '2') selected @endif>
                Vaksin 2</option>
            <option value="3" @if ($data->vaksin === '3') selected @endif>
                Vaksin 3</option>
        </select>
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $data->tanggal }}"> 
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#jamaah_id_edit').select2()
        $('#vaksin_edit').select2()
    })
</script>
