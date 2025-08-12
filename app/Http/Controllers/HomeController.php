<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\NotaDinas;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $tahun = Carbon::now()->year;

        $totalSuratMasuk  = SuratMasuk::whereYear('created_at', $tahun)->count();
        $totalSuratKeluar = SuratKeluar::whereYear('created_at', $tahun)->count();
        $totalNotaDinas   = NotaDinas::whereYear('created_at', $tahun)->count();
        $totalSemua       = $totalSuratMasuk + $totalSuratKeluar + $totalNotaDinas;

        return view('home', compact(
            'totalSuratMasuk',
            'totalSuratKeluar',
            'totalNotaDinas',
            'totalSemua'
        ));
    }
}
