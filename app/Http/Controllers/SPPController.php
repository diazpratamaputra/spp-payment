<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SPPController extends Controller
{

    public function thn($tahun){
        $Output = "";
        $totalSudahDibayar = 0;
        $years = DB::table('spp')->where('id_siswa', Auth::user()->id)->where("tahun", $tahun)->get();
        $paraTahun = $tahun;
        $bulanArray = [];
        $bulanSPP = [];
        for ($i = 0; $i < 12; $i++) {
            $data = DB::table('spp')->where('bulan', $i + 1)->where('id_siswa', Auth::user()->id)->where('tahun', $tahun)->first();
            $bulanArray[$i] = ($data === null) ? 'Belum lunas' : 'Lunas';
            $bulanSPP[$i] = ($data === null) ? 'bg-light' : 'table-light';
        }
        $buildingCost = DB::table('uangBangunan')->where('id_siswa', Auth::user()->id)->latest()->limit(1)->get();
        $uangBangunan = 9000000;
        if ($buildingCost == null) {
            $totalSudahDibayar = 0;
            $Output = $uangBangunan;
        } else {
            foreach ($buildingCost as $key) {
                $totalSudahDibayar = $key->total;
                $Output = $key->sisa;
            }
        }
        return view('home',  compact('years', 'paraTahun', 'bulanArray', 'bulanSPP', 'buildingCost', 'uangBangunan', 'Output', 'totalSudahDibayar'));
    }
}
