<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\NotaDinasController;
use App\Http\Controllers\ArsipSuratMasukController;
use App\Http\Controllers\ArsipSuratKeluarController;
use App\Http\Controllers\ArsipNotaDinasController;

// 🔹 Halaman Dashboard
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔹 Arsip Surat Masuk
Route::prefix('arsip/surat-masuk')->name('arsip.surat-masuk.')->group(function () {
    Route::get('/', [ArsipSuratMasukController::class, 'form'])->name('form');
    Route::get('/preview', [ArsipSuratMasukController::class, 'preview'])->name('preview');
    Route::get('/export/excel', [ArsipSuratMasukController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [ArsipSuratMasukController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/export/word', [ArsipSuratMasukController::class, 'exportWord'])->name('export.word');
    Route::get('/download/{id}', [ArsipSuratMasukController::class, 'download'])->name('download'); // ✅ Tambahan: Download file dari arsip
});

// 🔹 Arsip Surat Keluar
Route::prefix('arsip/surat-keluar')->name('arsip.surat-keluar.')->group(function () {
    Route::get('/', [ArsipSuratKeluarController::class, 'form'])->name('form');
    Route::get('/preview', [ArsipSuratKeluarController::class, 'preview'])->name('preview');
    Route::get('/export/excel', [ArsipSuratKeluarController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [ArsipSuratKeluarController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/export/word', [ArsipSuratKeluarController::class, 'exportWord'])->name('export.word');
});

// 🔹 Arsip Nota Dinas
Route::prefix('arsip/nota-dinas')->name('arsip.nota-dinas.')->group(function () {
    Route::get('/', [ArsipNotaDinasController::class, 'form'])->name('form');
    Route::get('/preview', [ArsipNotaDinasController::class, 'preview'])->name('preview');
    Route::get('/export/excel', [ArsipNotaDinasController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [ArsipNotaDinasController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/export/word', [ArsipNotaDinasController::class, 'exportWord'])->name('export.word');
});

// 🔹 CRUD Surat Masuk / Keluar / Nota Dinas
Route::resource('surat-masuk', SuratMasukController::class);
Route::resource('surat-keluar', SuratKeluarController::class);
Route::resource('nota-dinas', NotaDinasController::class);

// 🔸 Tambahan khusus: Download file surat masuk biasa
Route::get('/surat-masuk/download/{id}', [SuratMasukController::class, 'download'])->name('surat-masuk.download');
