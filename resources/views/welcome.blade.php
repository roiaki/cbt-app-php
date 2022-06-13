@extends('layouts.app')

@section('content')

    <div class="jumbotron" style="background:url(images/welcome_image.png); background-size:cover;">
      <div class="text-center">
        <h1>{{ __('messages.welcome_title') }}</h1>
        <p style="margin-top:20px">{{ __('messages.sentence01') }}<br>{{ __('messages.sentence02') }}</p>
        <h3 style="margin-top:30px">May your heart suffer less</h3>
        <div style="margin-top:310px">
        {!! link_to_route('signup.get', __('messages.register'), [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
      </div>
    </div>

    <section class="cbt-title">
      <h2 class="about-cbt">認知行動療法とは</h2>
        <p class="about-text">私たちが生きていく中で、時に様々な困難な状況に直面し、時に問題を解決できない、気持ちが切り替えられないなど八方ふさがりに感じて困ってしまう事があるやもしれません。
          過度に楽観的、悲観的でもない「現実的でバランスの取れた」考えから問題解決を目指す心理療法です。</p>

    </sectio>

    <section class="cbt-title">
      <h2 class="about-cbt">このアプリについて</h2>
      <p class="about-text">このアプリは、認知行動療法の流れ（3コラム、7コラム法）に沿って自分で考えや気持ちを書き出します。それらが困難なものならば、整理して解決に向けて好ましいものに修正する、そんな問題解決の補助を目指したものです。</p>
    </section>
   
@endsection