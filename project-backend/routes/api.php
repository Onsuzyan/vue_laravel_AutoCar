<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource('products', 'ProductController');

Route::get('get/model/{id}', 'MakeModelController@getModels');
Route::get('get/make' ,'MakeModelController@getMake');
Route::get('get/year/{name}', 'MakeModelController@getYear');
Route::resource('user/product','UserProductController');
Route::post('/photo/delete/{id}', 'UserController@oldPhoto');
Route::get('/user/{id}', 'UserController@getOneUserData');
Route::get('/user/{id}/products', 'UserController@getOneUserProducts');
Route::get('change/status/{id}', 'UserController@changeStatus');
Route::get('users','AdminController@index');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');
    Route::post('user', 'AuthController@currentUser')->name('user');
    Route::post('register', 'RegisterController@register')->name('register');
    Route::post('verify', 'RegisterController@verify')->name('verify');
    Route::post('update/user/information', 'UserController@storeUserAvatar')->name('avatar');
    Route::post('update', 'UserController@updateUserInformation')->name('update');
});



