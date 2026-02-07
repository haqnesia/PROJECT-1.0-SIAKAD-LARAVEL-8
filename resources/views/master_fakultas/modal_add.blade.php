<div class="modal-header">
    <h5 class="modal-title">Tambah Fakultas</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form id="fakultas_save" action="{{ route('fakultas.save') }}" method="post">

    @csrf

    <div class="modal-body">
        <div class="form-group">
            <label>Kode Fakultas</label>
            <input type="text" class="form-control" name="kode" id="kode" required>
        </div>

        <div class="form-group">
            <label>Nama Fakultas</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            Batal
        </button>
        <button type="submit" class="btn btn-primary btn-sm">
            Simpan
        </button>
    </div>
</form>
