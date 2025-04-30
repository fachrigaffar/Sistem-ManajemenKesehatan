<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dokter()
    {
        if (auth()->user()->role !== 'dokter') {
            abort(403, 'Unauthorized action.');
        }
        return view('dokter.index');
    }
    
    public function pasien()
    {
        if (auth()->user()->role !== 'pasien') {
            abort(403, 'Unauthorized action.');
        }
        return view('pasien.index');
    }
}
