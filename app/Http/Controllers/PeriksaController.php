<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Periksa;

class PeriksaController extends Controller
{
    public function index()
    {
        return view('dokter/periksa.index');
    }
}
