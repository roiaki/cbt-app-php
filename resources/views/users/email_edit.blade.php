@extends('layouts.app')

@section('content')
<?php 
  $locale = App::currentLocale();
  $json_array = json_encode($locale);
?>

<div class="glasscard row justify-content-center">
  
  <div class="col-sm-9">
    <h3 class="title_head">メールアドレスの編集</h3>
    <div class="container">
      <div class="row">
      <form action="{{ route('user.emailupdate') }}"
            method="POST">
        @csrf
        @method('PUT')
        <table class="table">
          <tr>
            <th class="col-3 profile">メールアドレス</th>
          </tr>
          <tr>
            <td class="col-7">
              <input 
                type="email"
                id="email"
                class="form-control"
                name="email"
                value="{{ $user->email }}">
              <input type="hidden" name="userId" value="{{ $user->id }}">
              
              <!-- サーバサイドバリデーションエラー表示 -->
              @if($errors->has('email'))
                @foreach($errors->get('email') as $message)
                  <div class="alert alert-danger mt-3" role="alert">
                    <ul>
                      <li class="text-danger">{{ $message }}</li>
                    </ul>
                  </div>
                @endforeach
              @endif
              <!-- /サーバーサイドバリデーションエラー表示 -->
              
            </td>
          </tr>    
        </table>
        <button type="submit" class="btn btn-primary mt-5 mb-5">保存</button>
      </form>
      </div>
    </div>
  </div>

@endsection

