<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Models\User;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resources([
    'vid'=>VideoController::class,
    'src'=>SearchController::class,
    'com'=>CommentController::class,
    'vidA'=>AdminController::class,
    'user'=>UserController::class,
    'us'=>User::class
]);
//Route::get('/all', [App\Http\Controllers\VideoController::class, 'allVideos'])->name('all');
Route::get('/', [App\Http\Controllers\VideoController::class, 'allVideos'])->name('all');
Route::get('/show', [App\Http\Controllers\VideoController::class, 'show'])->name('show');


Route::prefix('user')->group(function(){
    Route::get('/profile', [UserController::class, 'show'])->name('profile');
});

Route::prefix('editor')->group(function(){
    Route::resource('vidE',EditorController::class);
    Route::get('/new', [App\Http\Controllers\EditorController::class, 'newVideo'])->name('store');
    Route::get('/edit', [App\Http\Controllers\EditorController::class, 'edit'])->name('editE');
});

Route::prefix('admin')->group(function(){
    Route::get('/edit', [App\Http\Controllers\AdminController::class, 'index'])->name('edit');
});
