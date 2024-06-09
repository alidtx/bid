<?php

use App\Models\SmsLog;
use App\Models\VoteCount;
use Illuminate\Support\Facades\DB;
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

Auth::routes(['register' => false, 'reset' => false]);

Route::get('', 'ParticipantController@index')->name('participant.index');
Route::get('registration-form', 'ParticipantController@registrationForm')->name('participant.registration.form');
Route::post('register', 'ParticipantController@register')->name('participant.register');
// Route::get('send-correct-answer', 'SmsController@sendCorrectAnswer')->name('sms.correct.answer.send');


Route::middleware(['auth'])->name('')->group(function () {

    Route::get('dashboard', 'HomeController@index')->name('home');
    Route::get('division-wise-participant-chart', 'HomeController@divisionWiseParticipantChart')->name('division.wise.participant.chart');
    Route::get('registration-wise-participant-chart', 'HomeController@registrationTypeWiseChart')->name('registration.wise.participant.chart');

    Route::get('/get-credit-chart-data', 'HomeController@getCreditChartData')->name('home.get.credit.chart.data');
    Route::get('/get-nid-chart-data', 'HomeController@getNidChartData')->name('home.get.nid.chart.data');

    Route::get('doctor/import', 'DoctorController@import')->name('doctor.import');
    Route::resource('doctor', DoctorController::class)->parameters(['doctor' => 'id']);
    Route::get('participant/import', 'ParticipantController@import')->name('participant.import');
    Route::resource('participant', ParticipantController::class)->parameters(['participant' => 'id']);
    

    Route::resource('question', QuestionController::class)->parameters(['question' => 'id']);

    Route::get('send-sms', 'SmsController@create')->name('sms.send');
    Route::post('send-sms', 'SmsController@sendSms')->name('sms.send.apply');

    Route::get('sms-log/export', 'SmsLogController@export')->name('sms-log.export');
    Route::get('sms-log/credit-limit', 'SmsLogController@creditLimit')->name('sms-log.credit-limit');
    Route::get('sms-log/credit-limit/export', 'SmsLogController@creditLimitExport')->name('sms-log.credit-limit.export');
    Route::get('sms-log/nid-collection', 'SmsLogController@nidCollection')->name('sms-log.nid-collection');
    Route::get('sms-log/nid-collection/export', 'SmsLogController@nidCollectionExport')->name('sms-log.nid-collection.export');
    Route::get('sms-log/import', 'SmsLogController@import')->name('sms-log.import');
    Route::resource('sms-log', SmsLogController::class)->parameters(['sms-log' => 'id']);

    Route::get('vote-count/export', 'VoteCountController@export')->name('vote-count.export');
    Route::get('vote-count/date-wise-report', 'VoteCountController@dateWiseReport')->name('vote-count.date.wise.report');
    Route::get('vote-count/voter-vote-count', 'VoteCountController@voterVoteCount')->name('vote-count.voter.vote.count');
    Route::resource('vote-count', VoteCountController::class)->parameters(['vote-count' => 'id']);

    Route::get('report/participant', 'ParticipantReportController@index')->name('report.participant');
    Route::get('report/participant-add', 'ParticipantReportController@participantAdd')->name('report.participant-add');
    Route::get('report/participant/download', 'ParticipantReportController@exportToCsv')->name('report.participant.download');
    
    Route::get('report/sms-log', 'SmsLogReportController@index')->name('report.sms-log');
    Route::get('report/participant-add', 'SmsLogReportController@participantAdd')->name('report.participant-add');
    Route::get('report/sms-log/download', 'SmsLogReportController@exportToCsv')->name('report.sms-log.download');

    Route::get('report/sent-sms-log', 'SmsLogReportController@sentSmsLog')->name('report.sent-sms-log');
    Route::get('report/sent-sms-log/download', 'SmsLogReportController@sentSmsLogExportCsv')->name('report.sent-sms-log.download');


    Route::get('report/participant/call-center', 'ParticipantReportController@ParticipantReportCallCenter')->name('report.participant.call-center');

    
    Route::get('division/list', 'DivisionController@index')->name('division.list');
    Route::get('division/edit/{id}', 'DivisionController@edit')->name('division.edit');
    Route::post('division/update/{id}', 'DivisionController@update')->name('division.update');

    Route::get('report/quiz', 'QuizController@quizReport')->name('report.quiz');
    Route::get('report/quiz/download', 'QuizController@exportToCsv')->name('report.quiz-download');


    // Route::get('repair-votes', function () {

    //     $overTimers = SmsLog::where([
    //         'status' => 'VOTING_TIME_OVER',
    //         'sms_date' => '2022-04-07',
    //     ])->where('participant_id', "!=", '33', )->get();

    //     try {
    //         DB::beginTransaction();
    //         foreach ($overTimers as $overTimer) {
    //             $record = VoteCount::updateOrCreate(
    //                 [
    //                     'participant_id' => $overTimer->participant->id,
    //                     'date' => '2022-04-07',
    //                 ],
    //                 [
    //                     'participant_id' => $overTimer->participant->id,
    //                     'date' => '2022-04-07',
    //                     'votes' => DB::raw('IFNULL(votes,0) + 1'),
    //                 ]
    //             );

    //             $overTimer->update([
    //                 'status' => 'SUCCESS',
    //             ]);
    //         }
    //         DB::commit();
    //         dd('done');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         dd($e);

    //     }

    // });




// log route
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');

});

Route::get('clear-all', function () {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('clear-compiled');
    \Illuminate\Support\Facades\Artisan::call('route:clear');

    dd('done');
});

Route::get('test-connection', function () {
    $q = \App\Models\Question::first();
    dd($q);
});
