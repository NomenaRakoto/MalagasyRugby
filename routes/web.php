<?php

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

Route::get('/', '\App\Http\Controllers\LigueController@list')->name('ligue');
Route::get('/ligue/form/{id?}', '\App\Http\Controllers\LigueController@form')->name('ligue.form');
Route::post('/ligue/save', '\App\Http\Controllers\LigueController@save')->name('ligue.save');
Route::get('/ligue/delete/{id}', '\App\Http\Controllers\LigueController@delete')->name('ligue.delete');

/*Section route*/
Route::get('/section', '\App\Http\Controllers\SectionController@list')->name('section.list');
Route::get('/section/form/{id?}', '\App\Http\Controllers\SectionController@form')->name('section.form');
Route::post('/section/save', '\App\Http\Controllers\SectionController@save')->name('section.save');
Route::get('/section/delete/{id}', '\App\Http\Controllers\SectionController@delete')->name('section.delete');

/*Club route*/
Route::get('/club', '\App\Http\Controllers\ClubController@list')->name('club.list');
Route::get('/club/form/{id?}', '\App\Http\Controllers\ClubController@form')->name('club.form');
Route::post('/club/save', '\App\Http\Controllers\ClubController@save')->name('club.save');
Route::get('/club/delete/{id}', '\App\Http\Controllers\ClubController@delete')->name('club.delete');
Route::get('/club/personnel/{id_club}', '\App\Http\Controllers\ClubController@personnels')->name('club.personnel.list');
Route::any('/club/search', '\App\Http\Controllers\ClubController@search')->name('club.list.search');

/*Association route*/
Route::get('/association', '\App\Http\Controllers\AssociationController@list')->name('association.list');
Route::get('/association/form/{id?}', '\App\Http\Controllers\AssociationController@form')->name('association.form');
Route::post('/association/save', '\App\Http\Controllers\AssociationController@save')->name('association.save');
Route::get('/association/delete/{id}', '\App\Http\Controllers\AssociationController@delete')->name('association.delete');

/*Jeunes*/
Route::get('/jeune', '\App\Http\Controllers\JeuneController@list')->name('jeune.list');
Route::get('/jeune/form/{id?}', '\App\Http\Controllers\JeuneController@form')->name('jeune.form');
Route::post('/jeune/save', '\App\Http\Controllers\JeuneController@save')->name('jeune.save');
Route::post('/jeune/delete', '\App\Http\Controllers\JeuneController@delete')->name('jeune.delete');
Route::post('/jeune/licence/print', '\App\Http\Controllers\JeuneController@print')->name('jeune.licence.print');

/*Personnels*/
Route::get('/personnel', '\App\Http\Controllers\PersonnelController@list')->name('personnel.list');
Route::get('/personnel/form/{id?}', '\App\Http\Controllers\PersonnelController@form')->name('personnel.form');
Route::post('/personnel/save', '\App\Http\Controllers\PersonnelController@save')->name('personnel.save');
Route::post('/personnel/delete', '\App\Http\Controllers\PersonnelController@delete')->name('personnel.delete');
Route::post('/personnel/licence/print', '\App\Http\Controllers\PersonnelController@print')->name('personnel.licence.print');
Route::get('/personnel/doute/{nom_prenom}/{cin?}', '\App\Http\Controllers\PersonnelController@doute')->name('personnel.doute');
Route::any('/personnel/search', '\App\Http\Controllers\PersonnelController@search')->name('personnel.list.search');

Route::get('/statistique', '\App\Http\Controllers\ClubController@stats')->name('stat');

/*Authentication*/
Route::get('/login', '\App\Http\Controllers\UserController@login')->name('login');
Route::get('/logout', '\App\Http\Controllers\UserController@logout')->name('logout');
Route::post('/se_connecter', '\App\Http\Controllers\UserController@processLogin')->name('process_login');



