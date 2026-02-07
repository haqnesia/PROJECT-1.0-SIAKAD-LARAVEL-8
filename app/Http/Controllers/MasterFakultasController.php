<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\MasterFakultas;

class MasterFakultasController extends Controller
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
        return view('master_fakultas.index');
    }

    # FUNGSI DATA

    public function data(Request $r){

        $result = array('success'=>false);

        try {

            $data = DB::connection('mysql')
                            ->table('master_ta_fakultas')
                            ->orderby('fak_nama')
                            ->get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_fakultas.data',compact('data'))->render());

        return response()->json($result);
    }

    # FUNGSI ADD

    public function add()
    {

        $result = array('success'=>false);

        try {

            # SAAT INI BLOCK TRY MASIH KOSONG

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_fakultas.modal_add')->render());

        return response()->json($result);

    }

    # FUNGSI SAVE
           
    public function save(Request $r)
    {

        $result = array('success'=>false);

        try {

            # VALIADASI
  
            $r->validate([
                'kode' => 'required|unique:master_ta_fakultas,fak_kode',
                'nama' => 'required'
            ]);

            # PROSES SIMPAN

            $data = new MasterFakultas;

            $data->fak_kode         = strtoupper($r->kode);
            $data->fak_nama         = $r->nama;

            $data->created_kode     = $this->UsersID;
            $data->created_nama     = $this->UsersName;
            $data->created_ip       = $r->ip();

            $data->updated_kode     = $this->UsersID;
            $data->updated_nama     = $this->UsersName;
            $data->updated_ip       = $r->ip();

            $data->save();


        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_fakultas.modal_add',compact('data'))->render());

        return response()->json($result);

    }

    # FUNGSI EDIT

    public function edit(Request $r){

        $result = array('success'=>false);

        try {
 
            $kode           = $r->get('kode');
            $data           = MasterFakultas::findOrFail($kode);
            
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_fakultas.modal_edit',compact('data'))->render());

        return response()->json($result);

    }

    # FUNGSI UPDATE

    public function update(Request $r){

        $result = array('success'=>false);

        try {

            # VALIADASI

            $r->validate([
                'kode_edit' => 'required',
                'nama_edit' => 'required'
            ]);

            $kode   = $r->get('kode_edit');
            $data   = MasterFakultas::findOrFail($kode);

            # PROSES UPDATE

            $data->fak_nama         = $r->nama_edit;

            $data->updated_kode     = $this->UsersID;
            $data->updated_nama     = $this->UsersName;
            $data->updated_ip       = $r->ip();

            $data->save();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();	
            return response()->json($result);
        }

        $result['success']  = true;
        $result['html']     = html_normalize(view('master_fakultas.modal_edit',compact('data'))->render());

        return response()->json($result);

    }

    # FUNGSI AKTIF

    public function aktif(Request $r){

        $result = array('success'=>false);

        try {
  
            $r->validate([
                'kode' => 'required|exists:master_ta_fakultas,fak_kode'
            ]);
    
            $kode       = $r->get('kode');
            $data       = MasterFakultas::findOrFail($kode);
    
            # PROSES

            $data->fak_aktif         = 'Y';

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
                'kode' => 'required|exists:master_ta_fakultas,fak_kode'
            ]);
    
            $kode       = $r->get('kode');
            $data       = MasterFakultas::findOrFail($kode);
    
            # PROSES

            $data->fak_aktif         = 'T';

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
