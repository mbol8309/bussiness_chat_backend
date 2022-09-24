<?php

use App\Http\Controllers\Api\V1\DomainController as V1DomainController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

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

Route::prefix('auth')->group(function () {

    Route::post('/login',[UserController::class,'login']);
    
});

Route::middleware(['auth:sanctum'])->group(function(){
    
    Route::middleware('auth:sanctum')->group(function(){
        Route::get('auth/me',function(){
            return new UserResource(Auth::user());
        });
    });

    //users
    Route::prefix('user')->group(function(){
        Route::get('/',[UserController::class,'index']);
        Route::get('/{id}',[UserController::class,'show']);
    });

    //domain
    Route::prefix('domain')->group(function(){
        Route::get('/',[DomainController::class,'index']);
        Route::post('/',[DomainController::class,'store']);
        Route::get('/{id}',[DomainController::class,'show']);
    });

    LaravelJsonApi\Laravel\Facades\JsonApiRoute::server('v1')
    ->prefix('v1')
    ->resources(function ($server) {
        $server->resource('users', JsonApiController::class);
        $server->resource('domains', V1DomainController::class)->actions(function($actions){
            $actions->withId()->post('token')->name('token');
        });
    });
    

});




