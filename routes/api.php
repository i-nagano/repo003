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
Route::get('/addresses', [AddressController::class, 'index'])->name('getaddresses');

Route::post('/members', [MemberController::class, 'store'])->name('postmember');
Route::post('/cars', [CarController::class, 'store'])->name('postcar');
Route::post('/addresses', [AddressController::class, 'store'])->name('postaddress');

Route::put('/members/{id}', [MemberController::class, 'update'])->name('updatemember');
Route::put('/cars/{id}', [CarController::class, 'update'])->name('updatecar');
Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('updateaddress');

Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('destroymember');
Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('destroycar');
Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('destroyaddress');
