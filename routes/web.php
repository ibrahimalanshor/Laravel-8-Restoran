<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function ()
{

	Route::middleware('auth:admin')->group(function ()
	{
		Route::get('/', 'HomeController@index')->name('home');
		Route::post('/top_menu', 'HomeController@topMenu')->name('top.menu');
		Route::post('/total_revenue', 'HomeController@totalRevenue')->name('total.revenue');

		Route::resource('/menu', 'MenuController')->except('edit');
		Route::resource('/category', 'CategoryController')->except(['edit', 'show', 'create']);
		Route::resource('/table', 'TableController')->only(['index', 'store', 'destroy']);
		Route::resource('/user', 'UserController')->only(['index','destroy']);

		Route::post('/category/get', 'CategoryController@get')->name('category.get');

		Route::prefix('setting')->name('setting.')->group(function ()
		{
			Route::get('/', 'SettingController@index')->name('index');
			Route::put('/update', 'SettingController@update')->name('update');
		});

	});

	Route::namespace('Auth')->group(function ()
	{
		Route::get('/login', 'LoginController@showLoginForm');
		Route::post('/login', 'LoginController@login')->name('login');
	});

});

Route::middleware('auth')->group(function ()
{

	Route::get('/', 'HomeController@index')->name('home');
	Route::post('/top_menu', 'HomeController@topMenu')->name('top.menu');
	
	Route::prefix('/order')->name('order.')->group(function ()
	{
		Route::get('/print/{order}', 'OrderController@print')->name('print');
		Route::get('/pay/{order}', 'OrderController@pay')->name('pay');
		Route::get('/detail/{menu}', 'OrderController@detail')->name('detail');
		
		Route::post('/search', 'OrderController@search')->name('search');
		Route::post('/category', 'OrderController@category')->name('category');
	});

	Route::prefix('/user')->name('user.')->group(function ()
	{
		Route::get('/', 'UserController@index')->name('index');
		Route::post('/update', 'UserController@update')->name('update');
	});

	Route::post('/total_revenue', 'HomeController@totalRevenue')->name('total.revenue');

	Route::resource('/order', 'OrderController')->only('index', 'create', 'store', 'show', 'search');
	Route::resource('/table', 'TableController')->only('index');

});