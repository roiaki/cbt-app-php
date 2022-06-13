<?php
/*
if (session()->get('applocale') == 'ja') {
  $hour = date("H");
  if (5 <= $hour && $hour <= 12) {
    $msg = "おはようございます";
  } else if (17 < $hour || $hour < 5) {
    $msg = "こんばんは";
  } else {
    $msg = "こんにちは";
  }
} elseif(session()->get('applocale') == 'en') {
  $hour = date("H");
  if (5 <= $hour && $hour <= 12) {
    $msg = "good morning";
  } else if (17 < $hour || $hour < 5) {
    $msg = "good evning";
  } else {
    $msg = "hello";
  }
} elseif(session()->get('applocale') == 'uk') {
  $hour = date("H");
  if (5 <= $hour && $hour <= 12) {
    $msg = "good morning";
  } else if (17 < $hour || $hour < 5) {
    $msg = "good evning";
  } else {
    $msg = "hello";
  }
}
$data = session()->all();
//var_dump($data,$msg);

*/

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

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-B417VSZPK0"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-B417VSZPK0');
  </script>


</head>

<body>
<div class="footerFixed">
  <header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <a class="navbar-brand font-weight-bold ml-5" href="/events">CBT APP</a>

      <!-- 横幅が狭い時に出るハンバーガーボタン -->
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="nav-bar">
        <ul class="navbar-nav ml-auto">

          @if(Auth::check())
          
            <div class="d-flex align-items-center mr-4 pt-1 text-black-50 font-weight-bold">
              <p clsss="text-primary">
                ID : {{ $id = Auth::user()->id; }} {{ __('messages.en_mr_ms') }}&nbsp;
               {{ $name = Auth::user()->name; }} {{ __('messages.ja_mr_ms') }} 
            </div>

            <li class="nav-item font-weight-bold">{!! link_to_route('users.info',  __('messages.info'), [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item font-weight-bold">{!! link_to_route('events', __('messages.event_list'), [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item font-weight-bold">{!! link_to_route('three_columns', __('messages.3col_list') , [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item font-weight-bold mr-3">{!! link_to_route('seven_columns', __('messages.7col_list'), [], ['class' => 'nav-link']) !!}</li>

            <!-- 言語切り替え -->
            <li class="dropdown font-weight-bold pt-2 mr-3" id="nav-lang">
              <a href="#" class="dropdown-toggle text-black-50" data-toggle="dropdown" role="button">
                {{ Config::get('languages')[App::getLocale()] }}
                <span class="caret"></span>
              </a>
                <ul class="dropdown-menu bg-light" aria-labelledby="dropdownMenu1">
                  @foreach (Config::get('languages') as $lang => $language)
                  @if ($lang != App::getLocale())
                  <li>
                    <a class="text-black-50" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                  </li>
                  @endif
                  @endforeach
               </ul>
            </li>
            <!-- ここまで言語切り替え -->
            <!-- アカウント -->
            <li class="dropdown font-weight-bold pt-2" id="nav-lang">
              <a href="#" class="dropdown-toggle text-black-50" data-toggle="dropdown">
                {{ __('messages.account') }}
                <span class="caret"></span></a>
              <ul class="dropdown-menu bg-light text-black-50" aria-labelledby="dropdownMenu1">
                <li>{!! link_to_route('logout.get', __('messages.logout'), [], ['class' => 'nav-link']) !!}</li>
                <li>{!! link_to_route('users.delete_confirm', __('messages.withdrawal'), [], ['class' => 'nav-link']) !!}</li>
              </ul>
            </li>

          @else
            <!-- 言語切り替え -->
            <li class="dropdown font-weight-bold pt-2" id="nav-lang">
              <a href="#" class="dropdown-toggle text-black-50" data-toggle="dropdown">
                {{ Config::get('languages')[App::getLocale()] }}
                <span class="caret"></span></a>
              <ul class="dropdown-menu bg-light text-black-50" aria-labelledby="dropdownMenu1">
                @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                <li>
                  <a class="text-black-50" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                </li>
                @endif
                @endforeach
              </ul>
            </li>
            <!-- 言語切り替え -->
            
            <li class="nav-item font-weight-bold">{!! link_to_route('top', 'TOP', [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item font-weight-bold">{!! link_to_route('login', __('auth.Login'), [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item font-weight-bold">{!! link_to_route('signup.get', __('auth.Register'), [], ['class' => 'nav-link']) !!}</li>

          @endif
        </ul>
        </ul>
      </div>
    </nav>
  </header>
    <!-- フラッシュメッセージ -->
    @if(session('flash_message'))
      <div class="d-block mx-auto img-fluid w-50 alert alert-success justify-content-center col-5" id="flash">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{session('flash_message')}}
      </div>
    @endif
          
    <!-- ページ　-->
    <main class="mb-5">
      <div class="container mb-6">
        @yield('content')
      </div>
    </main>
    <!-- フッター -->
    <footer class="footer">
      <!-- Copyright -->
      <div class="text-center p-4">
        © 2022 Copyright: roiaki All rights reserved.</a>
      </div>
      <!-- Copyright -->
    </footer>

    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

    <!-- jQuery読み込み -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <!-- Propper.js読み込み -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
  
</div>
</body>
</html>