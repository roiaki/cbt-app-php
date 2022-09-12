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

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');

// ゲストログイン機能
//Route::get('login/guest', 'Auth\LoginController@guestLogin')->name('guest.login');

// ゲストユーザー登録
Route::get('signup/guest', 'UserController@guestUserCreate')->name('guest.signup');

// 言語切り替え
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);


// ログイン認証付きのルーティング
Route::group(['middleware' => ['auth']], function () {
    
    // 出来事に関して
    Route::get('events/search', 'EventsController@searchIndex')->name('events.serch');
    Route::get('events', 'EventsController@index')->name('events');
    Route::get('events/create', 'EventsController@create')->name('events.create');
    Route::post('events', 'EventsController@store')->name('events.store');
    Route::get('events/{event}', 'EventsController@show')->name('events.show');
    Route::get('events/{event}/edit', 'EventsController@edit')->name('events.edit');
    Route::delete('events/{event}/delete}','EventsController@destroy')->name('events.destroy');
    Route::put('events/{event}', 'EventsController@update')->name('events.update');


    // 3コラムに関して
    Route::get('three_columns/search', 'ThreeColumnsController@searchIndex')->name('three_columns.serch');
    Route::get('three_columns', 'ThreeColumnsController@index')->name('three_columns');
    Route::get('three_columns/create/{id}', 'ThreeColumnsController@create')->name('three_columns.create');
    Route::post('three_columns', 'ThreeColumnsController@store')->name('three_columns.store');
    Route::get('three_columns/{param}', 'ThreeColumnsController@show')->name('three_columns.show');
    Route::get('three_columns/{param}/edit', 'ThreeColumnsController@edit')->name('three_columns.edit');
    Route::delete('three_columns/{param}','ThreeColumnsController@destroy')->name('three_columns.destroy');
    Route::put('three_columns/{param}', 'ThreeColumnsController@update')->name('three_columns.update');


    // 7コラムに関して
    Route::get('seven_columns/search', 'SevenColumnsController@searchIndex')->name('seven_columns.serch');
    Route::get('seven_columns', 'SevenColumnsController@index')->name('seven_columns');
    Route::get('seven_columns/create/{id}', 'SevenColumnsController@create')->name('seven_columns.create');
    Route::post('seven_columns/store', 'SevenColumnsController@store')->name('seven_columns.store');
    Route::get('seven_columns/{param}', 'SevenColumnsController@show')->name('seven_columns.show');
    Route::get('seven_columns/{param}/edit', 'SevenColumnsController@edit')->name('seven_columns.edit');
    Route::delete('seven_columns/{param}', 'SevenColumnsController@destroy')->name('seven_columns.destroy');
    Route::put('seven_columns/{param}', 'SevenColumnsController@update')->name('seven_columns.update');

    
    // 解決策リストに関して
    Route::get('solutions', 'SolutionsController@index')->name('solutions');
    Route::get('solution/create', 'SolutionsController@create')->name('solution.create');
    Route::post('solutions', 'SolutionsController@store')->name('solutions.store');
    Route::get('solution/{param}', 'SolutionsController@show')->name('solutions.show');
    Route::get('solution/{param}/edit', 'SolutionsController@edit')->name('solutions.edit');
    Route::put('solution/{param}', 'SolutionsController@update')->name('solution.update');
    Route::delete('solution/{param}', 'SolutionsController@destroy')->name('solution.destroy');
    
    // 使い方説明
    Route::get('users/info', 'ThreeColumnsController@info')->name('users.info');

    Route::get('users/infotest', 'ThreeColumnsController@infotest')->name('users.infotest');

    // ログアウト
    Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

    // プロフィール編集画面表示
    Route::get('profile', 'UserController@show')->name('users.profile');
    
    // プロフィール編集（更新）
    // Route::put('profile', 'UserController@update')->name('users.update');

    // 名前更新
    Route::put('profile', 'UserController@nameUpdate')->name('user.nameupdate');
    // メールアドレス更新
    Route::put('profile/e', 'UserController@emailUpdate')->name('user.emailupdate');
    // パスワード更新処理
    Route::put('profile/p', 'UserController@passwordUpdate')->name('user.passwordUpdate');

    // 名前編集ページへ遷移
    Route::get('profile/name', 'UserController@showNameProfile')->name('user.name_edit');
    // email編集ページへ遷移
    Route::get('profile/email', 'UserController@showEmailProfile')->name('user.email_edit');
    // パスワード編集ページへ遷移
    Route::get('profile/password', 'UserController@showPasswordProfile')->name('user.password_edit');
    
    // ユーザー退会確認画面遷移
    Route::get('users/delete_confirm', 'UserController@delete_confirm')->name('users.delete_confirm');

    // ユーザー退会処理 問題あり
    Route::delete('users/delete', 'UserController@userDelete')->name('user.delete');

});