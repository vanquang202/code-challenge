<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeManager;
use App\Models\CodeLanguage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminChallengeController;

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




Route::post('run-code' , [CodeManager::class,'run']);

Route::post('run-code/{id}' , [CodeManager::class,'runCodechall']);

Route::get('codechalls' , [CodeManager::class,'getCodechallAll']);
Route::get('types' , function () {
    return  CodeLanguage::all();
});

Route::get('callback', [\App\Http\Controllers\AuthController::class, 'callback']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('codechall/{id}' , [CodeManager::class,'getCodechall']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('run-submit-code/{id}' , [CodeManager::class,'runCodeSubmitChall']);
    Route::get('profile' , [ UserController::class , 'profile' ]);

});

Route::group(['prefix'=>'admin'],function () {
    Route::resource("challenge" , AdminChallengeController::class);
    Route::resource("type-code" , \App\Http\Controllers\Admin\AdminTypeTestController::class);
    Route::resource("has-cod" , \App\Http\Controllers\Admin\AdminHasCodController::class);
});

