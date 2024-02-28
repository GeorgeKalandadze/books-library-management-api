<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('books')->group(function () {
//    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::post('/', [BookController::class, 'store'])->name('books.store');
//    Route::get('/{book}', [BookController::class, 'show'])->name('books.show');
    Route::put('/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});
