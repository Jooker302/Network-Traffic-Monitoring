<?php

use App\Http\Controllers\TechController;
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

Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::get('user-profile',[TechController::class,'user_profile']);
    Route::post('user-logout',[TechController::class,'user_logout']);
    Route::get('all-users',[TechController::class,'all_users']);
    Route::post('delete-user',[TechController::class,'delete_user']);
    Route::post('update-user',[TechController::class,'update_user']);
    Route::post('admin-add-user',[TechController::class,'admin_add_user']);

});
Route::post('register-user',[TechController::class,'register_user']);
Route::post('login-user',[TechController::class,'user_login']);

