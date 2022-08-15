<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return inertia('Auth/Login');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/boards', [\App\Http\Controllers\BoardController::class, 'index'])->name('boards');
    Route::get('/boards/{board}', [\App\Http\Controllers\BoardController::class, 'show'])->name('boards.show');
    Route::post('/boards', [\App\Http\Controllers\BoardController::class, 'store'])->name('boards.store');
    Route::put('/boards/{board}', [\App\Http\Controllers\BoardController::class, 'update'])->name('boards.update');

    Route::post('/boards/{board}/list', [\App\Http\Controllers\CardListController::class, 'store'])->name('cardLists.store');
    Route::post('/cards', [\App\Http\Controllers\CardController::class, 'store'])->name('cards.store');
    Route::put('/cards/{card}', [\App\Http\Controllers\CardController::class, 'update'])->name('cards.update');
    Route::put('/cards/{card}/move', [\App\Http\Controllers\CardController::class, 'move'])->name('cards.move');
});

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

require __DIR__ . '/auth.php';
