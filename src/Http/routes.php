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
Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', 'admin'],
    'namespace'  => 'Pxpm\BackpackFullCalendar\Http\Controllers',
], function () {
    CRUD::resource('calendar', 'CalendarCrudController');
    CRUD::resource('calendarevent', 'CalendarEventCrudController');
    CRUD::resource('calendareventtype', 'CalendarEventTypeCrudController');

    Route::get('calendar/view/{id?}', 'CalendarCrudController@showCalendar')->name('view-entity-calendar');
});