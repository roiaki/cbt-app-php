@extends('layouts.app')

@section('content1')
<!-- <div class="glasscard" style="background-color:#f7f7f7; background-size:auto;"> -->
    <div class="welcomeglasscard">
      <div class="text-center">
        <p class="pt-5">{{ __('messages.sentence01') }}<br>{{ __('messages.sentence02') }}</p>
        <h1 class="outline">{{ __('messages.welcome_title') }}</h1><br>
        <div>
          <h3 style="font-family: cursive;">
            <span class="message animate__animated animate__fadeIn animate__delay-1s">May</span>
            <span class="message animate__animated animate__fadeIn animate__delay-2s">you</span>
            <span class="message animate__animated animate__fadeIn animate__delay-3s">have</span>
            <span class="message animate__animated animate__fadeIn animate__delay-4s">many Smiles!</span>
          </h3>
        </div>
        
        @guest
        <div class="container" style="margin-top:100px">
          <div class="row">
            <div class="col-sm">{!! link_to_route('guest.signup',  __('auth.GuestLogin'), [], ['class' => 'btn btn-success m-3 animate__animated animate__swing animate__delay-5s']) !!}</div>
            <div class="col-sm">{!! link_to_route('login', __('auth.Login'), [], ['class' => 'btn btn-primary m-3']) !!}</div>
            <div class="col-sm">{!! link_to_route('signup.get', __('messages.register'), [], ['class' => 'btn btn-secondary m-3']) !!}</div>
          </div>
        </div>
        @endguest
       
      </div>
    </div>
    <div>
      <!--<audio controlslist="nodownload" controls autoplay src="images/bgm.mp3" loop></audio>-->
    </div>
    <div class="container">
      <div class="">
        <section class="cbt-title">
          <h2 class="about-cbt mt-5">{{ __('messages.about-cbt-title') }}</h2>
          <p class="about-text">{{ __('messages.about-cbt-message01') }}</p>
          <p class="about-text">{{ __('messages.about-cbt-message02') }}</p>
          <p class="about-text">{{ __('messages.about-cbt-message03') }}</p>
        </sectio>
      
        <section class="cbt-title">
          <h2 class="about-cbt">{{ __('messages.about-thisapp-title') }}</h2>
          <p class="about-text">{{ __('messages.about-thisapp-message') }}</p>
        </section>
      </div>
    </div>
    
@endsection