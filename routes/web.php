<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('families', FamilyController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route to populate cities dropdown based on selected state
Route::get('cities/by-state', 'App\Http\Controllers\CityController@getCitiesByState')->name('cities.by_state');
