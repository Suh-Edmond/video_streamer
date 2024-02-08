<?php

use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/files', [FileController::class, 'manageFiles'])->name('files');

    Route::get('/users', [UsersController::class, 'manageUsers'])->name('users');

    Route::post('/users/{id}/block', [UsersController::class, 'blockUser'])->name('users.block');

    Route::post('/users/{id}/unblock', [UsersController::class, 'unBlockUser'])->name('users.unblock');

    Route::post('/users/{id}/delete', [UsersController::class, 'deleteUser'])->name('users.delete');

    Route::post('/files/upload', [FileController::class, 'uploadFile'])->name('upload_files');

    Route::post('/files/{id}/delete', [FileController::class, 'deleteImage'])->name('delete_file');

    Route::get("files/{id}/get_share_link", [QRCodeController::class, 'generateShareLink'])->name('share_link');
});

Route::middleware('guest')->group(function (){
    Route::get('/files/{id}/share/code', [QRCodeController::class, 'generateQRCode'])->name('scan_qrcode');
});

