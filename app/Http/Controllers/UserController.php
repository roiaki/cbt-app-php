<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;    // 追加
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 退会処理　物理削除
    public function userDelete() {

        // 物理削除
        if(Auth::check()) {

            $user = User::find(Auth::id());
            $user->delete();
            Auth::logout();

            return redirect('/');
        }
    }

    // 退会確認画面
    public function delete_confirm() {

        return view('users.delete_confirm');
    }

    /**
     * ゲストユーザーを作成するメソッド
     * 簡易ゲストユーザー（名前はGuestUser、メアドはランダム）を作成しログインする
     * @return view('events.index'); 
     */
    public function guestUserCreate() {
        $email = uniqid();
        $name = "GuestUser";
        
        $user = new User();
        $user->name = $name;
        $user->email = $email . "@test.com";
        $user->password =  Hash::make('testtest');
        $user->save();

        Auth::login($user);
        
        return view('users.info');
    }
}
