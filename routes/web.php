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

Route::get('/ligue', '\App\Http\Controllers\LigueController@list')->name('ligue');
Route::get('/ligue/form/{id?}', '\App\Http\Controllers\LigueController@form')->name('ligue.form');
Route::post('/ligue/save', '\App\Http\Controllers\LigueController@save')->name('ligue.save');
Route::get('/ligue/delete/{id}', '\App\Http\Controllers\LigueController@delete')->name('ligue.delete');
Route::get('/ligue/export', '\App\Http\Controllers\LigueController@export')->name('ligue.export');
Route::get('/ligue/sections/{id}', '\App\Http\Controllers\LigueController@sections')->name('ligue.section');

/*Section route*/
Route::get('/section', '\App\Http\Controllers\SectionController@list')->name('section.list');
Route::get('/section/form/{id?}', '\App\Http\Controllers\SectionController@form')->name('section.form');
Route::post('/section/save', '\App\Http\Controllers\SectionController@save')->name('section.save');
Route::get('/section/delete/{id}', '\App\Http\Controllers\SectionController@delete')->name('section.delete');
Route::get('/section/export', '\App\Http\Controllers\SectionController@export')->name('section.export');
Route::get('/section/clubs/{id}', '\App\Http\Controllers\SectionController@clubs')->name('section.club');

/*Club route*/
Route::get('/club', '\App\Http\Controllers\ClubController@list')->name('club.list');
Route::get('/club/form/{id?}', '\App\Http\Controllers\ClubController@form')->name('club.form');
Route::post('/club/save', '\App\Http\Controllers\ClubController@save')->name('club.save');
Route::get('/club/delete/{id}', '\App\Http\Controllers\ClubController@delete')->name('club.delete');
Route::get('/club/personnel/{id_club}', '\App\Http\Controllers\ClubController@personnels')->name('club.personnel.list');
Route::any('/club/search', '\App\Http\Controllers\ClubController@search')->name('club.list.search');
Route::get('/club/export', '\App\Http\Controllers\ClubController@export')->name('club.export');

/*Association route*/
Route::get('/association', '\App\Http\Controllers\AssociationController@list')->name('association.list');
Route::get('/association/form/{id?}', '\App\Http\Controllers\AssociationController@form')->name('association.form');
Route::post('/association/save', '\App\Http\Controllers\AssociationController@save')->name('association.save');
Route::get('/association/delete/{id}', '\App\Http\Controllers\AssociationController@delete')->name('association.delete');
Route::get('/association/jeunes/{id_association}', '\App\Http\Controllers\AssociationController@jeunes')->name('association.jeunes.list');
Route::get('/association/export', '\App\Http\Controllers\AssociationController@export')->name('association.export');


/*Jeunes*/
Route::get('/jeune', '\App\Http\Controllers\JeuneController@list')->name('jeune.list');
Route::get('/jeune/form/{id?}', '\App\Http\Controllers\JeuneController@form')->name('jeune.form');
Route::post('/jeune/save', '\App\Http\Controllers\JeuneController@save')->name('jeune.save');
Route::post('/jeune/delete', '\App\Http\Controllers\JeuneController@delete')->name('jeune.delete');
Route::post('/jeune/licence/print', '\App\Http\Controllers\JeuneController@print')->name('jeune.licence.print');
Route::get('/jeune/export', '\App\Http\Controllers\JeuneController@export')->name('jeune.export');

/*Personnels*/
Route::get('/personnel', '\App\Http\Controllers\PersonnelController@list')->name('personnel.list');
Route::get('/personnel/form/{id?}', '\App\Http\Controllers\PersonnelController@form')->name('personnel.form');
Route::post('/personnel/save', '\App\Http\Controllers\PersonnelController@save')->name('personnel.save');
Route::post('/personnel/delete', '\App\Http\Controllers\PersonnelController@delete')->name('personnel.delete');
Route::post('/personnel/licence/print', '\App\Http\Controllers\PersonnelController@print')->name('personnel.licence.print');
Route::get('/personnel/doute/{nom_prenom}/{cin?}', '\App\Http\Controllers\PersonnelController@doute')->name('personnel.doute');
Route::any('/personnel/search', '\App\Http\Controllers\PersonnelController@search')->name('personnel.list.search');

Route::get('/statistique', '\App\Http\Controllers\ClubController@stats')->name('stat');
Route::post('/personnel/scat', '\App\Http\Controllers\PersonnelController@checkScat')->name('personnel.scat');
Route::get('/personnel/export', '\App\Http\Controllers\PersonnelController@export')->name('personnel.export');

/*Authentication*/
Route::get('/login', '\App\Http\Controllers\UserController@login')->name('login');
Route::get('/logout', '\App\Http\Controllers\UserController@logout')->name('logout');
Route::post('/se_connecter', '\App\Http\Controllers\UserController@processLogin')->name('process_login');


/*Mutations route*/
Route::get('/mutation', '\App\Http\Controllers\MutationController@list')->name('mutation.list');
Route::get('/mutation/form/{id?}', '\App\Http\Controllers\MutationController@form')->name('mutation.form');
Route::post('/mutation/save', '\App\Http\Controllers\MutationController@save')->name('mutation.save');
Route::get('/mutation/export', '\App\Http\Controllers\MutationController@export')->name('mutation.export');


/*Matchs route*/
Route::get('/match', '\App\Http\Controllers\MatchController@list')->name('match.list');
Route::get('/match/form/{id?}', '\App\Http\Controllers\MatchController@form')->name('match.form');
Route::post('/match/save', '\App\Http\Controllers\MatchController@save')->name('match.save');
Route::post('/match/delete', '\App\Http\Controllers\MatchController@delete')->name('match.delete');
Route::post('/match/joueurs', '\App\Http\Controllers\MatchController@joueurs')->name('match.joueurs');
Route::get('/match/export', '\App\Http\Controllers\MatchController@export')->name('match.export');

/*Settings route*/
Route::get('/settings', '\App\Http\Controllers\SettingsController@main')->name('settings.main');
Route::post('/settings/scat/delete', '\App\Http\Controllers\SettingsController@deleteScat')->name('settings.delete.scat');
Route::post('/settings/fmr/save', '\App\Http\Controllers\SettingsController@saveFmr')->name('settings.fmr.save');

Route::post('/settings/scat/save', '\App\Http\Controllers\SettingsController@saveScat')->name('settings.scat.save');

Route::post('/settings/cat/save', '\App\Http\Controllers\SettingsController@saveCat')->name('settings.cat.save');
Route::post('/settings/cat/delete', '\App\Http\Controllers\SettingsController@deleteCat')->name('settings.delete.cat');

Route::post('/settings/niveau/save', '\App\Http\Controllers\SettingsController@saveNiveau')->name('settings.niveau_etude.save');
Route::post('/settings/niveau/delete', '\App\Http\Controllers\SettingsController@deleteNiveau')->name('settings.delete.niveau_etude');

/*Dashboard route*/
Route::get('/', '\App\Http\Controllers\DashboardController@main')->name('dashboard.main');


