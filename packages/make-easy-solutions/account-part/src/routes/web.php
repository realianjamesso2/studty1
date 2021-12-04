<?php

use Illuminate\Support\Facades\Route;
use MakeEasySolutions\AccountPart\Http\Controllers\UserController; 

Route::view('/add-user', 'make-easy-solutions::addUser'); 
Route::view('/show-user', 'make-easy-solutions::user.show'); 
Route::view('/open-user', 'mes-user::open'); 

Route::get('/test', [UserController::class, 'testing1']);