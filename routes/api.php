<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware('check.role:admin')->group(function () {
        Route::prefix('authors')->group(function () {
            Route::get('/', [AuthorController::class, 'index'])->name('authors.index');
            Route::post('/', [AuthorController::class, 'store'])->name('authors.store');
            Route::get('/{author}', [AuthorController::class, 'show'])->name('authors.show');
            Route::put('/{author}', [AuthorController::class, 'update'])->name('authors.update');
            Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
        });

        Route::prefix('books')->group(function () {
            Route::get('/', [BookController::class, 'index'])->name('books.index');
            Route::post('/', [BookController::class, 'store'])->name('books.store');
            Route::get('/{book}', [BookController::class, 'show'])->name('books.show');
            Route::put('/{book}', [BookController::class, 'update'])->name('books.update');
            Route::delete('/{book}', [BookController::class, 'destroy'])->name('books.destroy');
        });
    });
});


require __DIR__.'/auth.php';
