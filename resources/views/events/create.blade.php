@extends('layouts.app')

@section('content')
<?php 
echo $locale;

$json_array = json_encode($locale);

?>
<script>
	let locale = <?php echo $json_array; ?>
</script>
<div class="row justify-content-center">
  <div class="col-sm-7">   
    <h3 class="title_head">{{ __('event.create_headtitle') }}</h3>
      <form action="{{ route('events.store') }}" method="post" onsubmit="return eventValidation(locale);">
        @csrf
        <div class="form-group">
          <!-- タイトル -->
          <label for="eventTitle"><h5>{{ __('event.create_title') }}</h5></label>
          <input type="text" class="form-control" id="eventTitle" name="title" value = "{{ old('title') }}" >
          <!-- /タイトル-->

          <!-- フロントバリデーションエラーメッセージ -->
          <div class="err-msg-name01 mt-3"></div>
          
          <!-- バリデーションエラー表示 -->
          @if($errors->has('title'))
            @foreach($errors->get('title') as $message)
              <div class="alert alert-danger mt-3" role="alert">
                <ul>
                  <li class="text-danger">{{ $message }}</li>
                </ul>
              </div>
            @endforeach
          @endif
          <!-- /バリデーションエラー表示 -->
        </div>

        <div class="form-group">
          <!-- 内容 -->
          <label for="eventContent"><h5>{{ __('event.create_contents') }}</h5></label>
          <textarea class="form-control" 
                    id="eventContent" 
                    name="content" 
                    cols="90" 
                    rows="7">{{ old('content') }}</textarea>
          <!-- /内容 -->

          <!-- フロントバリデーションエラーメッセージ -->
          <div class="err-msg-name02 mt-3"></div>

          <!-- バリデーションエラー表示 -->
          @if($errors->has('content'))
            @foreach($errors->get('content') as $message)
              <div class="alert alert-danger mt-3" role="alert">
                <ul>
                  <li class="text-danger">{{ $message }}</li>
                </ul>
              </div>
            @endforeach
          @endif
          <!-- /バリデーションエラー表示 -->
        </div>
         
        <input type="submit" 
               id="eventSubmit" 
               value="{{ __('event.create_button') }}" 
               class="btn btn-primary btn-lg"> 
        
        <div class="buttons">
          <button type="button" 
                  class="btn btn-secondary btn-lg" 
                  onclick="history.back(-1)">{{ __('event.back')}}</button>
        </div>
        
      </form>
      
  </div>
</div>

@endsection