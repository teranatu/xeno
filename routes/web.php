<?php

use Illuminate\Support\Facades\Route;
use Auth;
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
Route::resource('groups', 'groupController');
Route::get('groupshost','GameController@initialization')->name('initialization');
Route::get('groupsdrawCard','GameController@drawCard')->name('drawCard');
Route::get('groupsdrawKillCard','GameController@drawKillCard')->name('drawKillCard');
Route::get('groupsdiscardLeft','GameController@discardLeft')->name('discardLeft');
Route::get('groupsdiscardRight','GameController@discardRight')->name('discardRight');
Route::get('groupsselectcard','GameController@selectCard')->name('selectCard');
Route::post('groupsselectedcard','GameController@selectedCard')->name('selectedCard');
Route::get('groupsexchangecard','GameController@exchangeCard')->name('exchangeCard');
Route::post('groupsexchangedCard','GameController@exchangedCard')->name('exchangedCard');


Route::get('/result/ajax', 'GameController@isCount');
