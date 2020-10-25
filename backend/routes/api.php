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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', ['App\Http\Controllers\Api\AuthController', 'login']);
    Route::group([
      'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', ['App\Http\Controllers\Api\AuthController', 'logout']);
        Route::get('user', ['App\Http\Controllers\Api\AuthController', 'user']);
    });
});

Route::group([
    'prefix' => 'users'
], function () {
    Route::get('/', ['App\Http\Controllers\Api\UserController', 'index']);
    Route::get('/{id}', ['App\Http\Controllers\Api\UserController', 'show']);
});

Route::group([
    'prefix' => 'calendars'
], function () {
    Route::get('/', ['App\Http\Controllers\Api\CalendarController', 'index']);
    Route::get('/{id}', ['App\Http\Controllers\Api\CalendarController', 'show']);
    Route::post('/', ['App\Http\Controllers\Api\CalendarController', 'store']);
    Route::group([
        'middleware' => 'auth:api'
      ], function () {
          Route::patch('/{id}', ['App\Http\Controllers\Api\CalendarController', 'moderate']);
          Route::group([
            'middleware' => 'has-role-admin'
          ], function () {
              Route::put('/{id}', ['App\Http\Controllers\Api\CalendarController', 'update']);
              Route::delete('/{id}', ['App\Http\Controllers\Api\CalendarController', 'destroy']);
          });
      });
});
