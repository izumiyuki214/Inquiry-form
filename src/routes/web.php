<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
// use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 問い合わせフォーム
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);

// ユーザー認証
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

// 管理画面
Route::post('/search', [AdminController::class, 'search']);
Route::post('/reset', [AdminController::class, 'index']);
Route::post('/delete', [AdminController::class, 'delete']);
Route::post('/export', [AdminController::class, 'export']);