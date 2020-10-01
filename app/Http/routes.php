<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/order', 'ProductController@order');
Route::post('/detalles', 'ProductController@detalles');
Route::get('/pedido', 'ProductController@pedido');
Route::get('/product', 'ProductController@product');
Route::get('/addProduct', 'ProductController@alta');
Route::post('/add', 'ProductController@addProduct');
Route::post('/addtocart', 'ProductController@addtocart');
Route::post('/deletetocart', 'ProductController@deletetocart');
Route::get('/subcategories', 'ProductController@subcategories');
Route::get('/procesarPago', 'ProductController@procesarPago');

Route::post('/busqueda', 'ProductController@busqueda');

/* Route::group(['prefix' => 'auth'], function () {
    Route::get('/{provider}', 'Auth\AuthController@redirectToProvider');
    Route::get('/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
});
*/
Route::get('/auth', 'Auth\AuthController@redirectToProvider');
Route::get('/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/saved', 'HomeController@saved');

Route::get('/success', 'HomeController@success');
Route::get('/failure', 'HomeController@failure');
Route::get('/pending', 'HomeController@pending');

Route::get('/administracion', 'ProductController@administracion');
Route::post('/editar', 'ProductController@editar');
Route::post('/delete', 'ProductController@delete');
Route::post('/save', 'ProductController@save');



