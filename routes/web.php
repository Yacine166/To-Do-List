<?php

use App\Http\Controllers\todoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[todoController::class,'index'])->name('todos.index');
Route::get('/create',[todoController::class,'create'])->name('todos.create');
Route::get('/edit/{id}',[todoController::class,'edit'])->name('todos.edit');

Route::post('/store',[todoController::class,'store'])->name('todos.save');
Route::put('/update/{id}',[todoController::class,'update'])->name('todos.update'); 
Route::post('/toggleStatus/{id}', [todoController::class, 'toggleStatus'])->name('todos.toggleStatus');
Route::delete('/delete/{id}',[todoController::class,'destroy'])->name('todos.delete');
