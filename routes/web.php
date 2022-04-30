<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;

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

Route::get('/', [PagesController::class, 'index']);

Route::resource('/blog', PostsController::class);

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/plantFinder', [\App\Http\Controllers\PlantController::class, 'index']);

Route::post('/identify', [\App\Http\Controllers\PlantController::class, 'identify']);

Route::get('/redirect', '\App\Http\Controllers\Auth\LoginController@redirectToProvider');
Route::get('/callback', '\App\Http\Controllers\Auth\LoginController@handleProviderCallback');

Route::get('/redirectgithub', '\App\Http\Controllers\Auth\GithubLoginController@redirectToProvider');
Route::get('/callbackgithub', '\App\Http\Controllers\Auth\GithubLoginController@handleProviderCallback');