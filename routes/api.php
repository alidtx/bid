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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('division', 'HomeController@divisionWiseParticipantChart');


Route::get('push-pull-sms', 'SmsController@pushPullSms')->name('sms.push.pull');

Route::post('push-pull-sms', 'SmsController@pushPullSms')->name('sms.push.pull.post');
Route::post('push-pull-sms-test', 'SmsController@pushPullSmsTest')->name('sms.push.pull.post');


Route::post('quiz', 'QuizController@quiz')->name('quiz');


Route::get('mail-bounce-handler','Api\MailBounceController@handle')->name('api.get.mail-bounce-handler');
Route::post('mail-bounce-handler', 'Api\MailBounceController@handle')->name('api.post.mail-bounce-handler');

Route::get('complaint-handler', 'Api\ComplaintController@handle')->name('api.get.complaint-handler');
Route::post('complaint-handler', 'Api\ComplaintController@handle')->name('api.post.complaint-handler');
