<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>CBT APP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
 
  <!-- ここから動作OK -->
  <!-- animate css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

  <!-- Vue.js を読み込む -->
  <!--<script src="https://unpkg.com/vue@next"></script>-->
  
  <!-- 開発バージョン、便利なコンソールの警告が含まれています -->
  <!--<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>-->
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-B417VSZPK0"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-B417VSZPK0');
  </script>
 
</head>

<body id="content">
<div class="footerFixed">
 
  
  <header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light" id="nav1">
      <!-- <a class="navbar-brand font-weight-bold ml-5 beauty" href="/" id="sam">CBT APP</a> -->
      <a class="navbar-brand font-weight-bold ml-5" href="/" id="sam">CBT APP</a>
      
      <!-- 横幅が狭い時に出るハンバーガーボタン -->
      <button type="button" 
              class="navbar-toggler" 
              data-toggle="collapse" 
              data-target="#Navber" 
              aria-controls="Navber" 
              aria-expanded="false" 
              aria-label="レスポンシブ・ナビゲーションバー">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="Navber">
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
            <li class="nav-item font-weight-bold">{!! link_to_route('seven_columns', __('messages.7col_list'), [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item font-weight-bold mr-3">{!! link_to_route('solutions', __('messages.solution_list'), [], ['class' => 'nav-link']) !!}</li>

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
            <!-- アカウントdropdwon -->
            <li class="dropdown font-weight-bold pt-2" id="nav-lang">
              <a href="#" class="dropdown-toggle text-black-50" data-toggle="dropdown">
                {{ __('messages.account') }}
                <span class="caret"></span></a>
              <ul class="dropdown-menu bg-light text-black-50" aria-labelledby="dropdownMenu1">
                <li>{!! link_to_route('users.profile', __('messages.profile'), [], ['class' => 'nav-link']) !!}</li>
                <li>{!! link_to_route('logout.get', __('messages.logout'), [], ['class' => 'nav-link']) !!}</li>
                <li>{!! link_to_route('users.delete_confirm', __('messages.withdrawal'), [], ['class' => 'nav-link']) !!}</li>
              </ul>
            </li>
            <!-- /アカウントdropdown -->
            
          @else
            <!-- ここから言語切り替え -->
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
            <!-- ここまで言語切り替え -->
            
            <li class="nav-item font-weight-bold">{!! link_to_route('top', 'TOP', [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item font-weight-bold">{!! link_to_route('login', __('auth.Login'), [], ['class' => 'nav-link']) !!}</li>
            <li class="nav-item font-weight-bold">{!! link_to_route('signup.get', __('auth.Register'), [], ['class' => 'nav-link']) !!}</li>

          @endif
       
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
    @yield('content1')
    <div class="container mb-6">
      @yield('content')
    </div>
  </main>
  <!-- フッター -->
  <footer class="footer">
    <!-- Copyright -->
    <div class="text-center p-4">
      © 2022 Copyright roiaki with compose beauty poem All rights reserved.</a>
    </div>
    <!-- Copyright -->
  </footer>


</div>
  <script src="{{ mix('/js/app.js') }}"></script>
  <script src="{{ mix('/js/main.js') }}"></script>
  <script src="{{ mix('/js/validation.js') }}"></script>
  <script src="{{ mix('/js/modal.js') }}"></script>
  <!-- <script type="text/javascript" src="{{ asset('js/vanilla-tilt.js') }}"></script> -->

  <script>
    // var windowWidth = $(window).width();
    // var windowSm = 640;
    // console.log(windowWidth);
    // if(windowWidth > windowSm) {
    //   VanillaTilt.init(document.querySelector(".welcomeglasscard"), {
    //   max: 2,
    //   speed: 1.,
    //   glare: true,
    //   "max-glare": 0.5
    // });

  
    // VanillaTilt.init(document.querySelector(".glasscard"), {
    //   max: 0,
    //   speed: 0.1
    // });
    //  } 
</script>
  <!-- JQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- @check kore-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <!-- MDB core JavaScript -->
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script> -->
  <!-- fontawesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

  <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script> -->
  


  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Propper.js読み込み -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script> -->
  <!-- <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script> -->
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
  <script>
    $(function() {
    $('.Toggle').click(function() {
        $(this).toggleClass('active');
      $('.menu').toggleClass('open');
      });
    });
  </script>

  <script>
    window.onload = function() {
      $('#SampleModal').on('shown.bs.modal', function (event) {
          var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
          var title = button.data('title');//data-titleの値を取得
          var url = button.data('url');//data-urlの値を取得
          var modal = $(this);//モーダルを取得

          //Ajaxの処理はここに
          //modal-bodyのpタグにtextメソッド内を表示
          modal.find('.modal-body p').eq(0).text("本当に"+title+"を削除しますか?");
          //formタグのaction属性にurlのデータ渡す
          modal.find('form').attr('action',url);
      });
    }
  </script>
</body>
</html>