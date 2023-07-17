<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CourierController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('V1')->group(function (){
   Route::controller(CourierController::class)->prefix('courier')->name('courier')->group(function () {
       Route::get('/','index')->name('index');
       Route::get('/{id}','show')->name('show');
       Route::post('/','store')->name('store');
       Route::put('/{id}','update')->name('update');
       Route::delete('/{id}','destroy')->name('destroy');
   });
});
