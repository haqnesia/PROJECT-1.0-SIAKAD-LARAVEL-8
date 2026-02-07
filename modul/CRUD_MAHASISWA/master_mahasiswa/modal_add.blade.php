<div class="modal-header">
    <h5 class="modal-title">Tambah Mahasiswa</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form id="mahasiswa_save" action="{{ route('mahasiswa.save') }}" method="post">
    @csrf

    <div class="modal-body">

        <div class="form-group">
            <label>Nama Mahasiswa</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>

        <div class="form-group">
            <label>Program Studi</label>
            <select class="form-control" name="prodi" id="prodi" required>
                @foreach($select_prodi as $row)
                    <option value="{{ $row->prodi_kode }}">{{ $row->prodi_kode }} - {{ $row->prodi_nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Tahun Masuk</label>
                    <input type="text" class="form-control" name="tahun" id="tahun" maxlength="4" required>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jekel" id="jekel" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" name="lahir_tempat" id="lahir_tempat" required>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="lahir_tanggal" id="lahir_tanggal" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Kontak</label>
                    <input type="text" class="form-control" name="kontak" id="kontak" required>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
    </div>
</form>
