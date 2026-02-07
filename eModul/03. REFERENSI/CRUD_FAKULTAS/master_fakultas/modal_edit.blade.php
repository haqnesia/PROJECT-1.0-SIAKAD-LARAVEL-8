<div class="modal-header">
    <h5 class="modal-title">Edit Fakultas</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form id="fakultas_update" action="{{ route('fakultas.update') }}" method="post">
    
    @csrf

    <div class="modal-body">
        <div class="form-group">
            <label>Kode Fakultas</label>
            <input type="text" class="form-control" name="kode_edit"  id="kode_edit" value="{{ $data->fak_kode }}" readonly="readonly" required>
        </div>

        <div class="form-group">
            <label>Nama Fakultas</label>
            <input type="text" class="form-control" name="nama_edit"  id="nama_edit" value="{{ $data->fak_nama }}" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            Batal
        </button>
        <button type="submit" class="btn btn-warning btn-sm">
            Update
        </button>
    </div>
</form>
