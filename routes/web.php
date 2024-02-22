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

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/home', [FileController::class, 'manageFiles'])->name('home');

    Route::get('/files', [FileController::class, 'manageFiles'])->name('files');

    Route::get('/users', [UsersController::class, 'manageUsers'])->name('users');

    Route::post('/users/{user}/block', [UsersController::class, 'blockUser'])->name('users.block');

    Route::post('/users/{user}/unblock', [UsersController::class, 'unBlockUser'])->name('users.unblock');

    Route::post('/users/{user}/delete', [UsersController::class, 'deleteUser'])->name('users.delete');

    Route::post('/files/upload', [FileController::class, 'uploadFile'])->name('upload_files');

    Route::post('/files/videos/upload', [FileController::class, 'uploadVideo'])->name('upload_video_files');

    Route::post('/files/{id}/delete', [FileController::class, 'deleteFile'])->name('delete_file');

    Route::get("files/{id}/get_share_link", [QRCodeController::class, 'generateShareLink'])->name('share_link');

    Route::get('files/videos/{id}/get_path', [FileController::class, 'getVideoFilePath'])->name('get_video_path');

});

Route::middleware('guest')->group(function (){
    Route::get('/files/{id}/share/code', [QRCodeController::class, 'generateQRCode'])->name('scan_qrcode');

    Route::get('/files/videos/set_stream', [FileController::class, 'setStreamVideo'])->name("set_stream_video");

    Route::get('/files/videos/get_stream', [FileController::class, 'getStreamVideo'])->name("get_stream_video");

    Route::get('/files/images/{name}', [FileController::class, 'viewSharedImage'])->name('view_share_image');
    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::get('/files/{id}', [FileController::class, 'getFile']) -> name('get_file');
