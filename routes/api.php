<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return auth()->user();
});
/********** livetvApp**********/
// Route::group(['prefix' => '/','namespace'=>'Admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
// });
Route::get('/',  'ApiController@index');
Route::middleware('auth:api')->post('getAllCategories',  'ApiController@getAllCategories');
Route::post('getAllRegions',  'ApiController@getAllCategories');
Route::post('getAllChannels',  'ApiController@getAllCategories');
Route::post('getAllEvents',  'ApiController@getAllEvents');
Route::post('getAllVodCategories',  'ApiController@getAllVodCategories');
Route::post('getAllVods',  'ApiController@getAllVods');

Route::post('login',  'ApiController@login');
Route::post('register',  'ApiController@register');

Route::group(['prefix' => '', 'middleware' => 'auth:api'], function () {
    Route::post('activation',  'ApiController@userActivation');
    Route::post('addChildProfile', 'ApiController@addChildProfile');
    Route::post('getProfiles',  'ApiController@getProfiles');
    Route::post('forgotPassword',  'ApiController@forgotPassword');

    Route::get('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm')->name('api-forgot-password-confirm');
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm');
});