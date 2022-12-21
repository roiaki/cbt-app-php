<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>
    @yield('title')
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
  <!--  -->
  <script src="{{ mix('/js/app.js') }}"></script>
  <script src="{{ mix('/js/main.js') }}"></script>
  <script src="{{ mix('/js/validation.js') }}"></script>
  <!-- <script src="{{ mix('/js/modal.js') }}"></script> -->
  <!-- <script type="text/javascript" src="{{ asset('js/vanilla-tilt.js') }}"></script> -->

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
   <!-- Scripts -->
   <script src="{{ mix('js/app.js') }}"></script>
    <!-- JQuery -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- fontawesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>