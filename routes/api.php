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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('refreshtoken', 'UserController@refreshToken');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', 'UserController@logout');
    Route::post('details', 'UserController@details');

    Route::get('posts', 'PostsController@index');
    Route::get('posts/{post}', 'PostsController@show');
    Route::post('posts', 'PostsController@store');
    Route::put('posts/{post}', 'PostsController@update');
    Route::delete('posts/{post}', 'PostsController@delete');
});
