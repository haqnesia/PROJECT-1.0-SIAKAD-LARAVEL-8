<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\MasterProdi;

class MasterProdiController extends Controller
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
        return view('master_prodi.index');
    }

    # FUNGSI DATA

    public function data(Request $r){

        $result = array('success'=>false);

        try {

            $data = DB::connection('mysql')
                            ->table('master_ta_prodi as aa')
                            ->leftJoin('master_ta_fakultas as bb', 'bb.fak_kode', '=', 'aa.fak_kode')
                            ->select(
                                'aa.*',
                                'bb.fak_nama',
                                'bb.fak_aktif'
                            )
                            ->orderby('bb.fak_nama')
                            ->orderby('aa.prodi_nama')
                            ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_prodi.data',compact('data'))->render());

        return response()->json($result);
    }

    # FUNGSI ADD

    public function add()
    {

        $result = array('success'=>false);

        try {

            # Get Select

            $select_fakultas = DB::connection('mysql')
                                        ->table('master_ta_fakultas')
                                        ->orderby('fak_nama')
                                        ->where('fak_aktif','Y')
                                        ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_prodi.modal_add',compact('select_fakultas'))->render());

        return response()->json($result);

    }

    # FUNGSI SAVE

    public function save(Request $r)
    {

        $result = array('success'=>false);

        try {

            # VALIADASI

            $r->validate([
                'fakultas'      => 'required|exists:master_ta_fakultas,fak_kode,fak_aktif,Y',
                'kode'          => 'required|unique:master_ta_prodi,prodi_kode',
                'nama'          => 'required',
                'strata'        => 'required|in:D3,D4,S1,S2,S3'
            ]);

            # PROSES SIMPAN

            $data = new MasterProdi;

            $data->fak_kode         = $r->fakultas;
            $data->prodi_kode       = $r->kode;
            $data->prodi_nama       = $r->nama;
            $data->prodi_strata     = $r->strata;

            $data->created_kode     = $this->UsersID;
            $data->created_nama     = $this->UsersName;
            $data->created_ip       = $r->ip();

            $data->updated_kode     = $this->UsersID;
            $data->updated_nama     = $this->UsersName;
            $data->updated_ip       = $r->ip();

            $data->save();

            # Get Select

            $select_fakultas = DB::connection('mysql')
                                        ->table('master_ta_fakultas')
                                        ->orderby('fak_nama')
                                        ->where('fak_aktif','Y')
                                        ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_prodi.modal_add',compact('data','select_fakultas'))->render());

        return response()->json($result);

    }

    # FUNGSI EDIT

    public function edit(Request $r){

        $result = array('success'=>false);

        try {

            $kode           = $r->get('kode');
            $data           = MasterProdi::findOrFail($kode);

            # Get Select

            $select_fakultas = DB::connection('mysql')
                                        ->table('master_ta_fakultas')
                                        ->orderby('fak_nama')
                                        ->where('fak_aktif','Y')
                                        ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_prodi.modal_edit',compact('data','select_fakultas'))->render());

        return response()->json($result);

    }

    # FUNGSI UPDATE

    public function update(Request $r){

        $result = array('success'=>false);

        try {

            # VALIADASI

            $r->validate([
                'kode_edit'         => 'required',
                'fakultas_edit'     => 'required|exists:master_ta_fakultas,fak_kode,fak_aktif,Y',
                'nama_edit'         => 'required',
                'strata_edit'       => 'required|in:D3,D4,S1,S2,S3'
            ]);

            $kode   = $r->get('kode_edit');
            $data   = MasterProdi::findOrFail($kode);

            # PROSES UPDATE

            $data->fak_kode         = $r->fakultas_edit;
            $data->prodi_nama       = $r->nama_edit;
            $data->prodi_strata     = $r->strata_edit;

            $data->updated_kode     = $this->UsersID;
            $data->updated_nama     = $this->UsersName;
            $data->updated_ip       = $r->ip();

            $data->save();

            # Get Select

            $select_fakultas = DB::connection('mysql')
                                        ->table('master_ta_fakultas')
                                        ->orderby('fak_nama')
                                        ->where('fak_aktif','Y')
                                        ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_prodi.modal_edit',compact('data','select_fakultas'))->render());

        return response()->json($result);

    }

    # FUNGSI AKTIF

    public function aktif(Request $r){

        $result = array('success'=>false);

        try {

            $r->validate([
                'kode' => 'required|exists:master_ta_prodi,prodi_kode'
            ]);

            $kode       = $r->get('kode');
            $data       = MasterProdi::findOrFail($kode);

            # PROSES

            $data->prodi_aktif      = 'Y';

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

    public function nonaktif(Request $r){

        $result = array('success'=>false);

        try {

            $r->validate([
                'kode' => 'required|exists:master_ta_prodi,prodi_kode'
            ]);

            $kode       = $r->get('kode');
            $data       = MasterProdi::findOrFail($kode);

            # PROSES

            $data->prodi_aktif      = 'T';

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
