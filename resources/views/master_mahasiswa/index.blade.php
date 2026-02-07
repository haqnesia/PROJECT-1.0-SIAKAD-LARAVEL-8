@extends('layouts.template')   

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Mahasiswa</h5>

        <!-- BUTTON MODAL -->
        <button class="btn btn-primary btn-sm"
                data-toggle="modal"
                data-target="#formModalAdd">
            + Tambah
        </button>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode</th>
                <th>Nama Fakultas</th>
                <th width="5%">Aktif</th>
                <th width="20%">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">1</td>
                <td class="text-center">FK</td>
                <td>Fakultas Kedokteran</td>
                <td class="text-center">Y</td>
                <td class="text-center">
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-success btn-sm"> <i class="fas fa-check"></i></button>
                        <button class="btn btn-danger btn-sm"> <i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td class="text-center">FH</td>
                <td>Fakultas Hukum</td>
                <td class="text-center">Y</td>
                <td class="text-center">
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-success btn-sm"> <i class="fas fa-check"></i></button>
                        <button class="btn btn-danger btn-sm"> <i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
