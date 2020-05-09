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
Route::middleware('forceSsl')->group(function() {

  
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
//1&9_公開処刑
Route::get('Groups/{group}/publicExecuteCard','PublicExecuteCardController@publicExecuteCard')->name('publicExecuteCard');
Route::post('Groups/{group}/publicExecutedCard','PublicExecuteCardController@publicExecutedCard')->name('publicExecutedCard');
Route::post('Groups/{group}/publicExecutedLeftOrRightCard','PublicExecuteCardController@publicExecutedLeftOrRightCard')->name('publicExecutedLeftOrRightCard');

//3_透視
Route::get('groups/{group}/seeThroughCard','SeethroughCardController@seeThroughCard')->name('seeThroughCard');
Route::post('groups/{group}/seeThroughedCard','SeethroughCardController@seeThroughedCard')->name('seeThroughedCard');
Route::post('groups/{group}/seeThroughedconfirmedCard','SeethroughCardController@seeThroughedconfirmedCard')->name('seeThroughedconfirmedCard');

//5_疫病
Route::get('groups/{group}/plagueCard','PlagueCardController@plagueCard')->name('plagueCard');
Route::post('groups/{group}/plaguedCard','PlagueCardController@plaguedCard')->name('plaguedCard');
Route::post('groups/{group}/plaguedLeftOrRightCard','PlagueCardController@plaguedLeftOrRightCard')->name('plaguedLeftOrRightCard');
//6_対決

//7_選択
Route::get('groups/{group}/selectcard','SelectCardController@selectCard')->name('selectCard');
Route::post('groups/{group}/selectedcard','SelectCardController@selectedCard')->name('selectedCard');

//8_交換
Route::get('groups/{group}/exchangecard','ExchangeCardController@exchangeCard')->name('exchangeCard');
Route::post('groups/{group}/exchangedCard','ExchangeCardController@exchangedCard')->name('exchangedCard');

//非同期処理用コントローラー
Route::get('/groups/result/ajax', 'JsonController@isCount');
Route::get('/groups/result/ajaxInRoomUsersDetails', 'JsonController@isCountInRoomUsersDetails');
Route::get('/groups/result/ajaxInRoomUsers', 'JsonController@isCountInRoomUsers');


});