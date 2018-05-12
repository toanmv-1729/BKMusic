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
use App\TheLoai;
use App\Singer;
use App\Song;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>'adminLogin'],function(){
	Route::group(['prefix'=>'baihat'],function(){

		Route::get('danhsach','baihatController@getDanhSach');

		Route::get('sua/{id}','baihatController@getSua');
		Route::post('sua/{id}','baihatController@postSua');

		Route::get('them','baihatController@getThem');
		Route::post('them','baihatController@postThem');

		Route::get('xoa/{id}','baihatController@getXoa');
	});

	Route::group(['prefix'=>'theloai'],function(){

		Route::get('danhsach','theloaiController@getDanhSach');

		Route::get('sua/{id}','theloaiController@getSua');
		Route::post('sua/{id}','theloaiController@postSua');

		Route::get('them','theloaiController@getThem');
		Route::post('them','theloaiController@postThem');

		Route::get('xoa/{id}','theloaiController@getXoa');
	});

	Route::group(['prefix'=>'casi'],function(){

		Route::get('danhsach','casiController@getDanhSach');

		Route::get('sua/{id}','casiController@getSua');
		Route::post('sua/{id}','casiController@postSua');

		Route::get('them','casiController@getThem');
		Route::post('them','casiController@postThem');

		Route::get('xoa/{id}','casiController@getXoa');
	});

	Route::group(['prefix'=>'ajax'],function(){
		Route::get('casi/{idtheloai}','AjaxController@getCaSi');
	});

	Route::group(['prefix'=>'user'],function(){
		
		Route::get('danhsach','UserController@getDanhSach');

		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');

		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');

		Route::get('xoa/{id}','UserController@getXoa');
	});
});

Route::get('trangchu','PagesController@trangchu');
Route::get('baihat/{id}.html','PagesController@baihat');

