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
    return $request->user();
});

Route::group(['middleware'=>['auth:api'],'namespace'=>'Api'],function(){
    Route::post('register','UserController@register')->name('register');
    Route::post('getUsers','UserController@getUsers')->name('getUsers');
    Route::get('getProvince','UserController@getProvince')->name('getProvince');
    Route::post('getPatients','UserController@getPatients')->name('getPatients');
    Route::post('getPatientsSearch','UserController@getPatientsSearch')->name('getPatientsSearch');
    Route::post('getCity','UserController@getCity')->name('getCity');
    Route::post('getDoctorEditData','UserController@getDoctorEditData')->name('getDoctorEditData');
    Route::post('updateDoctor','UserController@updateDoctor')->name('updateDoctor');
    Route::post('updatePatientfollowup','UserController@updatePatientfollowup')->name('updatePatientfollowup');
    Route::post('getQuestions','QuestionController@getQuestions')->name('getQuestions');
    Route::post('getFirstAssetment','QuestionController@getFirstAssetment')->name('getFirstAssetment');
    Route::post('addFirstAssetment','QuestionController@addFirstAssetment')->name('addFirstAssetment');
    Route::post('PreMeetingInsert','QuestionController@PreMeetingInsert')->name('PreMeetingInsert');
    Route::post('getUserData','UserController@getUserData')->name('getUserData');
    Route::post('fetchDoctorDetailsForClient','UserController@fetchDoctorDetailsForClient')->name('fetchDoctorDetailsForClient');
    Route::post('fetchDoctorDetailsForClientSearch','UserController@fetchDoctorDetailsForClientSearch')->name('fetchDoctorDetailsForClientSearch');
    

});


Route::post('login','Api\UserController@login')->name('login');
