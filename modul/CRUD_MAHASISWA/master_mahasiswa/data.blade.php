<div class="card-body">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%" class="text-center">NIM</th>
                <th>Nama Mahasiswa</th>
                <th width="15%">Fakultas</th>
                <th width="15%">Prodi</th>
                <th width="5%" class="text-center">Angkatan</th>
                <th width="5%" class="text-center">JK</th>
                <th width="10%" class="text-center">Aktif</th>
                <th width="20%" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($data as $row)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="text-center">
                        {{ $row->mahasiswa_nim }}
                    </td>

                    <td>
                        <b>{{ $row->mahasiswa_nama }}</b>
                        <br>
                        <small class="text-muted">
                            {{ $row->mahasiswa_tempat_lahir }}, {{ $row->mahasiswa_tanggal_lahir }}
                        </small>
                        <br>
                        <small class="text-muted">
                            {{ $row->mahasiswa_kontak }} | {{ $row->mahasiswa_email }}
                        </small>
                    </td>

                    <td>
                        {{ $row->fak_nama ?? '-' }}
                    </td>

                    <td>
                        {{ $row->prodi_nama ?? '-' }}
                        @if(!empty($row->prodi_strata))
                            <br>
                            <small class="text-muted">{{ $row->prodi_strata }}</small>
                        @endif
                    </td>

                    <td class="text-center">
                        {{ $row->mahasiswa_angkatan }}
                    </td>

                    <td class="text-center">
                        {{ $row->mahasiswa_jenis_kelamin }}
                    </td>

                    <td class="text-center">
                        @if($row->mahasiswa_aktif == 'Y')
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-secondary">Nonaktif</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-warning btn-sm" data-act="item_edit" data-nim="{{ $row->mahasiswa_nim }}"> <i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-success btn-sm" data-act="item_aktif" data-nim="{{ $row->mahasiswa_nim }}"> <i class="fas fa-check"></i></button>
                            <button class="btn btn-danger btn-sm" data-act="item_nonaktif" data-nim="{{ $row->mahasiswa_nim }}"> <i class="fas fa-times"></i></button>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">
                        Data mahasiswa belum tersedia
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
