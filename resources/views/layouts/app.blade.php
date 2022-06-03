<?php

$hour = date("H");
if (5 <= $hour && $hour <= 12) {
  $msg = "おはようございます";
} else if (17 < $hour || $hour < 5) {
  $msg = "こんばんは";
} else {
  $msg = "こんにちは";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>CBT APP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('css/main.css')}}">

  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
  
  <!-- Vue.js を読み込む -->
  <script src="https://unpkg.com/vue@next"></script>
  
  <!-- bootstrap読み込み　-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  
</head>

<body>
  <header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <a class="navbar-brand fw-bold ml-5" href="/events">CBT APP</a>

      <!-- 横幅が狭い時に出るハンバーガーボタン -->
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="nav-bar">
        <ul class="navbar-nav ml-auto">

          @if(Auth::check())
          
            <div class="d-flex align-items-center">
              ID {!! $id = Auth::user()->id; !!} 番 {!! $name = Auth::user()->name; !!} さん、{{ $msg; }}
            </div>
          
            <li class="nav-item">{!! link_to_route('users.info',  __('auth.info'), [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item">{!! link_to_route('events', '出来事一覧', [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item">{!! link_to_route('three_columns', '3コラム一覧', [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item">{!! link_to_route('seven_columns', '7コラム一覧', [], ['class' => 'nav-link']) !!}</li>

            <!-- 言語切り替え -->
            <li class="dropdown d-flex align-items-center" id="nav-lang">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Config::get('languages')[App::getLocale()] }}
                <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                <li>
                  <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                </li>
                @endif
                @endforeach
              </ul>
            </li>
            <!-- 言語切り替え -->
            
            <div class="dropdown d-flex align-items-center mr-3">
              <button class="btn btn-default dropdown-toggle" 
                      type="button" 
                      id="dropdownMenu1" 
                      data-toggle="dropdown" 
                      aria-haspopup="true" 
                      aria-expanded="false">
                アカウント
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li>{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                <li>{!! link_to_route('users.delete_confirm', '退会', [], ['class' => 'nav-link']) !!}</li>
              </ul>
            </div>

          @else
            <!-- 言語切り替え -->
            <li class="dropdown d-flex align-items-center" id="nav-lang">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Config::get('languages')[App::getLocale()] }}
                <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                <li>
                  <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                </li>
                @endif
                @endforeach
              </ul>
            </li>
            <!-- 言語切り替え -->
            
            <li class="nav-item">{!! link_to_route('top', 'TOP', [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item">{!! link_to_route('signup.get', '会員登録', [], ['class' => 'nav-link']) !!}</li>

          @endif
        </ul>
        </ul>
      </div>
    </nav>
      <!-- フラッシュメッセージ -->
      @if(session('flash_message'))
        <div class="d-block mx-auto img-fluid w-50 alert alert-success justify-content-center col-5" id="flash">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{session('flash_message')}}
        </div>
      @endif
         

    <div class="container">
      @yield('content')
    </div>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    
    <!-- jQuery読み込み -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <!-- Propper.js読み込み -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

    
    
</body>

</html>