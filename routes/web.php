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
Route::post('login', 'LoginController@authenticate')->name('login');
Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('verified');

Auth::routes(['verify' => true]);

Route::get('/bahan_ajar', 'DashboardController@bahan_ajar')->name('bahan_ajar')->middleware('verified');

Route::group( ['middleware' => ['auth']], function() {
    Route::resource('courses', 'CourseController');
    Route::resource('roles', 'RoleController');
    Route::resource('lessons', 'LessonController')->except('create');
    Route::get('/lessons/create/{course}', 'LessonController@create')->name('lessons.create');
});

Route::group(['middleware' => 'admin'], function () {

});
Route::group(['middleware' => 'trainer'], function () {

});
Route::group(['middleware' => 'member'], function () {

});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
