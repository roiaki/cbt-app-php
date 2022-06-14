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
      <h2 class="about-cbt">{{ __('messages.about-cbt-title') }}</h2>
        <p class="about-text">{{ __('messages.about-cbt-message') }}</p>

    </sectio>

    <section class="cbt-title">
      <h2 class="about-cbt">{{ __('messages.about-thisapp-title') }}</h2>
      <p class="about-text">{{ __('messages.about-thisapp-message') }}</p>
    </section>
   
@endsection