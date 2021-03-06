<?php

use App\Infrastructure\Controllers\GenericErrorController;
use App\Infrastructure\Controllers\GetUserController;
use App\Infrastructure\Controllers\IsEarlyAdopterUserController;
use App\Infrastructure\Controllers\GetUsersListController;
use App\Infrastructure\Controllers\StatusController;
use App\Infrastructure\Controllers\testController;
use App\Infrastructure\Controllers\UserController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get(
    '/status',
    StatusController::class
);

Route::get(
    '/users/list',
    GetUsersListController::class
);

Route::get(
    '/users',
    UserController::class
);


//Route::get(
//    '/users/{email}',
//    IsEarlyAdopterUserController::class
//);

Route::get(
    '/users/{userId}',
    GetUserController::class
);
