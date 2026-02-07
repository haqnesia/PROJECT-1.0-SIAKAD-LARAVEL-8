<div class="modal-header">
    <h5 class="modal-title">Edit Prodi</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form id="prodi_update" action="{{ route('prodi.update') }}" method="post">

    @csrf

    <div class="modal-body">

        <div class="form-group">
            <label>Kode Prodi</label>
            <input type="text" class="form-control" name="kode_edit" id="kode_edit" value="{{ $data->prodi_kode }}" readonly="readonly" required>
        </div>

        <div class="form-group">
            <label>Fakultas</label>
            <select class="form-control" name="fakultas_edit" id="fakultas_edit" required>
                @foreach($select_fakultas as $row)
                    <option value="{{ $row->fak_kode }}" @if($data->fak_kode == $row->fak_kode) selected @endif>
                        {{ $row->fak_kode }} - {{ $row->fak_nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Nama Prodi</label>
            <input type="text" class="form-control" name="nama_edit" id="nama_edit" value="{{ $data->prodi_nama }}" required>
        </div>

        <div class="form-group">
            <label>Strata</label>
            <select class="form-control" name="strata_edit" id="strata_edit" required>
                <option value="D3" @if($data->prodi_strata == 'D3') selected @endif>[ D3 ] Diploma 3</option>
                <option value="D4" @if($data->prodi_strata == 'D4') selected @endif>[ D4 ] Diploma 4</option>
                <option value="S1" @if($data->prodi_strata == 'S1') selected @endif>[ S1 ] Sarjana</option>
                <option value="S2" @if($data->prodi_strata == 'S2') selected @endif>[ S2 ] Magister</option>
                <option value="S3" @if($data->prodi_strata == 'S3') selected @endif>[ S3 ] Doktor</option>
            </select>
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
