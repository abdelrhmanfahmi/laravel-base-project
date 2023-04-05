<?php

use App\Http\Controllers\Api\EntityController;
use App\Http\Controllers\Api\MarketController;
use App\Http\Controllers\Api\BusinessUnitController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\TargetController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login' , [AuthController::class , 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::apiResource('users' , UserController::class);
Route::apiResource('organizations' , OrganizationController::class);
Route::apiResource('entities' , EntityController::class);
Route::apiResource('teams' , TeamController::class)->except('store' , 'update');
Route::post('teams/{entity}' , [TeamController::class , 'store']);
Route::put('teams/{entity}' , [TeamController::class , 'update']);


Route::get('clusterTargets' , [TargetController::class , 'getClusterTargets']);
Route::get('get/clusters/{market_id}/{business_unit_id}' , [TargetController::class , 'getClusters']);
Route::post('storeTarget' , [TargetController::class,  'store']);
Route::get('markets' , [MarketController::class , 'index']);
Route::get('business-units' , [BusinessUnitController::class , 'index']);