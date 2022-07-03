@extends('layouts.app')

@section('content')

    <div class="jumbotron" style="background:url(images/welcome_image.png); background-size:cover;">
      <div class="text-center">
        <p >{{ __('messages.sentence01') }}<br>{{ __('messages.sentence02') }}</p>
        <h1 class="outline">{{ __('messages.welcome_title') }}</h1>
        <h3 class="message animate__animated animate__zoomInDown">May you have many Smiles!</h3>
        <div style="margin-top:310px">
        @guest
          {!! link_to_route('guest.signup',  __('auth.GuestLogin'), [], ['class' => 'btn btn-success m-3 animate__animated animate__swing animate__delay-3s']) !!}
          {!! link_to_route('login', __('auth.Login'), [], ['class' => 'btn btn-primary m-3']) !!}
          {!! link_to_route('signup.get', __('messages.register'), [], ['class' => 'btn btn-secondary m-3']) !!}
        @endguest
        </div>
      </div>
    </div>

    <section class="cbt-title">
      <h2 class="about-cbt">{{ __('messages.about-cbt-title') }}</h2>
      <p class="about-text">{{ __('messages.about-cbt-message01') }}</p>
      <p class="about-text">{{ __('messages.about-cbt-message02') }}</p>
      <p class="about-text">{{ __('messages.about-cbt-message03') }}</p>
    </sectio>

    <section class="cbt-title">
      <h2 class="about-cbt">{{ __('messages.about-thisapp-title') }}</h2>
      <p class="about-text">{{ __('messages.about-thisapp-message') }}</p>
      
    </section>
   
@endsection