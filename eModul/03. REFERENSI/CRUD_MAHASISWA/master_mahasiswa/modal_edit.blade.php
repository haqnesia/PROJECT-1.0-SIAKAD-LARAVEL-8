<div class="modal-header">
    <h5 class="modal-title">Edit Mahasiswa</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form id="mahasiswa_update" action="{{ route('mahasiswa.update') }}" method="post">
    @csrf

    <div class="modal-body">

        <div class="form-group">
            <label>NIM</label>
            <input type="text" class="form-control" name="nim_edit" id="nim_edit" value="{{ $data->mahasiswa_nim }}" required>
        </div>

        <div class="form-group">
            <label>Nama Mahasiswa</label>
            <input type="text" class="form-control" name="nama_edit" id="nama_edit" value="{{ $data->mahasiswa_nama }}" required>
        </div>

        <div class="form-group">
            <label>Program Studi</label>
            <select class="form-control" name="prodi_edit" id="prodi_edit" required>
                @foreach($select_prodi as $row)
                    <option value="{{ $row->prodi_kode }}" {{ $data->prodi_kode == $row->prodi_kode ? 'selected' : '' }}>
                        {{ $row->prodi_kode }} - {{ $row->prodi_nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Tahun Masuk</label>
                    <input type="text" class="form-control" name="tahun_edit" id="tahun_edit" maxlength="4" value="{{ $data->mahasiswa_tahun }}" required>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jekel_edit" id="jekel_edit" required>
                        <option value="">- pilih -</option>
                        <option value="L" {{ $data->mahasiswa_jekel == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $data->mahasiswa_jekel == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" name="lahir_tempat_edit" id="lahir_tempat_edit" value="{{ $data->mahasiswa_lahir_tempat }}" required>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="lahir_tanggal_edit" id="lahir_tanggal_edit" value="{{ $data->mahasiswa_lahir_tanggal }}" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat_edit" id="alamat_edit" rows="3" required>{{ $data->mahasiswa_alamat }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Kontak</label>
                    <input type="text" class="form-control" name="kontak_edit" id="kontak_edit" value="{{ $data->mahasiswa_kontak }}" required>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email_edit" id="email_edit" value="{{ $data->mahasiswa_email }}" required>
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning btn-sm">Update</button>
    </div>
</form>
