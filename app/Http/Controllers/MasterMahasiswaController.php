<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterMahasiswaController extends Controller
{
    # FUNGSI INDEX

    public function index()
    {
        return view('master_mahasiswa.index');
    }

}
