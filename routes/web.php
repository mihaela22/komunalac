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

Route::get('/imbex', 'PageController@imbex');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//PageController
Route::get('/about', function () {
   return view('pages.about');
 });


Route::get('contact-us', 'ContactUsController@contactUs');
Route::post('contact-us',[
    'as'=>'contactus.store',
    'uses'=>'ContactUsController@contactUsPost'
]);

//Route::get('/about', 'PageController@about');
Route::get('/reports', 'PageController@reports');
Route::get('/edit_profile/{id}', 'PageController@edit_profile')->name('profile.update');

Route::put('/update_profile/{id}', 'PageController@update_profile');

//Kreiranje reporta, korisnicka strana
Route::get('/create_report/', 'PageController@create_report');
Route::post('/store_report/', 'PageController@store_report');

Route::get('/reports/{report}', 'ReportController@show');
Route::get('/reports', 'ReportController@myreports');

Route::get('/gdpr', function () {
   return view('pages.gdpr');
 });

//Admin controller

Route::group(['prefix' => 'admin', 'middleware' => ['auth' => 'admin']],  function () {
    Route::get('/', 'AdminController@index');
	Route::get('/report/{id}', 'AdminController@report');
	Route::get('/report/processed/{id}', 'AdminController@processed');
	Route::get('/report/completed/{id}', 'AdminController@completed');
	Route::post('/report/finish/{id}', 'AdminController@finish');
	Route::get('/ban_user/{id}', 'AdminController@ban_user');
	Route::get('/history', 'AdminController@history');
	Route::get('/categories', 'CategoryController@index');
	Route::resource('/categories', 'CategoryController');

	Route::get('/statistics', ['uses'=>'DisplayDataController@users', 'as'=>'pages.statistics']);

});



