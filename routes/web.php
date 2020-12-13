<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DeveloperController;
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

Route::get('/home', [DeveloperController::class,'home']);
Route::get('/logout', [UserController::class,'logout']);
Route::get('/paginatedDeveloper', [DeveloperController::class,'paginatedDeveloper']);
Route::resource('developer', DeveloperController::class);
