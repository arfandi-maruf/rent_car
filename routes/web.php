<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Register Routes
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

// Login Routes
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses');
Route::get('logout', [LoginController::class, 'keluar'])->name('login.keluar');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('users', function () {
        return view('users.index');
    })->name('users');

    Route::get('mobil', function () {
        return view('mobil.index');
    })->name('mobil');
    });

    Route::get('trsansaksi',function() {
        return view('transaksi.index');
    })->name('transaksi')->middleware('auth');

    route::get('laporan', function(){
        return view('laporan.index');
    })->name('laporan')->middleware('auth');