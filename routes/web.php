<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/sign-in', function () {
    return view('index');
});
Route::get('/', function () {
    return view('index');
});
Route::get('/sign-up', function () {
    return view('sign_up');
});

Route::get('/auth/google/login', [UserController::class, 'googleService']);
Route::get('/auth/google/callback', [UserController::class, 'googleCallback']);
Route::get('/auth/linkedin/login', [UserController::class, 'linkedinService']);
Route::get('/auth/linkedin/callback', [UserController::class, 'linkedinCallback']);
Route::post('/sign-up', [UserController::class, 'create']);
Route::post('/sign-in', [UserController::class, 'index']);

Route::middleware(['shield'])->group(function () {
    Route::view('/home', 'home');
    Route::post('/add-template', [HomeController::class, 'store']);
    Route::get('/bulk-email', [HomeController::class, 'index']);
    Route::post('/send-mail', [HomeController::class, 'sendMail']);
});