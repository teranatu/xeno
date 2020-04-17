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

Route::get('/', function () {return view('home');})->middleware('auth');
//auth管理
Auth::routes();
//グループコントローラー
Route::resource('groups', 'GroupController')->only(['index', 'store', 'show']);
//カード取得関連コントローラー
Route::get('groups/{group}/initialization','GameController@initialization')->name('initialization');
Route::get('groups/{group}/drawCard','GameController@drawCard')->name('drawCard');
Route::get('groups/{group}/drawKillCard','GameController@drawKillCard')->name('drawKillCard');
Route::post('groups/{group}/discard','GameController@discard')->name('discard');
Route::get('groupsexchangedCard', 'GameController@cardShuffle')->name('cardShuffle');
//カード効果関連コントローラー
//3
Route::get('groupsseeThroughCard','GameController@seeThroughCard')->name('seeThroughCard');
Route::post('groupsseeThroughedCard','GameController@seeThroughedCard')->name('seeThroughedCard');
Route::post('groupsseeThroughedconfirmedCard','GameController@seeThroughedconfirmedCard')->name('seeThroughedconfirmedCard');
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

//非同期処理用コントローラー
Route::get('/result/ajax', 'JsonController@isCount');
Route::get('/result/ajaxInRoomUsersDetails', 'JsonController@isCountInRoomUsersDetails');
Route::get('/result/ajaxInRoomUsers', 'JsonController@isCountInRoomUsers');
