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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{username}','HomeController@my_gallery')->name('profile');
Route::get('/posting','PostController@CreatePost')->name('posting');
Route::post('/upload','PostController@Posting')->name('upload');
Route::get('/do_like/{post_id}','PostController@Like')->name('do_like');
Route::post('/post_comment/{post_id}','PostController@Comment')->name('post_comment');
Route::get('/delete/{post_id}','PostController@Delete')->name('delete_post');
Route::get('/update/{post_id}','PostController@Update')->name('update_post');
Route::post('/store_update','PostController@StoreUpdate')->name('store_update');
