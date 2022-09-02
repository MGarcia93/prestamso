<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LendingController;

use Illuminate\Support\Facades\Route;

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
    return view('home');
})->middleware(['auth'])->name('home');

Route::resource('lendings', LendingController::class)->except(['show'])->middleware(['auth'])->names('lendings');
Route::resource('clients', ClientController::class)->except(['show'])->middleware(['auth'])->names('clients');

require __DIR__ . '/auth.php';
