<?php

use App\Http\Controllers\PointController;
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

Route::get('/', [PointController::class, 'index']);

Route::get('/add', [PointController::class, 'add']);
Route::post('/store', [PointController::class, 'store']);

Route::get('/edit/{id}', [PointController::class, 'show']);
Route::post('/update/{id}', [PointController::class, 'update']);

Route::post('/siblings', [PointController::class, 'siblings']);
