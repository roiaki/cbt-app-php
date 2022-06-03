@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">
  <h3 class="title_head">{{ __("event.event_edit_head") }}( id={{ $event->id }} )</h3>
    <form action="{{ route('events.update', ['event' => $event->id] ) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <!-- タイトル -->
        <label for="title">{{ __('event.event_edit_title') }}</label>
        <input type="text" 
               class="form-control" 
               id="title" 
               name="title" 
               value="{{ $event->title }}"
        >

        <!-- バリデーションエラー表示 課題：まとめてかけないか-->
        @if($errors->has('title'))
        @foreach($errors->get('title') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <div class="form-group">
        <!-- 内容 -->
        <label for="content">{{ __('event.event_edit_content') }}</label>
        <textarea class="form-control" 
                  id="content" 
                  name="content" 
                  cols="50" 
                  rows="3">{{ $event->content }}</textarea>

        <!-- バリデーションエラー表示-->
        @if($errors->has('content'))
        @foreach($errors->get('content') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>
      <input type="submit" class="btn btn-primary btn-lg" value="{{ __('event.update_button') }}">


      <div class="buttons">
        <button type="button" class="btn btn-secondary btn-lg" onclick="history.back(-1)">{{ __('event.back') }}</button>
      </div>
    </form>

  </div>
</div>

@endsection