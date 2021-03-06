<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});
Auth::routes();
Route::resource('buildings', '\App\Http\Controllers\BuildingsController');
Route::get('/buildings/buildingRelations/{id}', '\App\Http\Controllers\BuildingsController@buildingRelations');
Route::post('/buildings/saveRelations/{id}', '\App\Http\Controllers\BuildingsController@saveRelations');

Route::resource('elevators', '\App\Http\Controllers\ElevatorsController');
Route::get('/managers/managerRelations/{id}', '\App\Http\Controllers\ManagersController@managerRelations');
Route::post('/managers/saveRelations/{id}', '\App\Http\Controllers\ManagersController@saveRelations');
Route::resource('managers', '\App\Http\Controllers\ManagersController');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
