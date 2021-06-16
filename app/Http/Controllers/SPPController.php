<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SPPController extends Controller
{

    public function thn($tahun){
        $years = DB::table('spp')->where('id_siswa', Auth::user()->id)->where("tahun", $tahun)->get();
        $paraTahun = $tahun;
        $bulanArray = [];
        $bulanSPP = [];
        for ($i = 0; $i < 12; $i++) {
            $data = DB::table('spp')->where('bulan', $i + 1)->where('id_siswa', Auth::user()->id)->where('tahun', $tahun)->first();
            $bulanArray[$i] = ($data === null) ? 'Belum lunas' : 'Lunas';
            $bulanSPP[$i] = ($data === null) ? 'bg-light' : 'table-light';
        }
        $buildingCost = DB::table('uangBangunan')->where('id_siswa', Auth::user()->id)->orderBy('created_at', 'desc')->limit(1)->get();

        return view('home',  compact('years', 'paraTahun', 'bulanArray', 'bulanSPP', 'buildingCost'));
    }
}
