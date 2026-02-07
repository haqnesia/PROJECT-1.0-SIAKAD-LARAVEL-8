<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterProdiController extends Controller
{
    # FUNGSI INDEX

    public function index()
    {
        return view('master_prodi.index');
    }
}
