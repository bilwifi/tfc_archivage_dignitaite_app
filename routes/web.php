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


Route::get('/','PublicController@index')->name('welcome');
Route::get('/medaille/{medaille}', 'PublicController@showMedaille')->name('show_medaille');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add_dignitaire', 'HomeController@showFormAddDignitaire')->name('add_dignitaire');
Route::post('/add_dignitaire', 'HomeController@addDignitaire');
Route::get('/picture/{dignitaire}', 'HomeController@editPictureUser')->name('edit_picture_user');
Route::post('/upload-img', 'HomeController@uploadImg')->name('upload-img');
Route::get('/show/{dignitaire}', 'HomeController@showDignitaire')->name('show_dignitaire');

Route::post('/add_titre', 'HomeController@addTitre')->name('add_titre');





