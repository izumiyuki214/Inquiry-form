<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
Route::get('/', [ContactController::class, 'index'])->name('contact');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::get('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);


// ユーザー認証

Route::post('/register', [UserController::class, 'store']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'authenticate']);
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/logout', [UserController::class, 'logout']);
});


// 管理画面
Route::get('/search', [AdminController::class, 'search']);
Route::get('/reset', [AdminController::class, 'index']);
Route::delete('/delete/{id}', [AdminController::class, 'delete']);
Route::get('/export', [AdminController::class, 'export']);