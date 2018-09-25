<?php

use Illuminate\Http\Request;

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

Route::middleware('guest')->group(function () {
    Route::post('/register', 'Auth\RegisterController@apiRegistration');
    Route::post('/login', 'Auth\LoginController@login');
});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->group(function () {
    Route::get('/categories', 'CategoryController@index');
    Route::post('/category', 'CategoriesController@store');
    Route::get('/category/{id}', 'CategoryController@show');
    Route::put('/category/{id}', 'CategoryController@update');
    Route::delete('/category/{id}', 'CategoryCOntroller@destroy');
});

Route::middleware('auth:api')->group(function () {
    Route::get('/movies', 'MoviesController@index');
    Route::post('/movie', 'MoviesController@store');
    Route::get('/movie/{id}', 'MoviesController@show');
    Route::put('movie/{id}', 'MioviesController@update');
    Route::delete('movie/{id}', 'MioviesController@destroy');
});
