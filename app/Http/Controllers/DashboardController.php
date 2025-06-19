<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use SebastianBergmann\Type\VoidType;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m") * 1;//1 atau Januari
        $tahunini = date("Y");//2025
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->first();  
        $historibulanini = DB::table('presensi')->whereRaw('MONTH(tgl_presensi)="' .$bulanini. '"')
            ->where('nik',$nik)
            ->whereRaw('MONTH(tgl_presensi) = ?', [$bulanini])
            ->whereYear('tgl_presensi', $tahunini)
            ->orderBy('tgl_presensi')
            ->get();
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:00",1,0))  as jmlterlambat')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' .$bulanini . '"')
            ->whereYear('tgl_presensi', $tahunini)
            ->first();

        $leaderboard = DB::table('presensi')
            ->join('karyawan', 'presensi.nik','=','karyawan.nik')
            ->where('tgl_presensi', $hariini)
            ->orderBy('jam_in')
            ->get();
        

        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        
        
        return view('dashboard.dashboard', compact(
            'presensihariini',
            'historibulanini','namabulan','bulanini','tahunini','rekappresensi','leaderboard'));
    }
}
