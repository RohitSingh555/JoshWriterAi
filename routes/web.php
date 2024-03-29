<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllowedUsersController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChatGptController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GoogleSheetsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::get('/login', [AuthController::class, 'ShowLoginPage'])->name('login');
Route::post('/post-login', [AuthController::class, 'Authenticate'])->name('Authenticate');
Route::get('/signup', [AuthController::class, 'ShowSignupPage'])->name('signup');
Route::post('/post-signup', [AuthController::class, 'RegisterUser'])->name('RegisterUser');
Route::get('/forget-password', [AuthController::class, 'ShowForgetPasswordPage'])->name('ForgetPassword');
Route::post('/post-forget-password', [AuthController::class, 'PostForgetPassword'])->name('PostForgetPassword');
Route::get('/verify-account', [AuthController::class, 'VerifyUser'])->name('VerifyUser');
Route::post('/post-verify-account', [AuthController::class, 'PostVerifyUser'])->name('PostVerifyUser');

Route::get('/resend-code', [AuthController::class, 'ResendCode'])->name('ResendCode');

Route::get('/m', [AuthController::class, 'ComposerCall']);
Route::get('/mr', [AuthController::class, 'ComposerCallR']);

Route::middleware('VerifyAccount')->group(function () {
    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/', [AuthController::class, 'ShowHomePage'])->name('Home');
        Route::get('/home', [AuthController::class, 'ShowHomePage']);
        Route::get('/history', [AuthController::class, 'history'])->name('history');
        Route::get('/history/{id}', [AuthController::class, 'historyByID'])->name('historyByID');
        Route::get('/variation', [AuthController::class, 'variation']);
        Route::get('/create-post/{name}', [AuthController::class, 'CreatePost'])->name('CreatePost');
        Route::get('/get-post', [ChatGptController::class, 'GetPost'])->name('GetPost');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});




Route::get('auth/social', [GoogleController::class, 'show'])->name('social.login');
Route::get('oauth/{google}', [GoogleController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('/auth/{google}/callback/', [GoogleController::class, 'handleProviderCallback'])->name('social.callback');



Route::prefix('admin')->group(function () {
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::middleware('SecureAdmin')->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
        Route::post('/update-profile', [AdminController::class, 'updateprofile'])->name('admin.updateprofile');
        Route::get('/clear-cache', [AdminController::class, 'clearcache'])->name('clearcache');
        Route::group(['middleware' => 'auth:web'], function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

            Route::prefix('users')->group(function () {
                Route::get('/get', [UserController::class, 'get'])->name('users.get');
                Route::post('/store', [UserController::class, 'store'])->name('users.store');

                Route::get('/histories/{id}', [UserController::class, 'histories'])->name('users.histories');
                Route::get('/history-by-id/{id}', [UserController::class, 'historyById'])->name('users.historyById');

                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');

                Route::post('/update-token/{id}', [UserController::class, 'updateToken'])->name('users.updateToken');

                Route::post('/post-edit', [UserController::class, 'postEdit'])->name('users.postEdit');
                Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
            });

            Route::prefix('allowed-users')->group(function () {
                Route::get('/get', [AllowedUsersController::class, 'get'])->name('allowed_users.get');
                Route::post('/store', [AllowedUsersController::class, 'store'])->name('allowed_users.store');
                Route::get('/histories/{id}', [AllowedUsersController::class, 'histories'])->name('allowed_users.histories');
                Route::get('/history-by-id/{id}', [AllowedUsersController::class, 'historyById'])->name('allowed_users.historyById');
                Route::get('/edit/{id}', [AllowedUsersController::class, 'edit'])->name('allowed_users.edit');
                Route::post('/update-token/{id}', [AllowedUsersController::class, 'updateToken'])->name('allowed_users.updateToken');
                Route::post('/post-edit', [AllowedUsersController::class, 'postEdit'])->name('allowed_users.postEdit');
                Route::delete('/delete/{id}', [AllowedUsersController::class, 'destroy'])->name('allowed_users.delete');
            });
            Route::post('/upload-csv-file', [CSVController::class, 'readCsvFile'])->name('upload-csv-file');
            Route::prefix('token')->group(function () {
                Route::get('/get', [ChatGptController::class, 'edit'])->name('token.get');
                Route::post('/post-edit', [ChatGptController::class, 'postEdit'])->name('token.postEdit');
            });
        });
    });
});
