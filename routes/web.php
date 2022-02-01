<?php

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
    return view('welcome');
})->name("root");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('profile')->group(function () {
    Route::patch('/', [App\Http\Controllers\ProfileController::class, 'update'])->name("profile-update");
    Route::get('/form', [App\Http\Controllers\ProfileController::class, 'create'])->name("profile-create-form");
    // Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name("profile-store");
    // Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name("profile-update");
});


Route::prefix('posts')->group(function () {
    Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name("posts-index");
    Route::post('/', [App\Http\Controllers\PostController::class, 'store'])->name("posts-store");
    Route::patch('/{id}', [App\Http\Controllers\PostController::class, 'update'])->name("posts-update");
    Route::delete('/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name("posts-delete");
});