<?php

use App\Http\Controllers\Api\Dashboard\AuthController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\Dashboard\LinkController as DashboardLinkController;
use App\Http\Controllers\Api\Dashboard\ProjectController as DashboardProjectController;
use App\Http\Controllers\Api\Dashboard\serviceController as DashboardServiceController;
use App\Http\Controllers\Api\Dashboard\User_infoController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware(['guest'])->group(function () {
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/users', [User_infoController::class, 'index']);
    Route::get('/links', [LinkController::class, 'index']);
    Route::get('/services/{service}', [ServiceController::class , 'show']);
    Route::get('/projects/{project}', [ProjectController::class , "show"]);
    //Route::get('/users/{user}', [UserController::class, 'show']);


    Route::post('/login', [AuthController::class, 'login']);});


    Route::middleware(['auth:sanctum'])->group(function () {

        //users
        Route::get('/dashboard/users', [User_infoController::class, 'index']);
        Route::post('/dashboard/users', [User_infoController::class, 'store']);
        Route::put('/dashboard/users/{user_info}', [User_infoController::class, 'update']);
        Route::delete('/dashboard/users/{user}', [User_infoController::class, 'destroy']);

        //services

        Route::get('/dashboard/services' , [DashboardServiceController::class , 'index']);
        Route::get('/dashboard/services/{service}', [DashboardServiceController::class , "show"]);
        Route::post('/dashboard/services',[DashboardServiceController::class, 'store']);
        Route::put('/dashboard/services/{service}', [DashboardServiceController::class, 'update']);
        Route::delete('/dashboard/services/{service}', [DashboardServiceController::class, 'destroy']);

        //projects

        Route::get('/dashboard/projects', [DashboardProjectController::class, 'index']);
        Route::get('/dashboard/projects/{project}', [DashboardProjectController::class , "show"]);
        Route::post('/dashboard/projects',[DashboardProjectController::class, 'store']);
        Route::put('/dashboard/projects/{project}', [DashboardProjectController::class, 'update']);
        Route::delete('/dashboard/projects/{project}',[DashboardProjectController ::class, 'destroy']);

        //links
        
        Route::get('/dashboard/links', [DashboardLinkController::class, 'index']);
        Route::post('/dashboard/links',[DashboardLinkController::class, 'store']);
        Route::put('/dashboard/links/{link}', [DashboardLinkController::class, 'update']);
        Route::delete('/dashboard/links/{link}',[DashboardLinkController ::class, 'destroy']);


       
        
        Route::post('/dashboard/logout', [AuthController::class, 'logout']);});
