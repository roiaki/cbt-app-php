<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;    // 追加
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

use App\Http\Requests\UpdateNameRequest;
use App\Http\Requests\UpdateEmailRequest;

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

    // 名前編集ページへ遷移
    public function showNameProfile() {
        $user = Auth::user();
        return view('users.name_edit', ['user' => $user]);
    }
    // メールアドレス編集ページへ遷移
    public function showEmailProfile() {
        $user = Auth::user();
        return view('users.email_edit', ['user' => $user]);
    }
     // メールアドレス編集ページへ遷移
     public function showPasswordProfile() {
        $user = Auth::user();
        return view('users.password_edit', ['user' => $user]);
    }

    // 名前更新処理
    public function nameUpdate(UpdateNameRequest $request) {
        $userId = (int)$request->userId;
        $user   = User::find(Auth::id());
        if($user->id === $userId) {
            $user->name = $request->name;
            $user->updated_at = date("Y-m-d G:i:s");

            // 二重送信対策
            $request->session()->regenerateToken();

            $user->save();
        }
        return redirect('/profile');
    }

    // メールアドレス更新処理
    public function emailUpdate(UpdateEmailRequest $request) {
        $userId = (int)$request->userId;
        $user   = User::find(Auth::id());
        if($user->id === $userId) {
            $user->email = $request->email;
            $user->updated_at = date("Y-m-d G:i:s");

            // 二重送信対策
            $request->session()->regenerateToken();

            $user->save();
        }
        return redirect('/profile');
    }

    // パスワード更新処理
    public function passwordUpdate(Request $request) {
        $userId = (int)$request->userId;
        $user   = User::find(Auth::id());
        if($user->id === $userId) {
            $user->password = Hash::make($request->password);
            $user->updated_at = date("Y-m-d G:i:s");

            // 二重送信対策
            $request->session()->regenerateToken();

            $user->save();
        }
        return redirect('/profile');
    }
}
