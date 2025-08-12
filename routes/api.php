<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SkpdController;  // ✅ Import controller SKPD

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini kita daftarkan semua route API. 
| Route ini otomatis menggunakan prefix /api.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ✅ Tambahkan route untuk SKPD search (Select2)
Route::get('/skpd', [SkpdController::class, 'index']);
