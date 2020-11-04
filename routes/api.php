<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/members', [MemberController::class, 'index'])->name('getmembers');
Route::get('/cars', [CarController::class, 'index'])->name('getcars');
Route::get('/adresses', [AddressController::class, 'index'])->name('getaddresses');

Route::post('/members', [MemberController::class, 'store'])->name('postmember');

