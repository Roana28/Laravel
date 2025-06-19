<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class PresensiController extends Controller
{
    public function create()
    {
        $hariini = date("Y-m-d");   
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();
        return view('presensi.create', compact('cek'));
    }

    public function store(Request $request)
{
    
    $nik = Auth::guard('karyawan')->user()->nik;
    $tgl_presensi = date("Y-m-d");
    $jam = date("H:i:s");
    $latitudekantor = -6.229964711646418;
    $longitudekantor = 106.80697236624897;
    $lokasi = $request->lokasi;
    $lokasiuser = explode(",", $lokasi);
    $latitudeuser = $lokasiuser[0];
    $longitudeuser = $lokasiuser[1];
   
    $jarak = $this->distance($latitudekantor,$longitudekantor,$latitudeuser,$longitudeuser);
    $radius = round($jarak["meters"]);

    $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();
    
    if ($cek > 0) {
        $ket = "out";
    } else {
        $ket = "in";
    }

    $image = $request->image;
    $folderPath = "public/uploads/absensi/";
    $formatName = $nik . "-" . $tgl_presensi . "-". $jam ."-". $ket;    
    $image_parts = explode(";base64", $image);
    $image_base64 = base64_decode($image_parts[1]);
    $formatName = date('YmdHis') . "_" . uniqid();
    $fileName = $formatName . ".png";
    $file = $folderPath . $fileName;


    if($radius > 100) {
        echo "error|Maaf Anda Berada Diluar Radius, Jarak Anda ".$radius." meter dari Kantor|radius";
    }else{

    
        
        
        if ($cek > 0) {
            // Absen pulang
            $data_pulang = [
                'jam_out' => $jam,
                'foto_out' => $fileName,
                'lokasi_out' => $lokasi
            ];
            $update = DB::table('presensi')
                ->where('tgl_presensi', $tgl_presensi)
                ->where('nik', $nik)
                ->update($data_pulang);

        
            if ($update) {
                echo "success|Terimakasih, Hati hati di Jalan|out";
                storage::put($file, $image_base64);
            } else {
                echo "error|Maaf Gagal absen, Hubungi Admin HR|out";
            }
        } else {
                // Absen masuk
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Terimakasih, Selamat Bekerja|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal absen, Hubungi Admin HR|out";
                }
            } 
        }
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
               
        return view('presensi.editprofile',compact('karyawan'));
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp =$request->no_hp;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        if ($request->hasFile('foto')) {
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }

        if (empty($request->password)) {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'password' => $password,        
                'foto' => $foto
            ];
        }

        $update = DB::table('karyawan')->where('nik',$nik)->update($data);
        if ($update) {
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/karyawan/";
                $request->file('foto')->storeAs($folderPath,$foto);
            }
            return Redirect::back()->with(['success'=> 'Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['error'=> 'Data gagal Di Update']);
        }
    }  
    
    
    public function histori()
    {
        $namabulan =["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November",
        "Desember"];
        return view('presensi.histori',compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;

        $histori = DB::table('presensi')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->where('nik',$nik)
        ->orderBy('tgl_presensi')
        ->get();

        return view('presensi.gethistori',compact('histori'));
    }
}