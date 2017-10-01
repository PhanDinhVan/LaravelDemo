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
use App\LoaiTin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login','UserController@getLoginAdmin');
Route::post('admin/login','UserController@postLoginAdmin');
Route::get('admin/logout','UserController@getLogoutAdmin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
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


	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('list','TinTucController@getList');

		Route::get('edit/{id}','TinTucController@getEdit');
		Route::post('edit/{id}','TinTucController@postEdit');

		Route::get('add','TinTucController@getAdd');
		Route::post('add','TinTucController@postAdd');

		Route::get('delete/{id}','TinTucController@getDelete');
	});

	Route::group(['prefix'=>'comment'],function(){
		Route::get('delete/{idComment}/{idTinTuc}','CommentController@getDelete');
	});

	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	});

	Route::group(['prefix'=>'slide'],function(){
		Route::get('list','SlideController@getList');

		Route::get('edit/{id}','SlideController@getEdit');
		Route::post('edit/{id}','SlideController@postEdit');

		Route::get('add','SlideController@getAdd');
		Route::post('add','SlideController@postAdd');

		Route::get('delete/{id}','SlideController@getDelete');
	});


	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@getList');

		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');

		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');

		Route::get('delete/{id}','UserController@getDelete');
	});

});

Route::get('home','PagesController@home');
Route::get('contact','PagesController@contact');