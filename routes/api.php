<?php

use App\Http\Controllers\Api\SortController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=>'sort'],function(){
    Route::post('/categories',[SortController::class,'categories'])->name('api.sort.categories');
    Route::post('/dishes',[SortController::class,'dishes'])->name('api.sort.dishes');
});
