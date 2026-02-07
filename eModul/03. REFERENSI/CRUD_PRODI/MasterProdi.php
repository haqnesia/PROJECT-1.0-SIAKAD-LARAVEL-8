<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProdi extends Model
{
    protected $connection   = 'mysql';
    protected $table        = 'master_ta_prodi';
    protected $primaryKey   = 'prodi_kode';
    protected $keyType      = 'string';
    public $incrementing    = false;
}
