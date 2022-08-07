@extends('layouts.app')

@section('content')
<?php
  $locale = App::currentLocale();
  $json_array = json_encode($locale);
?>
<script>
	let locale = <?php echo $json_array; ?>
</script>
<div class="glasscard row justify-content-center">
  <div class="col-sm-7">
  <h3 class="title_head">{{ __("event.event_edit_head") }}( id={{ $event->id }} )</h3>
    <form action="{{ route('events.update', ['event' => $event->id] ) }}" 
          method="post" 
          onsubmit="return eventValidation(locale);">

      @csrf
      @method('PUT')
      <div class="form-group">
        <!-- タイトル -->
        <label for="title"><h5>{{ __('event.event_edit_title') }}</h5></label>
        <input type="text" 
               class="form-control" 
               id="eventTitle" 
               name="title" 
               value="{{ $event->title }}">

        <!-- フロントバリデーションエラーメッセージ -->
        <div class="err-msg-name01 mt-3"></div>

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
        <label for="content"><h5>{{ __('event.event_edit_content') }}</h5></label>
        <textarea class="form-control" 
                  id="eventContent" 
                  name="content" 
                  cols="50" 
                  rows="3">{{ $event->content }}</textarea>
        <!--/内容-->
        
        <!-- フロントバリデーションエラーメッセージ -->
        <div class="err-msg-name02 mt-3"></div>

        <!-- バリデーションエラー表示-->
        @if($errors->has('content'))
          @foreach($errors->get('content') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
      </div>
      <!-- 更新ボタン -->
      <input type="submit" 
             class="btn btn-primary btn-lg" 
             value="{{ __('event.update_button') }}">

      <div class="buttons">
        <button type="button" class="btn btn-secondary btn-lg" onclick="history.back(-1)">{{ __('event.back') }}</button>
      </div>
    </form>

  </div>
</div>

@endsection