<?php

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

Route::get('/', function () {
    return 'Admin API';
});

//Route::get('/countries', 'CountryController@index')->name('countries.index');
//Route::get('/states', 'StateController@index')->name('states.index');
//Route::get('/cities', 'CityController@index')->name('cities.index');
