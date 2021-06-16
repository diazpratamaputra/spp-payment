<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\spp;
use App\Models\uangBangunan;

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

    public function spp($tahun)
    {
        $years = DB::table('spp')->where('id_siswa', Auth::user()->id)->where("tahun", $tahun)->get();
        $paraTahun = $tahun;
        $bulanArray = [];
        $bulanSPP = [];
        $dataBulan = [];
        for ($i = 0; $i < 12; $i++) {
            $data = DB::table('spp')->where('bulan', $i + 1)->where('id_siswa', Auth::user()->id)->where('tahun', $tahun)->first();
            $dataBulan[$i] = ($data === null) ? ' ' : 'disabled';
        }
        return view('spp_payment', compact('dataBulan', 'paraTahun'));
    }

    public function uangBangunan()
    {
        return view('uangBangunan_payment');
    }

    public function index()
    {
        $Output = "";
        $totalSudahDibayar = 0;
        $paraTahun = date('Y');
        $years = DB::table('spp')->where('id_siswa', Auth::user()->id)->where("tahun", $paraTahun)->get();
        $bulanArray = [];
        $bulanSPP = [];
        for ($i = 0; $i < 12; $i++) {
            $data = DB::table('spp')->where('bulan', $i + 1)->where('id_siswa', Auth::user()->id)->where('tahun', $paraTahun)->first();
            $bulanArray[$i] = ($data === null) ? 'Belum lunas' : 'Lunas';
            $bulanSPP[$i] = ($data === null) ? 'bg-light' : 'table-light';
        }
        $uangBangunan = 9000000;
        $buildingCost = DB::table('uangBangunan')->where('id_siswa', Auth::user()->id)->latest()->limit(1)->get();
        if ($buildingCost == null) {
            $totalSudahDibayar = 0;
            $Output = $uangBangunan;
        } else {
            foreach ($buildingCost as $key) {
                $totalSudahDibayar = $key->total;
                $Output = $key->sisa;
            }
        }
        return view('home',  compact('years', 'paraTahun', 'bulanArray', 'bulanSPP', 'buildingCost', 'Output', 'totalSudahDibayar', 'uangBangunan'));
    }

    public function histori()
    {
        $siswa = DB::table('siswa')->where('id_users', Auth::user()->id)->first();
        $kelas = DB::table('kelas')->where('id', $siswa->id_kelas)->first();
        $uangbangunan = DB::table('uangBangunan')->where('id_siswa', Auth::user()->id)->get();
        $totaluangbangunan = 9000000;

        return view('uangBangunan_histori', compact('siswa', 'kelas', 'uangbangunan', 'totaluangbangunan'));
    }

    public function spppayment(Request $request, $paraTahun){
        $nominal = 200000;
        $tahun = $paraTahun;
        switch($request->bulan){
            case "Januari":
                $bulan = 1;
                break;
            case "Febuari":
                $bulan = 2;
                break;
            case "Maret":
                $bulan = 3;
                break;
            case "April":
                $bulan = 4;
                break;
            case "Mei":
                $bulan = 5;
                break;
            case "Juni":
                $bulan = 6;
                break;
            case "Juli":
                $bulan = 7;
                break;
            case "Agustus":
                $bulan = 8;
                break;
            case "September":
                $bulan = 9;
                break;
            case "Oktober":
                $bulan = 10;
                break;
            case "November":
                $bulan = 11;
                break;
            case "Desember":
                $bulan = 12;
                break;
        }

        $this->validate($request, [
            'id_siswa' => 'required',
            'bulan' => 'required'
        ]);

        spp::create([
            'id_siswa' => $request->id_siswa,
            'bulan' => $bulan,
            'nominal' => $nominal,
            'tahun' => $tahun
        ]);

        return redirect('/home');
    }

    public function uangBangunanpayment(Request $request)
    {
        $buildingCost = DB::table('uangBangunan')->where('id_siswa', Auth::user()->id)->latest()->limit(1)->get();
        $totalUangBangunan = 9000000;
        $totalSebelum = 0;

        foreach ($buildingCost as $key) {
            $totalSebelum = $key->total;
        }

        $totalBayar = $totalSebelum + $request->nominal;
        $sisaTunggakan = $totalUangBangunan - $totalBayar;

        $this->validate($request, [
            'id_siswa' => 'required',
            'nominal' => 'required'
        ]);

        uangBangunan::create([
            'id_siswa' => $request->id_siswa,
            'nominal' => $request->nominal,
            'total' => $totalBayar,
            'sisa' => $sisaTunggakan
        ]);

        return redirect('/home');
    }
}
