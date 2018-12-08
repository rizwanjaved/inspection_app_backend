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
Route::get('get_phpinfo',  function(){
    echo phpInfo();
});

Route::post('login',  'ApiController@login');
Route::post('register',  'ApiController@register');
Route::post('validateEmail',  'ApiController@validateEmail');


Route::group(['prefix' => '', 'middleware' => 'auth:api'], function () {
    Route::post('activation',  'ApiController@userActivation');
    // inspector api's
    Route::post('getAllAppointments',  'ApiController@getAllAppointments');
    Route::post('getAppointmentDetails',  'ApiController@getAppointmentDetails');
    Route::post('postInspection',  'ApiController@postInspection');
    // users's api's
    Route::post('postAppointment',  'ApiController@postAppointment');
    Route::post('getAllContraventions',  'ApiController@getAllContraventions');
    Route::post('viewAppointment',  'ApiController@viewAppointment');
    Route::post('cancelAppointment',  'ApiController@cancelAppointment');
    Route::post('viewInspection',  'ApiController@viewInspection');
    Route::post('registration',  'ApiController@registration');
    Route::post('addContravention',  'ApiController@addContravention');

});