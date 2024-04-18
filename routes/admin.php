<?php

use App\Http\Controllers\Admin\CartaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\resturante;
use App\Http\Controllers\Admin\usuarioController;

Route::get('', [HomeController::class, 'index'])->name('admin.home');
Route::resource('categories', CategoryController::class)->except('show')->names('admin.categories');
Route::resource('dishes', DishController::class)->except('show')->names('admin.dishes');
Route::resource('restaurante', resturante::class)->names('admin.Restaurante');
Route::resource('usuario',usuarioController::class)->names('admin.usuario');

