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

Auth::routes(['verify' => true]);

Route::get('ext-login/google', 'Auth\LoginController@redirectToProvider')->name('ext-auth-google');
Route::get('ext-login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('panel')->middleware(['auth', 'verified', 'defaultadmin.usercheck'])->group(function() {

  //Dashboard
  Route::get('dashboard', 'DashboardController@index')->name('panel.get.dashboard.index');

  // Workshops
  Route::get('workshops', 'WorkshopController@index')->name('panel.get.workshops.index');
  Route::get('workshops/create', 'WorkshopController@create')->name('panel.get.workshops.create');
  Route::post('workshops/create', 'WorkshopController@store')->name('panel.post.workshops.store');
  Route::get('workshops/show/{id}', 'WorkshopController@show')->name('panel.get.workshops.show');
  Route::get('workshops/edit/{id}', 'WorkshopController@edit')->name('panel.get.workshops.edit');
  Route::post('workshops/edit/{id}', 'WorkshopController@update')->name('panel.post.workshops.update');
  Route::post('workshops/destroy/{id}', 'WorkshopController@destroy')->name('panel.post.workshops.destroy');
  Route::post('workshops/assets/', 'WorkshopController@listAssets')->name('panel.post.workshop.listAssets');

  // Assets
  Route::post('assets/create', 'AssetController@store')->name('panel.post.assets.store');
  Route::post('assets/destroy/{id}', 'AssetController@destroy')->name('panel.post.assets.destroy');


  // Events
  Route::get('events', 'EventController@index')->name('panel.get.events.index');
  Route::get('events/create', 'EventController@create')->name('panel.get.events.create');
  Route::post('events/create', 'EventController@store')->name('panel.post.events.store');
  Route::get('events/edit/{id}', 'EventController@edit')->name('panel.get.events.edit');
  Route::get('events/show/{id}', 'EventController@show')->name('panel.get.events.show');
  Route::post('events/destroy/{id}', 'EventController@destroy')->name('panel.post.events.destroy');

  Route::post('events/release_student/{id}', 'AttendeeController@releaseStudent')->name('panel.post.attendee.releaseStudent');
  Route::post('events/reset_seat/{id}', 'AttendeeController@resetSeat')->name('panel.post.attendee.resetSeat');

  // Students
  Route::get('students', 'StudentController@index')->name('panel.get.students.index');
  Route::get('students/edit/{id}', 'StudentController@edit')->name('panel.get.students.edit');
  Route::get('students/show/{id}', 'StudentController@show')->name('panel.get.students.show');
  Route::post('students/destroy/{id}', 'StudentController@destroy')->name('panel.post.students.destroy');

  // Activity Reports (Per student, per user/proctor associated events, per event, per workshop - time series and cumulative/avg analysis)
  Route::get('activity', 'ActivityController@index')->name('panel.get.activity.index');

  // Administration
  Route::prefix('admin')->group(function() {
    // |_ General
    Route::get('general', 'AdministrationController@index')->name('panel.get.administration.index');

    // |_ Users
    Route::get('users', 'UserController@index')->name('panel.get.users.index');
    Route::get('users/edit/{id}', 'UserController@edit')->name('panel.get.users.edit');
    Route::post('users/edit/{id}', 'UserController@update')->name('panel.post.users.update');
    Route::get('users/show/{id}', 'UserController@show')->name('panel.get.users.show');

    // |_ Roles
    Route::get('roles', 'RoleController@index')->name('panel.get.roles.index');
  });

});