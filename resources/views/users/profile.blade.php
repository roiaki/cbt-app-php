<?php 
  $locale = App::currentLocale();
  $json_array = json_encode($locale);
?>
@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  
  <div class="col-sm-8">
    <h3 class="title_head">プロフィール</h3>
      <div class="container">
        <div class="row">
          <table class="table table-bordered">
          <tr>
            <th class="col-12 profile">お名前</th>
            <td class="col-7">{{ $user->name }}</td>
            <td class="col-2">
              <a href="{{ route('user.name_edit') }}" class="profiles">編集</a>
            </td>
          </tr>
          <tr>
            <th class="col-3 profile">メールアドレス</th>
            <td class="col-7">{{ $user->email }}</td>
            <td class="col-2">
              <a href="{{ route('user.email_edit') }}" class="profiles">編集</a></td>
          </tr>
          <tr>
            <th class="col-3 profile">パスワード</th>
            <td class="col-7"></td>
            <td class="col-2">
              <a href="{{ route('user.password_edit') }}" class="profiles">編集</a></td>
          </tr>
          </table>
        </div>
      </div>
  </div>
@endsection

