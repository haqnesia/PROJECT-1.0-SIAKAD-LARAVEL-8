<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterMahasiswa extends Model
{
    protected $connection   = 'mysql';
    protected $table        = 'master_tb_mahasiswa';
    protected $primaryKey   = 'mahasiswa_nim';
    protected $keyType      = 'string';
    public $incrementing    = false;

    public static function autokode($tahun_masuk)
    {

        $prefix = 'MHS'.$tahun_masuk;

        $data = DB::connection('mysql')
                    ->table('master_tb_mahasiswa')
                    ->select(DB::raw("MAX(RIGHT(mahasiswa_kode,5)) as kd_max"))
                    ->where('mahasiswa_kode','like',$prefix.'%');

        if($data->count() > 0)
        {
            foreach($data->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd  = $prefix.sprintf("%05s", $tmp);
            }
        }
        else
        {
            $kd = $prefix.'00001';
        }

        return ($kd);

    }

    public static function autonim($tahun_masuk, $prodi_kode)
    {

        $prefix = $tahun_masuk.$prodi_kode;

        $data = DB::connection('mysql')
                        ->table('master_tb_mahasiswa')
                        ->select(DB::raw("MAX(RIGHT(mahasiswa_nim,5)) as kd_max"))
                        ->where('mahasiswa_nim','like',$prefix.'%')
                        ->first();

        if($data->kd_max != null)
        {
            $tmp = ((int)$data->kd_max)+1;
            $kd  = $prefix.sprintf("%05s", $tmp);
        }
        else
        {
            $kd = $prefix.'00001';
        }

        return ($kd);

    }



}
