<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
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

// Route::middleware(['auth:api'])->group(function () {
// });

Route::resource('/blog', BlogController::class)->middleware(['auth:api']);

Route::post('/register', [UserController::class, 'registration']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/login', [UserController::class, 'login']);


Route::post('/logout', [UserController::class, 'logout'])->middleware(['auth:api']);



//  Route::get('/login', [UserController::class, 'login']);
