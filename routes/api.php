<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(DivisionController::class)->group(function () {
    Route::get('/divisions', 'index');
    Route::post('/divisions', 'store');
    Route::get('/divisions/{division}', 'show');
    Route::put('/divisions/{id}', 'update');
    Route::delete('/divisions/{id}', 'delete');
    Route::get('/divisions/{id}/subDivisions', 'subDivisions');
});