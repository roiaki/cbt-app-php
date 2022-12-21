@extends('layouts.top_app')

@section('title', 'CBT APP')

@section('toppage')
<section class="first">
  <div class="welcomeglasscard">
    <div class="text-center">
      <p class="top_app_text">{{ __('messages.sentence01') }}<br>{{ __('messages.sentence02') }}</p>
      <h1 class="app_title">{{ __('messages.welcome_title') }}</h1>
      <!-- <div>
        <h3>
          <span class="message animate__animated animate__backInDown animate__delay-1s">May you have many smailes!</span>
        </h3>          
      </div> -->
    </div>
  </div>
   
  @guest
  <div class="container text-center" style="margin-top:100px">
    <div class="col">
      <div class="col-sm">{!! link_to_route('guest.signup',  __('auth.GuestLogin'), [], ['class' => 'btn btn-success m-3']) !!}</div>
      <div class="col-sm">{!! link_to_route('login', __('auth.Login'), [], ['class' => 'btn btn-primary m-3']) !!}</div>
      <div class="col-sm">{!! link_to_route('signup.get', __('messages.register'), [], ['class' => 'btn btn-secondary m-3']) !!}</div>
    </div>
  </div>
  @endguest
</section>

<section class="back01">
  <div class="d-flex justify-content-center">
    <div class="col-sm-7">
      <div class="top_page_card">
        <h2 class="top_page_title">{{ __('messages.about-cbt-title') }}</h2>
        <p class="about_text">{{ __('messages.about-cbt-message01') }}</p>
        <p class="about_text">{{ __('messages.about-cbt-message02') }}</p>
        <p class="about_text">{{ __('messages.about-cbt-message03') }}</p>
      </div>
    </div>
  </div>
</section>

<section class="back02">
  <div class="d-flex justify-content-center">
    <div class="col-sm-7">
      <div class="top_page_card">
        <h2 class="top_page_title">{{ __('messages.cognitive_distortion_title') }}</h2>
        <p class="about_text">{{ __('messages.cognitive_distortion_description') }}</p>
      </div>
      <div class="top_page_card">
        <h2 class="top_page_title">{{ __('messages.cognitive_distortion_cause_title') }}</h2>
        <p class="about_text">{{ __('messages.cognitive_distortion_cause') }}</p>
      </div>
    </div>
  </div>
</section>
  
<section class="back01">
  <div class="d-flex justify-content-center">
    <div class="col-sm-7">
      <div class="top_page_card">
        <h2 class="top_page_title">{{ __('messages.about-thisapp-title') }}</h2>
        <p class="about_text">{{ __('messages.about-thisapp-message') }}</p>
      </div>
    </div>
  </div>
</section>

@endsection