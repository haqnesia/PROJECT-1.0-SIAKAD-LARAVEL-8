@extends('layouts.template')

@section('css')
@endsection

@section('content')
<div class="card">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">Data Fakultas</h5>

        <button class="btn btn-primary btn-sm" data-act="baru">
            + Tambah Fakultas
        </button>
        
    </div>

    <div id="data_view"></div>

</div>

<div class="modal modal-default fade" id="formModalAdd">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="background-color: #ffffff"></div>
    </div>
</div>

<div class="modal modal-default fade" id="formModalEdit">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="background-color: #ffffff"></div>
    </div>
</div>
@endsection


@section('js')
<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        view_data();
    });

    function view_data() {
        $.get("{{ route('fakultas.data') }}")
            .done(function (r) {
                if (r.success) {
                    $('#data_view').html(r.html);
                } else {
                    alert(r.message);
                }
            })
            .fail(function (x) {
                alert(x.status + ' - ' + x.statusText);
            });
    }

    // =======================
    // TOMBOL TAMBAH (OPEN MODAL)
    // =======================

    $(document).on('click', '[data-act=baru]', function (e) {
        e.preventDefault();

        $.get("{{ route('fakultas.add') }}")
            .done(function (r) {
                if (r.success) {
                    $('#formModalAdd .modal-content').html(r.html);
                    $('#formModalAdd').modal('show');
                } else {
                    alert(r.message);
                }
            })
            .fail(function (x) {
                alert(x.status + ' - ' + x.statusText);
            });
    });

    // =======================
    // SIMPAN DATA (POST)
    // =======================

    $(document).on('submit', '#fakultas_save', function (e) {
        e.preventDefault();

        var form = this;
        $(form).find('button[type=submit]').prop('disabled', true);

        $.post($(form).attr('action'), $(form).serialize())
            .done(function (r) {
                if (r.success) {
                    $('#formModalAdd').modal('hide');
                    alert('Data berhasil disimpan');
                    view_data();
                } else {
                    alert(r.message);
                }
            })
            .fail(function (x) {
                alert(x.status + ' - ' + x.statusText);
            })
            .always(function () {
                $(form).find('button[type=submit]').prop('disabled', false);
            });
    });

    // =======================
    // EDIT DATA (OPEN MODAL)
    // =======================

    $(document).on('click', '[data-act=item_edit]', function (e) {
        e.preventDefault();

        var kode = $(this).data('kode');

        $.get("{{ route('fakultas.edit') }}", { kode: kode })
            .done(function (r) {
                if (r.success) {
                    $('#formModalEdit .modal-content').html(r.html);
                    $('#formModalEdit').modal('show');
                } else {
                    alert(r.message);
                }
            })
            .fail(function (x) {
                alert(x.status + ' - ' + x.statusText);
            });
    });

    // =======================
    // UPDATE DATA (POST)
    // =======================

    $(document).on('submit', '#fakultas_update', function (e) {
        e.preventDefault();

        var form = this;
        $(form).find('button[type=submit]').prop('disabled', true);

        $.post($(form).attr('action'), $(form).serialize())
            .done(function (r) {
                if (r.success) {
                    $('#formModalEdit').modal('hide');
                    alert('Data berhasil diupdate');
                    view_data();
                } else {
                    alert(r.message);
                }
            })
            .fail(function (x) {
                alert(x.status + ' - ' + x.statusText);
            })
            .always(function () {
                $(form).find('button[type=submit]').prop('disabled', false);
            });
    });

    // =======================
    // AKTIFKAN DATA (POST)
    // =======================

    $(document).on('click', '[data-act=item_aktif]', function (e) {
        e.preventDefault();

        if (!confirm('Yakin ingin mengaktifkan data ini?')) return;

        var kode = $(this).data('kode');

        $.post("{{ route('fakultas.aktif') }}", { kode: kode })
            .done(function (r) {
                if (r.success) {
                    alert('Data berhasil diaktifkan');
                    view_data();
                } else {
                    alert(r.message);
                }
            })
            .fail(function (x) {
                alert(x.status + ' - ' + x.statusText);
            });
    });

    // =======================
    // NONAKTIFKAN DATA (POST)
    // =======================

    $(document).on('click', '[data-act=item_nonaktif]', function (e) {
        e.preventDefault();

        if (!confirm('Yakin ingin menonaktifkan data ini?')) return;

        var kode = $(this).data('kode');

        $.post("{{ route('fakultas.nonaktif') }}", { kode: kode })
            .done(function (r) {
                if (r.success) {
                    alert('Data berhasil dinonaktifkan');
                    view_data();
                } else {
                    alert(r.message);
                }
            })
            .fail(function (x) {
                alert(x.status + ' - ' + x.statusText);
            });
    });

</script>
@endsection

