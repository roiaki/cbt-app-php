<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;    // 追加
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

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
        $name  = "GuestUser";
        
        $user = new User();
        $user->name     = $name;
        $user->email    = $email . "@test.com";
        $user->password = Hash::make('testtest');
        $user->save();

        Auth::login($user);
        
        return view('users.info');
    }

    // プロフィール編集画面表示
    public function show() {
        
        $user = User::find(Auth::id());

        return view('users.profile', ['user' => $user]);
    }

    // プロフィール更新処理
    public function update(Request $request) {
        
        $user = User::find(Auth::id());

        if(Auth::id() === $user->id) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->updated_at = date("Y-m-d G:i:s");
    
            // 二重送信対策
            $request->session()->regenerateToken();
    
            $user->save();
        }
        return redirect('/profile');
    }
}
