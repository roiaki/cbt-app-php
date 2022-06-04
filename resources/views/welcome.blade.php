@extends('layouts.app')

@section('content')

    <div class="jumbotron" style="background:url(images/welcome_image.png); background-size:cover;">
      <div class="text-center">
        <h1>{{ __('messages.welcome_title') }}</h1>
        <p style="margin-top:20px">{{ __('messages.sentence01') }}<br>{{ __('messages.sentence02') }}</p>
        <h2 style="margin-top:30px">May your heart suffer less</h2>
        <div style="margin-top:40px">
        {!! link_to_route('signup.get', __('messages.register'), [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
      </div>
    </div>
   
@endsection