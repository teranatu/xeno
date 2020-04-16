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

Route::get('/', function () {return view('welcome');});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('groups', 'GroupController')->only(['index', 'store']);

Route::get('groupshost','GameController@initialization')->name('initialization');
Route::get('groupsdrawCard','GameController@drawCard')->name('drawCard');
Route::get('groupsdrawKillCard','GameController@drawKillCard')->name('drawKillCard');
Route::post('groupsdiscard','GameController@discard')->name('discard');
Route::get('groupsexchangedCard', 'GameController@cardShuffle')->name('cardShuffle');
//3
//5
Route::get('groupsplagueCard','GameController@plagueCard')->name('plagueCard');
Route::post('groupsplaguedCard','GameController@plaguedCard')->name('plaguedCard');
Route::post('groupsplaguedLeftOrRightCard','GameController@plaguedLeftOrRightCard')->name('plaguedLeftOrRightCard');
//6
//7
Route::get('groupsselectcard','GameController@selectCard')->name('selectCard');
Route::post('groupsselectedcard','GameController@selectedCard')->name('selectedCard');
//8
Route::get('groupsexchangecard','GameController@exchangeCard')->name('exchangeCard');
Route::post('groupsexchangedCard','GameController@exchangedCard')->name('exchangedCard');



Route::get('/result/ajax', 'JsonController@isCount');
Route::get('/result/ajaxInRoomUsersDetails', 'JsonController@isCountInRoomUsersDetails');
Route::get('/result/ajaxInRoomUsers', 'JsonController@isCountInRoomUsers');
