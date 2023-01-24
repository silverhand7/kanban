<?php

use App\Http\Controllers\ApiCardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\ExportDBController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('columns', [ColumnController::class, 'index'])->name('api.columns');
Route::post('column/store', [ColumnController::class, 'store'])->name('api.column.store');
Route::put('column/{id}/update', [ColumnController::class, 'update'])->name('api.column.update');
Route::delete('column/{id}/delete', [ColumnController::class, 'destroy'])->name('api.column.delete');
Route::post('column/move', [ColumnController::class, 'move'])->name('api.column.move');
Route::post('card/move', [CardController::class, 'move'])->name('api.card.move');
Route::post('card/store', [CardController::class, 'store'])->name('api.card.store');
Route::put('card/{id}/update', [CardController::class, 'update'])->name('api.card.update');
Route::delete('card/{id}/delete', [CardController::class, 'delete'])->name('api.card.delete');

Route::post('export-db', [ExportDBController::class, 'export']);

Route::get('/list-card', [ApiCardController::class, 'get']);
