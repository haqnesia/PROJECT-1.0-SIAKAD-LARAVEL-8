<div class="modal-header">
    <h5 class="modal-title">Tambah Prodi</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form id="prodi_save" action="{{ route('prodi.save') }}" method="post">

    @csrf

    <div class="modal-body">

        <div class="form-group">
            <label>Fakultas</label>
            <select class="form-control" name="fakultas" id="fakultas" required>
                @foreach($select_fakultas as $row)
                    <option value="{{ $row->fak_kode }}">{{ $row->fak_kode }} - {{ $row->fak_nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Kode Prodi</label>
            <input type="text" class="form-control" name="kode" id="kode" required>
        </div>

        <div class="form-group">
            <label>Nama Prodi</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>

        <div class="form-group">
            <label>Strata</label>
            <select class="form-control" name="strata" id="strata" required>
                <option value="D3">[ D3 ] Diploma 3</option>
                <option value="D4">[ D4 ] Diploma 4</option>
                <option value="S1">[ S1 ] Sarjana</option>
                <option value="S2">[ S2 ] Magister</option>
                <option value="S3">[ S3 ] Doktor</option>
            </select>
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
