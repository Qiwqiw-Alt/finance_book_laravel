<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\FinancebookController; 


Route::resource('financebook', FinancebookController::class);