<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

Route::get('/', function () {
    return view('welcome');
})->name('top');

// 出来事に関して
Route::get('events/search', 'App\Http\Controllers\EventsController@searchIndex')->name('events.serch');
Route::get('events', 'App\Http\Controllers\EventsController@index')->name('events');
Route::get('events/create', 'App\Http\Controllers\EventsController@create')->name('events.create');
Route::post('events', 'App\Http\Controllers\EventsController@store')->name('events.store');
Route::get('events/{event}', 'App\Http\Controllers\EventsController@show')->name('events.show');
Route::get('events/{event}/edit', 'App\Http\Controllers\EventsController@edit')->name('events.edit');
Route::delete('events/{event}/delete}','App\Http\Controllers\EventsController@destroy')->name('events.destroy');
Route::put('events/{event}', 'App\Http\Controllers\EventsController@update')->name('events.update');


// 3コラムに関して
Route::get('three_columns/search', 'App\Http\Controllers\ThreeColumnsController@searchIndex')->name('three_columns.serch');

Route::get('three_columns', 'App\Http\Controllers\ThreeColumnsController@index')->name('three_columns');
Route::get('three_columns/create/{id}', 'App\Http\Controllers\ThreeColumnsController@create')->name('three_columns.create');
Route::post('three_columns', 'App\Http\controllers\ThreeColumnsController@store')->name('three_columns.store');
Route::get('three_columns/{param}', 'App\Http\Controllers\ThreeColumnsController@show')->name('three_columns.show');
Route::get('three_columns/{param}/edit', 'App\Http\controllers\ThreeColumnsController@edit')->name('three_columns.edit');
Route::post('three_columns/{param}/delete','App\Http\controllers\ThreeColumnsController@destroy')->name('three_columns.destroy');
Route::put('three_columns/{param}', 'App\Http\controllers\ThreeColumnsController@update')->name('three_columns.update');



// 7コラムに関して
Route::get('seven_columns/search', 'App\Http\Controllers\SevenColumnsController@searchIndex')->name('seven_columns.serch');

Route::get('seven_columns', 'App\Http\Controllers\SevenColumnsController@index')->name('seven_columns');
Route::get('seven_columns/create/{id}', 'App\Http\Controllers\SevenColumnsController@create')->name('seven_columns.create');
Route::post('seven_columns/store', 'App\Http\Controllers\SevenColumnsController@store')->name('seven_columns.store');
Route::get('seven_columns/{param}', 'App\Http\Controllers\SevenColumnsController@show')->name('seven_columns.show');
Route::get('seven_columns/{param}/edit', 'App\Http\Controllers\SevenColumnsController@edit')->name('seven_columns.edit');
Route::post('seven_columns/{param}/delete}', 'App\Http\Controllers\SevenColumnsController@destroy')->name('seven_columns.destroy');
Route::put('seven_columns/{param}', 'App\Http\controllers\SevenColumnsController@update')->name('seven_columns.update');



// 使い方説明
Route::get('users/info', 'App\Http\Controllers\ThreeColumnsController@info')->name('users.info');

// ユーザ登録
Route::get('signup', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'App\Http\Controllers\Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.post');

// ログアウト
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout.get');

// ユーザー退会確認画面遷移
Route::get('users/delete_confirm', 'App\Http\Controllers\UserController@delete_confirm')->name('users.delete_confirm');

// ユーザー退会処理 問題あり
Route::delete('users/delete', 'App\Http\Controllers\UserController@userDelete')->name('user.delete');

// vueに関して test画面
Route::get('events.testvue', 'App\Http\Controllers\EventsController@testvue')->name('events.testvue');
Route::post('events.testvue', 'App\Http\Controllers\EventsController@vuepost')->name('events.vuepost');

// 言語切り替え
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'App\Http\Controllers\LanguageController@switchLang']);


// ログイン認証付きのルーティング
Route::group(['middleware' => ['auth']], function () {
    
    // 出来事に関して
    Route::get('events/search', 'App\Http\Controllers\EventsController@searchIndex')->name('events.serch');
    Route::get('events', 'App\Http\Controllers\EventsController@index')->name('events');
    Route::get('events/create', 'App\Http\Controllers\EventsController@create')->name('events.create');
    Route::post('events', 'App\Http\Controllers\EventsController@store')->name('events.store');
    Route::get('events/{event}', 'App\Http\Controllers\EventsController@show')->name('events.show');
    Route::get('events/{event}/edit', 'App\Http\Controllers\EventsController@edit')->name('events.edit');
    Route::delete('events/{event}/delete}','App\Http\Controllers\EventsController@destroy')->name('events.destroy');
    Route::put('events/{event}', 'App\Http\Controllers\EventsController@update')->name('events.update');


    // 3コラムに関して
    Route::get('three_columns/search', 'App\Http\Controllers\ThreeColumnsController@searchIndex')->name('three_columns.serch');
    Route::get('three_columns', 'App\Http\Controllers\ThreeColumnsController@index')->name('three_columns');
    Route::get('three_columns/create/{id}', 'App\Http\Controllers\ThreeColumnsController@create')->name('three_columns.create');
    Route::post('three_columns', 'App\Http\Controllers\ThreeColumnsController@store')->name('three_columns.store');
    Route::get('three_columns/{param}', 'App\Http\Controllers\ThreeColumnsController@show')->name('three_columns.show');
    Route::get('three_columns/{param}/edit', 'App\Http\Controllers\ThreeColumnsController@edit')->name('three_columns.edit');
    Route::post('three_columns/{param}','App\Http\Controllers\ThreeColumnsController@destroy')->name('three_columns.destroy');
    Route::put('three_columns/{param}', 'App\Http\Controllers\ThreeColumnsController@update')->name('three_columns.update');


    // 7コラムに関して
    Route::get('seven_columns/search', 'App\Http\Controllers\SevenColumnsController@searchIndex')->name('seven_columns.serch');
    Route::get('seven_columns', 'App\Http\Controllers\SevenColumnsController@index')->name('seven_columns');
    Route::get('seven_columns/create/{id}', 'App\Http\Controllers\SevenColumnsController@create')->name('seven_columns.create');
    Route::post('seven_columns/store', 'App\Http\Controllers\SevenColumnsController@store')->name('seven_columns.store');
    Route::get('seven_columns/{param}', 'App\Http\Controllers\SevenColumnsController@show')->name('seven_columns.show');
    Route::get('seven_columns/{param}/edit', 'App\Http\Controllers\SevenColumnsController@edit')->name('seven_columns.edit');
    Route::post('seven_columns/{param}', 'App\Http\Controllers\SevenColumnsController@destroy')->name('seven_columns.destroy');
    Route::put('seven_columns/{param}', 'App\Http\Controllers\SevenColumnsController@update')->name('seven_columns.update');

    // 使い方説明
    Route::get('users/info', 'App\Http\Controllers\ThreeColumnsController@info')->name('users.info');

    // ログアウト
    Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout.get');

    // 言語切り替え
//    Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'App\Http\Controllers\LanguageController@switchLang']);
});