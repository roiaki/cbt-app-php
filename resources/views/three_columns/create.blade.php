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
  <div class="col-sm-8">
    <h3 class="title_head"><h3>{{ __('threecolumn.page_title') }}</h3>
      <!-- model 第一引数：Modelのインスタンス、第二引数：連想配列　-->
      <form action="{{ route('three_columns.store') }}" 
            method="post" 
            onsubmit="return threecolumnValidation(locale);">
        @csrf
        <input type="hidden" name="eventid" value="{{ $event->id }}">

        <div class="form-group">

          <label for="title"><h5>{{ __('threecolumn.1-1_title') }}</h5></label>
          <input 
            type="text"
            class="form-control"
            id="title"
            name="title"
            value="{{ $event->title }}"
            readonly
          >

          <!-- バリデーションエラー表示-->
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
          <label for="content"><h5>{{ __('threecolumn.1-2_title') }}</h5></label>
          <textarea 
            class="form-control" 
            id="content" 
            name="content" 
            cols="90" 
            rows="5" 
            readonly>{{ $event->content }}
          </textarea>

          <!-- バリデーションエラー表示-->
          @if($errors->has('content'))
            @foreach($errors->get('content') as $message)
            <ul>
              <li class="ml-2 my-1 text-danger">{{ $message }}</li>
            </ul>
            @endforeach
          @endif
        </div>
        
        <!-- 感情名 -->
        <div class="row">
          <div class="form-group col">
            <label for="emotion_name"><h5>{{ __('threecolumn.2-1_title') }}</h5></label>
            <p class="alert alert-success" role="alert">
              {{ __('threecolumn.2-1_sentence') }}
            </p>

            <!-- フロントバリデーションエラーメッセージ -->
            <div class="err-msg-name01 mt-3"></div>

            <!-- サーバサイトバリデーション -->
            @if($errors->has('emotion_name'))
              @foreach($errors->get('emotion_name') as $message)
              <ul>
                <li class="ml-2 my-1 text-danger">{{ $message }}</li>
              </ul>
              @endforeach
            @endif

          </div>
          <!-- /感情名 -->

          <!-- 感情の強さ　-->
          <div class="form-group col">
            <label for="emotion_strength"><h5>{{ __('threecolumn.2-2_title') }}</h5></label>
            <p class="alert alert-success" role="alert">
              {{ __('threecolumn.2-2_sentence') }}
            </p>

            <!-- フロントバリデーションエラー -->
            <div class="err-msg-name02 mt-3"></div>

            <!-- サーバサイトバリデーション -->
            @if($errors->has('emotion_strength'))
              @foreach($errors->get('emotion_strength') as $message)
              <ul>
                <li class="ml-2 my-1 text-danger">{{ $message }}</li>
              </ul>
              @endforeach
            @endif

          </div>
      </div>

      <!-- 動的に増える感情名と強さの入力フォーム-->
      <div id="app">
        <add></add>  
      </div>

      <!-- サーバサイドバリデーションエラー表示-->
      <div class="row">
        <div class="form-group col">
          @if($errors->has('emotion_name.*'))
            @foreach($errors->get('emotion_name.*') as $messages)
              @foreach($messages as $message)
              <ul>
                <li class="ml-2 my-1 text-danger">{{ $message }}</li>
              </ul>
              @endforeach
            @endforeach
          @endif
        </div>
        <div class="form-group col">
          @if($errors->has('emotion_strength.*'))
            @foreach($errors->get('emotion_strength.*') as $messages)
              @foreach($messages as $message)
              <ul>
                <li class="ml-2 my-1 text-danger">{{ $message }}</li>
              </ul>
              @endforeach
            @endforeach
          @endif
        </div>
      </div>
      
      <!-- 自動思考 -->
      <div class="form-group mt-4">
        <label for="thinking"><h5>{{ __('threecolumn.3-1_title') }}</h5></label>
        <p class="alert alert-success" role="alert">
          {{ __('threecolumn.3-1_sentence') }}
        </p>
        <textarea 
          class="form-control" 
          id="thinking" 
          name="thinking" 
          cols="90" 
          rows="5">{{ old('thinking') }}</textarea>

        <!-- フロントバリデーションエラーメッセージ -->
        <div class="err-msg-name03 mt-3"></div>

        <!-- バリデーションエラー表示-->
        @if($errors->has('thinking'))
          @foreach($errors->get('thinking') as $message)
            <ul>
              <li class="ml-2 my-1 text-danger">{{ $message }}</li>
            </ul>
          @endforeach
        @endif
      </div>

      <!-- 3-2考え方の癖 -->
      <label class="mt-3"><h5>{{ __('threecolumn.3-2_title') }}</h5></label>
      <p class="alert alert-success" role="alert">
        {{ __('threecolumn.3-2_sentence') }}
      </p>
      <div class="form-group">
        
        <!-- 癖１ -->
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="habit[0]" id="1">
          <label class="form-check-label" for="1">
            {{ __('threecolumn.habitName01') }}
          </label> 
        </div>
        <p class="mb-0">{{ __('threecolumn.habitContents01') }}</p>
        <p>{{ __('threecolumn.habitExamples01') }}</p>
        <!-- /癖１ -->

        <!-- 癖２ -->
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="habit[1]" id="2">
          <label class="form-check-label" for="2">
            {{ __('threecolumn.habitName02') }}
          </label>
        </div>
        <p class="mb-0">{{ __('threecolumn.habitContents02') }}</p>
        <p>{{ __('threecolumn.habitExamples02') }}</p>
        <!-- 癖２ -->

        <!-- 癖３ -->
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="habit[2]" id="3">
          <label class="form-check-label" for="3">
            {{ __('threecolumn.habitName03') }}
          </label>
        </div>
        <p class="mb-0">{{ __('threecolumn.habitContents03') }}</p>
        <p>{{ __('threecolumn.habitExamples03') }}</p>
        <!-- /癖３ -->

        <!-- 癖４ -->
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="habit[3]" id="4">
          <label class="form-check-label" for="4">
            {{ __('threecolumn.habitName04') }}
          </label>
        </div>
        <p class="mb-0">{{ __('threecolumn.habitContents04') }}</p>
        <p>{{ __('threecolumn.habitExamples04') }}</p>
        <!-- /癖４ -->

        <!-- 癖５ -->
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="habit[4]" id="5">
          <label class="form-check-label" for="5">
            {{ __('threecolumn.habitName05') }}
          </label>
        </div>
        <p class="mb-0">{{ __('threecolumn.habitContents05') }}</p>
        <p>{{ __('threecolumn.habitExamples05') }}</p>
        <!-- /癖５ -->

        <!-- 癖６ -->
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="habit[5]" id="6">
          <label class="form-check-label" for="6">
            {{ __('threecolumn.habitName06') }}
          </label>
        </div>
        <p class="mb-0">{{ __('threecolumn.habitContents06') }}</p>
        <p>{{ __('threecolumn.habitExamples06') }}</p>
        <!-- /癖６ -->

        <!-- 癖７ -->
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="habit[6]" id="7">
          <label class="form-check-label" for="7">
            {{ __('threecolumn.habitName07') }}
          </label>
        </div>
        <p class="mb-0">{{ __('threecolumn.habitContents07') }}</p>
        <p>{{ __('threecolumn.habitExamples07') }}</p>
        <!-- /癖７ -->

        <!-- バリデーションエラー表示-->
        @if($errors->has('habit'))
          @foreach($errors->get('habit') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
      </div>
      <!-- /3-2考え方の癖 -->

      <input type="submit" class="btn btn-primary btn-lg" value="{{ __('threecolumn.buttonCreate') }}"> 

      <div class="buttons">
        <button 
          type="button" 
          class="btn btn-secondary btn-lg" 
          onclick="history.back(-1)">{{ __('threecolumn.buttonBack') }}
        </button>
      </div>

    </form>
  
  </div>
</div>

@endsection