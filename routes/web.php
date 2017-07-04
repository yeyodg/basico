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
	if(Auth::user()){
		return redirect()->route('dashboard');
	}
    return view('welcome');
})->name('home');

Route::post('/singup', 'User1Controller@postSingUp')->name('singup');

Route::post('/singin', 'User1Controller@postSingIn')->name('singin');

Route::get('/dashboard', 'PostController@getDashboard')->name('dashboard')->middleware('auth');

Route::post('/createpost', 'PostController@postCreatePost')->name('post.create')->middleware('auth');

Route::get('/delete-post/{post_id}', 'PostController@getDeletePost')->name('post.delete')->middleware('auth');

Route::get('/logout', 'User1Controller@getLogout')->name('logout');

Route::post('/edit', 'PostController@postEditPost')->name('edit');

Route::get('/account', 'User1Controller@getAccount')->name('account');

Route::post('/updateaccount', 'User1Controller@postSaveAccount')->name('account.save');

Route::get('/userimage/{filename}', 'User1Controller@getUserImage')->name('account.image');

Route::post('/like', 'PostController@postLikePost')->name('like');

Route::post('/getlikes', 'getController@getLikes')->name('get.likes');