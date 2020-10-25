<?php

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

Route::get('/users', ['App\Http\Controllers\Api\UserController', 'index']);
Route::get('/users/{id}', ['App\Http\Controllers\Api\UserController', 'show']);

Route::get('/calendars', ['App\Http\Controllers\Api\CalendarController', 'index']);
Route::get('/calendars/{id}', ['App\Http\Controllers\Api\CalendarController', 'show']);
Route::post('/calendars', ['App\Http\Controllers\Api\CalendarController', 'store']);
Route::patch('/calendars/{id}', ['App\Http\Controllers\Api\CalendarController', 'moderate']);
Route::put('/calendars/{id}', ['App\Http\Controllers\Api\CalendarController', 'update']);
