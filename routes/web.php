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

Route::get('/', 'PagesController@index');

Route::get('/welcome', 'PagesController@welcome');

Route::resource('notes', 'NotesController');

Route::get('getNotes', 'NotesController@getNotes')->name('getNotes');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('search', 'DashboardController@search');

