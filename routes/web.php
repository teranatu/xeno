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
Route::get('groups/{group}/cardShuffle', 'GameController@cardShuffle')->name('cardShuffle');


//カード効果関連コントローラー
//3
Route::get('groups/{group}/seeThroughCard','SeethroughcardController@seeThroughCard')->name('seeThroughCard');
Route::post('groups/{group}/seeThroughedCard','SeethroughcardController@seeThroughedCard')->name('seeThroughedCard');
Route::post('groups/{group}/seeThroughedconfirmedCard','SeethroughcardController@seeThroughedconfirmedCard')->name('seeThroughedconfirmedCard');

//5
Route::get('groups/{group}/plagueCard','PlagueCardController@plagueCard')->name('plagueCard');
Route::post('groups/{group}/plaguedCard','PlagueCardController@plaguedCard')->name('plaguedCard');
Route::post('groups/{group}/plaguedLeftOrRightCard','PlagueCardController@plaguedLeftOrRightCard')->name('plaguedLeftOrRightCard');
//6

//7
Route::get('groupsselectcard','GameController@selectCard')->name('selectCard');
Route::post('groupsselectedcard','GameController@selectedCard')->name('selectedCard');

//8
Route::get('groupsexchangecard','GameController@exchangeCard')->name('exchangeCard');
Route::post('groupsexchangedCard','GameController@exchangedCard')->name('exchangedCard');

//非同期処理用コントローラー
Route::get('/groups/result/ajax', 'JsonController@isCount');
Route::get('/groups/result/ajaxInRoomUsersDetails', 'JsonController@isCountInRoomUsersDetails');
Route::get('/groups/result/ajaxInRoomUsers', 'JsonController@isCountInRoomUsers');
