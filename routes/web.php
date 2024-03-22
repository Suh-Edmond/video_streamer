<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FileSharedLinkController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\App;
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

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function (){

    Route::get('/home', [FileController::class, 'manageFiles'])->name('home');

    Route::get('/files', [FileController::class, 'manageFiles'])->name('files');

    Route::get('/users', [UsersController::class, 'manageUsers'])->name('users');

    Route::get('/users/{user}/block', [UsersController::class, 'blockUser'])->name('users.block');

    Route::get('/users/{user}/unblock', [UsersController::class, 'unBlockUser'])->name('users.unblock');

    Route::get('/users/{user}/delete', [UsersController::class, 'deleteUser'])->name('users.delete');

    Route::post('/files/upload', [FileController::class, 'uploadFile'])->name('upload_files');

    Route::post('/files/videos/upload', [FileController::class, 'uploadVideo'])->name('upload_video_files');

    Route::get('/files/{file}/delete', [FileController::class, 'deleteFile'])->name('delete_file');

    Route::get('files/videos/{id}/get_path', [FileController::class, 'getVideoFilePath'])->name('get_video_path');

    Route::get('files/videos/play', [FileController::class, 'playVideo'])->name('play_video');

    Route::get('files/links/sharer/{fileId}', [FileSharedLinkController::class, 'getFileSharedLinks'])->name('file_shared_links');

    Route::get('files/links/sharer/{fileSharedLink}/delete', [FileSharedLinkController::class, 'deleteFileLink'])->name('delete_file_shared_links');

    Route::post('files/links/sharer/{fileSharedLink}/update', [FileSharedLinkController::class, 'updateFileLink'])->name('update_file_shared_links');

    Route::post('files/{fileId}/links/sharer/create', [FileSharedLinkController::class, 'createFileSharedLink'])->name('create_file_shared_link');

    Route::get('change_language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change_language');

    Route::post("create_account", [RegisterController::class, 'createUserAccount'])->name("create_account");
});

Route::middleware('guest')->group(function (){
    Route::get('/files/{id}/sharer/{sharedCode}/code', [FileController::class, 'setStreamVideo'])->name("set_stream_video");

    Route::get('/files/videos/get_stream', [FileController::class, 'getStreamVideo'])->name("get_stream_video");

    Route::get('/files/{id}/view_image', [FileController::class, 'viewSharedImage'])->name('view_share_image');

    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('change_language_guest/{locale}', [LanguageController::class, 'changeLanguageGuest'])->name('change_language_guest');

});


Route::get('/files/{id}', [FileController::class, 'getFile']) -> name('get_file');
