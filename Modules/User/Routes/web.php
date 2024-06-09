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


Route::middleware(['auth'])->group(function () {
    

    Route::group(['middleware' => ['role:super-admin|admin']], function() {
        Route::resource('users', UserController::class)->parameters(['users' => 'id']);
    });

    Route::get('change-password', [\Modules\User\Http\Controllers\UserController::class, 'changePassword'])->name('change.password');
    Route::post('update-password', [\Modules\User\Http\Controllers\UserController::class, 'updatePassword'])->name('update.password');
    
});


