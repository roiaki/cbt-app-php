<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>
    @hasSection('title')
      @yield('title')
    @else
      {{ config('app.name') }}
    @endif
  </title>
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
  <!-- <script src="https://unpkg.com/vue@next"></script> -->
  
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
    @include('navs.nav')
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
      © 2022 Copyright roiaki with compose beauty poem All rights reserved.</a>
    </div>
    <!-- Copyright -->
  </footer>


</div>
  <script src="{{ mix('/js/app.js') }}"></script>
  <script src="{{ mix('/js/main.js') }}"></script>
  <script src="{{ mix('/js/validation.js') }}"></script>
  <script src="{{ mix('/js/modal.js') }}"></script>
  
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
 
</body>
</html>