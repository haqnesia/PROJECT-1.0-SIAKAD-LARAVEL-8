@extends('layouts.template')   

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Fakultas</h5>

        <!-- BUTTON MODAL -->

        <button class="btn btn-primary btn-sm" data-act="baru">
            + Tambah
        </button>

    </div>

    <div id="data_view"></div>
    
</div>

<div class="modal modal-default fade" id="formModalAdd">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="background-color: #ffffff"></div>
    </div>
</div>

@endsection

@section('js')
<script>

    $(document).ready(function () {
        view_data();
    });

    // AJAX TAMPIL

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

    // AJAX ADD

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

    // AJAX SAVE

    $(document).on('submit', '#fakultas_save', function (e) {
        e.preventDefault();

        var form = this;
        $(form).find('button[type=submit]').prop('disabled', true);

        $.post($(form).attr('action'), $(form).serialize())
            .done(function (r) {
                if (r.success) {
                    $('#formModalAdd').modal('hide');
                    alert('Data berhasil disimpan');
                    // view_data();
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


</script>
@endsection
