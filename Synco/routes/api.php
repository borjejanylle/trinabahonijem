<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ManagerApiContoller;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register',[UserController::class,'register']);
Route::post('/auth/login', [UserController::class,'login']);
Route::post('/profile/change-password',[ProfileController::class,'change_password'])->middleware('auth:sanctum');
Route::post('/profile/update-profile',[ProfileController::class,'update_profile'])->middleware('auth:sanctum');

Route::get('/auth/user',[UserController::class,'user'])->middleware('auth:sanctum');
Route::get('/auth/logout',[UserController::class,'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/admins',[ManagerApiContoller::class,'managerlist']);
    Route::post('/admins',[ManagerApiContoller::class,'add']);
    Route::get('/admins/{id}',[ManagerApiContoller::class,'edit']);
    Route::post('/admins/{id}',[ManagerApiContoller::class,'update']);
    Route::delete('/admins/{id}',[ManagerApiContoller::class, 'delete']);
});


