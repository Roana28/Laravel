<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Response;




Route::get('/foto-karyawan/{filename}', function ($filename) {
    $path = storage_path('app/private/public/uploads/karyawan/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});

Route::get('/absensi-img/{filename}', function ($filename) {
    $path = storage_path('app/private/public/uploads/absensi/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});


Route::get('/absensi-img/{filename}', function ($filename) {
    $path = storage_path('app/private/public/uploads/absensi/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return Response::file($path);
});


Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});




Route::middleware(['guest:karyawan'])->group(function() {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index']);
    Route::get('/proseslogout',[AuthController::class,'proseslogout']);

    
    Route::get('/presensi/create',[PresensiController::class, 'create']);
    Route::post('/presensi/store',[PresensiController::class,'store']);

    //Edit Profile
    Route::get('/editprofile',[PresensiController::class,'editprofile']);
    Route::post('/presensi/{nik}/updateprofile',[PresensiController::class,'updateprofile']);

    //Histori
    Route::get('/presensi/histori',[PresensiController::class,'histori']);
    Route::post('/presensi/gethistori',[PresensiController::class,'gethistori']);
    

});

