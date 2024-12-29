<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Apis\AuthController;

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

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'aboutUs')->name('aboutUs');
    Route::get('/service', 'services')->name('service');
    Route::get('/contact-us', 'contactUs')->name('contactUs');
});
Route::view('forgot_password', 'auth.reset_password')->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'passwordReset'])->name('reset');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
