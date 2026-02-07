<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\MasterMahasiswa;

class MasterMahasiswaController extends Controller
{

    # FUNGSI CONSTRUCT

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->UsersID      = Auth::user()->id;
            $this->UsersName    = Auth::user()->name;
            return $next($request);
        });

    }

    # FUNGSI INDEX

    public function index()
    {
        return view('master_mahasiswa.index');
    }

    # FUNGSI DATA

    public function data(Request $r)
    {

        $result = array('success'=>false);

        try {

            $data = DB::connection('mysql')
                        ->table('master_tb_mahasiswa as aa')
                        ->leftJoin('master_ta_prodi as bb', 'bb.prodi_kode', '=', 'aa.prodi_kode')
                        ->leftJoin('master_ta_fakultas as cc', 'cc.fak_kode', '=', 'bb.fak_kode')
                        ->select(
                            'aa.*',
                            'bb.prodi_nama',
                            'bb.prodi_strata',
                            'bb.prodi_aktif',
                            'cc.fak_nama',
                            'cc.fak_aktif'
                        )
                        ->orderby('cc.fak_nama')
                        ->orderby('bb.prodi_nama')
                        ->orderby('aa.mahasiswa_nim')
                        ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_mahasiswa.data', compact('data'))->render());

        return response()->json($result);

    }

    # FUNGSI ADD

    public function add()
    {

        $result = array('success'=>false);

        try {

            # Get Select Prodi (aktif)

            $select_prodi = DB::connection('mysql')
                                ->table('master_ta_prodi')
                                ->orderby('prodi_nama')
                                ->where('prodi_aktif','Y')
                                ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_mahasiswa.modal_add', compact('select_prodi'))->render());

        return response()->json($result);

    }

    # FUNGSI SAVE

    public function save(Request $r)
    {

        $result = array('success'=>false);

        try {

            # VALIDASI

            $r->validate([
                'prodi'             => 'required|exists:master_ta_prodi,prodi_kode,prodi_aktif,Y',
                'nama'              => 'required',
                'tahun'             => 'required|digits:4',
                'lahir_tempat'      => 'required',
                'lahir_tanggal'     => 'required|date',
                'jekel'             => 'required|in:L,P',
                'alamat'            => 'required',
                'kontak'            => 'required',
                'email'             => 'required|email'
            ]);

            # PROSES SIMPAN

            $data = new MasterMahasiswa;

            $data->mahasiswa_kode           = MasterMahasiswa::autokode($r->tahun);
            $data->mahasiswa_nim            = MasterMahasiswa::autonim($r->tahun, $r->prodi);
            $data->prodi_kode               = $r->prodi;
            $data->mahasiswa_nama           = $r->nama;
            $data->mahasiswa_tahun          = $r->tahun;
            $data->mahasiswa_lahir_tempat   = $r->lahir_tempat;
            $data->mahasiswa_lahir_tanggal  = $r->lahir_tanggal;
            $data->mahasiswa_jekel          = $r->jekel;
            $data->mahasiswa_alamat         = $r->alamat;
            $data->mahasiswa_kontak         = $r->kontak;
            $data->mahasiswa_email          = $r->email;

            $data->mahasiswa_aktif          = 'Y';

            $data->created_kode             = $this->UsersID;
            $data->created_nama             = $this->UsersName;
            $data->created_ip               = $r->ip();

            $data->updated_kode             = $this->UsersID;
            $data->updated_nama             = $this->UsersName;
            $data->updated_ip               = $r->ip();

            $data->save();

            # Get Select Prodi (aktif)

            $select_prodi = DB::connection('mysql')
                                ->table('master_ta_prodi')
                                ->orderby('prodi_nama')
                                ->where('prodi_aktif','Y')
                                ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_mahasiswa.modal_add', compact('data','select_prodi'))->render());

        return response()->json($result);

    }

    # FUNGSI EDIT

    public function edit(Request $r)
    {

        $result = array('success'=>false);

        try {

            $kode   = $r->get('kode');
            $data   = MasterMahasiswa::findOrFail($kode);

            # Get Select Prodi (aktif)

            $select_prodi = DB::connection('mysql')
                                ->table('master_ta_prodi')
                                ->orderby('prodi_nama')
                                ->where('prodi_aktif','Y')
                                ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_mahasiswa.modal_edit', compact('data','select_prodi'))->render());

        return response()->json($result);

    }

    # FUNGSI UPDATE

    public function update(Request $r)
    {

        $result = array('success'=>false);

        try {

            # VALIDASI

            $r->validate([
                'prodi_edit'         => 'required|exists:master_ta_prodi,prodi_kode,prodi_aktif,Y',
                'nama_edit'          => 'required',
                'tahun_edit'         => 'required|digits:4',
                'lahir_tempat_edit'  => 'required',
                'lahir_tanggal_edit' => 'required|date',
                'jekel_edit'         => 'required|in:L,P',
                'alamat_edit'        => 'required',
                'kontak_edit'        => 'required',
                'email_edit'         => 'required|email'
            ]);

            $kode   = $r->get('kode');
            $data   = MasterMahasiswa::findOrFail($kode);

            # PROSES UPDATE (NIM UNIQUE - TIDAK DIUBAH)

            $data->prodi_kode               = $r->prodi_edit;
            $data->mahasiswa_nama           = $r->nama_edit;
            $data->mahasiswa_tahun          = $r->tahun_edit;
            $data->mahasiswa_lahir_tempat   = $r->lahir_tempat_edit;
            $data->mahasiswa_lahir_tanggal  = $r->lahir_tanggal_edit;
            $data->mahasiswa_jekel          = $r->jekel_edit;
            $data->mahasiswa_alamat         = $r->alamat_edit;
            $data->mahasiswa_kontak         = $r->kontak_edit;
            $data->mahasiswa_email          = $r->email_edit;

            $data->updated_kode             = $this->UsersID;
            $data->updated_nama             = $this->UsersName;
            $data->updated_ip               = $r->ip();

            $data->save();

            # Get Select Prodi (aktif)

            $select_prodi = DB::connection('mysql')
                                ->table('master_ta_prodi')
                                ->orderby('prodi_nama')
                                ->where('prodi_aktif','Y')
                                ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_mahasiswa.modal_edit', compact('data','select_prodi'))->render());

        return response()->json($result);

    }

    # FUNGSI AKTIF

    public function aktif(Request $r)
    {

        $result = array('success'=>false);

        try {

            $r->validate([
                'nim' => 'required|exists:master_tb_mahasiswa,mahasiswa_nim'
            ]);

            $kode   = $r->get('kode');
            $data   = MasterMahasiswa::findOrFail($kode);

            # PROSES

            $data->mahasiswa_aktif  = 'Y';

            $data->updated_kode     = $this->UsersID;
            $data->updated_nama     = $this->UsersName;
            $data->updated_ip       = $r->ip();

            $data->save();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success']  = true;

        return response()->json($result);

    }

    # FUNGSI NON AKTIF

    public function nonaktif(Request $r)
    {

        $result = array('success'=>false);

        try {

            $r->validate([
                'nim' => 'required|exists:master_tb_mahasiswa,mahasiswa_nim'
            ]);

            $kode   = $r->get('kode');
            $data   = MasterMahasiswa::findOrFail($kode);

            # PROSES

            $data->mahasiswa_aktif  = 'T';

            $data->updated_kode     = $this->UsersID;
            $data->updated_nama     = $this->UsersName;
            $data->updated_ip       = $r->ip();

            $data->save();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success']  = true;

        return response()->json($result);

    }

}
