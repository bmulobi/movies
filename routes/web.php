<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoriesController@index')->name('getCategories');
Route::post('/category', 'CategoriesController@store')->name('storeCategory');
Route::get('/category/{id}', 'CategoriesController@show')->name('getCategory');
Route::put('/category/{id}', 'CategoriesController@update')->name('updateCategory');
Route::delete('/category/{category}', 'CategoriesCOntroller@destroy')->name('deleteCategory');

Route::get('/movies', function () {
    return view('movies');
})->name('movies');
