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
    Route::post('/login', 'Auth\LoginController@apiLogin');
});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->group(function () {
    Route::get('/categories', 'CategoriesController@index');
    Route::post('/category', 'CategoriesController@store');
    Route::get('/category/{id}', 'CategoriesController@show');
    Route::put('/category/{category}', 'CategoriesController@update');
    Route::delete('/category/{category}', 'CategoriesController@destroy');
});

Route::middleware('auth:api')->group(function () {
    Route::get('/movies', 'MoviesController@index');
    Route::get('movies/{categoryId}', 'MoviesController@getByCategory');
    Route::post('/movie', 'MoviesController@store');
    Route::get('/movie/{movie}', 'MoviesController@show');
    Route::put('movie/{movie}', 'MoviesController@update');
    Route::delete('movie/{movie}', 'MoviesController@destroy');
    Route::get('/movies/actor/{actor}', 'MoviesController@getByActorName');
});
