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
use App\TinTuc;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'theloai'],function(){
		// hien thi view
		Route::get('list','TheLoaiController@getList');

		Route::get('edit/{id}','TheLoaiController@getEdit');
		Route::post('edit/{id}','TheLoaiController@postEdit');

		Route::get('add','TheLoaiController@getAdd');
		// lay data duoi view dua ve controller de thuc hien viec save
		Route::post('add','TheLoaiController@postAdd');

		// xoa data trong table TheLoai
		Route::get('delete/{id}','TheLoaiController@getDelete');
	});

	Route::group(['prefix'=>'loaitin'],function(){
		// hien thi view
		Route::get('list','LoaiTinController@getList');

		Route::get('edit/{id}','LoaiTinController@getEdit');
		Route::post('edit/{id}','LoaiTinController@postEdit');

		Route::get('add','LoaiTinController@getAdd');
		// lay data duoi view dua ve controller de thuc hien viec save
		Route::post('add','LoaiTinController@postAdd');
		
		// xoa data trong table TheLoai
		Route::get('delete/{id}','LoaiTinController@getDelete');
	});

	Route::group(['prefix'=>'slide'],function(){
		Route::get('list','SlideController@getList');
		Route::get('edit','SlideController@getEdit');
		Route::get('add','SlideController@getAdd');
	});

	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('list','TinTucController@getList');
		Route::get('edit','TinTucController@getEdit');
		Route::get('add','TinTucController@getAdd');
	});

	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@getList');
		Route::get('edit','UserController@getEdit');
		Route::get('add','UserController@getAdd');
	});

});