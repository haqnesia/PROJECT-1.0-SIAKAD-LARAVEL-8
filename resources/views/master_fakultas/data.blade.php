<div class="card-body">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%" class="text-center">Kode</th>
                <th>Nama Fakultas</th>
                <th width="5%" class="text-center">Aktif</th>
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
                        {{ $row->fak_kode }}
                    </td>

                    <td>
                        {{ $row->fak_nama }}
                    </td>

                    <td class="text-center">
                        @if($row->fak_aktif == 'Y')
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-warning btn-sm" data-act="item_edit" data-kode="{{ $row->fak_kode }}"> <i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-success btn-sm" data-act="item_aktif" data-kode="{{ $row->fak_kode }}"> <i class="fas fa-check"></i></button>
                            <button class="btn btn-danger btn-sm" data-act="item_nonaktif" data-kode="{{ $row->fak_kode }}"> <i class="fas fa-times"></i></button>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Data fakultas belum tersedia
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
