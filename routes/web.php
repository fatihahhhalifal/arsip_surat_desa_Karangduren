<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriController;

Route::redirect('/', '/arsip')->name('home');
Route::get('arsip/{arsip}/download', [ArsipController::class, 'download'])->name('arsip.download');
Route::get('arsip/{arsip}/view', [ArsipController::class, 'stream'])->name('arsip.stream');
Route::resource('arsip', ArsipController::class);
Route::resource('kategori', KategoriController::class);
Route::view('/about', 'about')->name('about');
