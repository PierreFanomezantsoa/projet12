<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\medicineController;

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
Route::get('medicines',[medicineController::class, 'index']);
Route::post('medicines',[medicineController::class, 'store']);
Route::get('medicines/{id}',[medicineController::class, 'store1']);
Route::get('medicines/{id}/edit',[medicineController::class, 'store2']);
Route::put('medicines/{id}/edit',[medicineController::class, 'store3']);
Route::delete('medicines/{id}/delete',[medicineController::class, 'store4']);
