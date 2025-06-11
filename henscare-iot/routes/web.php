<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IotDataController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\IotController;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('home', function () {
    return view('home');
})->name('home');

// Auth routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['verify.jwt'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('tabel-pakan', [IotController::class, 'index'])->name('tabel.pakan');
    Route::get('sensor-health', function () {
        return view('layouts.sensor-health');
    })->name('sensor-health');
    Route::get('status-kandang', function () {
        return view('layouts.status');
    })->name('status');
    Route::get('kontrol-modul', function () {
        return view('layouts.modul-kontrol');
    })->name('kontrol.modul');
});