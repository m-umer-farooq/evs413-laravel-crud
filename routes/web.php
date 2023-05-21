<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
});

Auth::routes();



Route::get('/user-list', [UserController::class, 'list']);
Route::get('/user-add', [UserController::class, 'add']);
Route::post('/user-add', [UserController::class, 'create']);
Route::get('/user-edit-{id}', [UserController::class, 'edit']);
Route::post('/user-edit-{id}', [UserController::class, 'update']);
Route::get('/user-delete-{id}', [UserController::class, 'delete']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
