<?php

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
})->name('home');

Route::get('/hello', function (){
	return "Hello diego";
})->middleware('auth')->name('hello')->middleware('auth');

Route::post('/singup', 'User1Controller@postSingUp')->name('singup');

Route::post('/singin', 'User1Controller@postSingIn')->name('singin');

Route::get('/dashboard', 'PostController@getDashboard')->name('dashboard')->middleware('auth');

Route::post('/createpost', 'PostController@postCreatePost')->name('post.create');