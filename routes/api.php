<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['middeware' => 'api','prefix' => 'auth','as' => 'api.'],function(){
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::get('authorize',[AuthController::class,'authorizeUser'])->name('authorize');
});
