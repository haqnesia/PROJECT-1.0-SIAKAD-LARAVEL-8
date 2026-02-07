<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFakultas extends Model
{
    protected $connection   = 'mysql';
    protected $table        = 'master_ta_fakultas';
    protected $primaryKey   = 'fak_kode';
    protected $keyType      = 'string';
    public $incrementing    = false;
}












