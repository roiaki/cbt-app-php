@extends('layouts.app')

@section('title', '使い方')

@section('content')

<div class="row justify-content-center mt-5">
  <div class="col-sm-8" id="input_frame">
    <h3 class="title_head">{{ __('messages.info_title') }}</h3>
    <br>
      <p>
        <span class="under_line">{{ __('messages.step01') }}</span><br>
        {{ __('messages.info_sentence01') }}
        <br>
      </p>
      <p>
        <span class="under_line">{{ __('messages.step02') }}</span><br>
        {{ __('messages.info_sentence02') }}  
      </p>

      <p><span class="under_line">{{ __('messages.step03') }}</span><br>
        {{ __('messages.info_sentence03') }}<br>
        
      </p>
  </div>
</div>

@endsection