@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">  
  <h3 class="title_head">{{ __('sevencolumn.sevencolEditPageTitle') }}</h3>
    <!-- 'route' => ['messages.update', $message->id] というルーティング指定になります。
        配列の2つ目に $message->id を入れることで 
        update の URL である /messages/{message} の {message} に id が入ります
        -->

    <form action="{{ route('seven_columns.update', ['param' => $seven_column->id] ) }}" method="POST">
      @csrf
      @method('PUT')
      <div id="read_only_frame">
        <div class="form-group">
          <!-- タイトル -->
          <label for="title"><h5>{{ __('sevencolumn.1-1_title') }}</h5></label>
          <input 
            type="text"
            class="form-control"
            id="title"
            name="title"
            readonly
            value="{{ $event->title }}">
        
          <!-- タイトル必須バリデーション表示 課題：まとめてかけないか-->
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
        <label for="content"><h5>{{ __('sevencolumn.1-2_title') }}</h5></label>
        <textarea 
          class="form-control" 
          id="content" 
          name="content" 
          cols="50" 
          rows="3"
          readonly>{{ $event->content }}</textarea>

        <!-- 内容必須バリデーション表示-->
        @if($errors->has('content'))
          @foreach($errors->get('content') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
      </div>
      
      <div class="form-group">
        <label for="thinking"><h5>{{ __('sevencolumn.3-1_title') }}</h5></label>
        <textarea 
          class="form-control" 
          id="thinking" 
          name="thinking" 
          cols="50" 
          rows="3" 
          readonly>{{ $three_column->thinking }}</textarea>

        <!-- 内容必須バリデーション表示-->
        @if($errors->has('thinking'))
        @foreach($errors->get('thinking') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>
      </div>

      <div class="form-group" id="input_frame">
        <label for="basis_thinking"><h5>{{ __('sevencolumn.4_title') }}</h5></label>
        <textarea 
          class="form-control" 
          id="basis_thinking" 
          name="basis_thinking" 
          cols="50" 
          rows="3" required>{{ $seven_column->basis_thinking }}</textarea>

        <!-- 内容必須バリデーション表示-->
        @if($errors->has('basis_thinking'))
        @foreach($errors->get('basis_thinking') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <div class="form-group" id="input_frame">
        <label for="opposite_fact"><h5>{{ __('sevencolumn.5_title') }}</h5></label>
        <textarea 
          class="form-control" 
          id="opposite_fact" 
          name="opposite_fact" 
          cols="50" 
          rows="3" required>{{ $seven_column->opposite_fact }}</textarea>

        <!-- 内容必須バリデーション表示-->
        @if($errors->has('opposite_fact'))
        @foreach($errors->get('opposite_fact') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <div class="form-group" id="input_frame">
        <label for="new_thinking"><h5>{{ __('sevencolumn.6_title') }}</h5></label>
        <textarea 
          class="form-control" 
          id="new_thinking" 
          name="new_thinking" 
          cols="50" 
          rows="3" required>{{ $seven_column->new_thinking }}</textarea>

        <!-- 内容必須バリデーション表示-->
        @if($errors->has('new_thinking'))
        @foreach($errors->get('new_thinking') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <!-- ７新しい感情 -->
      <div class="form-group" id="input_frame">
        <h5>{{ __('sevencolumn.7_title') }}</h5>
        <!-- ここから　-->
        <div class="row mt-3">
        <div class="form-group col-4">
          <label for="emotion_name">{{ __('sevencolumn.emotion_name') }}</label>
          <ul class="list-group">
            @if(isset($new_emotions[0]->new_emotion_name))
              <li class="list-group-item">{{ $new_emotions[0]->new_emotion_name }}</li>
              <input 
                type="hidden"
                name="new_emotion_name00"
                value="{{ $new_emotions[0]->new_emotion_name }}">
            @endif

            @if(isset($new_emotions[1]->new_emotion_name))
              <li class="list-group-item">{{ $new_emotions[1]->new_emotion_name }}</li>
              <input 
                type="hidden"
                name="new_emotion_name01"
                value="{{ $new_emotions[1]->new_emotion_name }}">
            @endif

            @if(isset($new_emotions[2]->new_emotion_name))
              <li class="list-group-item">{{ $new_emotions[2]->new_emotion_name }}</li>
              <input 
                type="hidden"
                name="new_emotion_name02"
                value="{{ $new_emotions[2]->new_emotion_name }}">
            @endif
          </ul>
        </div>

        <!-- 以前の感情の強さ -->
        <div class="form-group col-4">
          <label for="emotion_strength">{{ __('sevencolumn.prev_emotion_strength') }}</label>
          <ul class="list-group">
            
            @if(isset($emotions[0]->emotion_strength))
              <li class="list-group-item">{{ $emotions[0]->emotion_strength }}</li>
            @endif

            @if(isset($emotions[1]->emotion_strength))
              <li class="list-group-item">{{ $emotions[1]->emotion_strength }}</li>
            @endif
            
            @if(isset($emotions[2]->emotion_strength))
              <li class="list-group-item">{{ $emotions[2]->emotion_strength }}</li>
            @endif
          </ul>
        </div>
        <!-- /以前の感情の強さ -->

        <!-- 新しいの感情の強さ -->
        <div class="form-group col-4">
          <label for="emotion_strength">{{ __('sevencolumn.new_emotion_strength') }}</label>

          @if(isset($emotions[0]->emotion_strength))
          <input 
            type="number" 
            class="form-control" 
            id="new_emotion_strength" 
            name="new_emotion_strength00"
            value="{{ $new_emotions[0]->new_emotion_strength }}"
            style="height:50px;"
            required>
          @endif

          @if(isset($emotions[1]->emotion_strength))
          <input 
            type="number" 
            class="form-control mt-3" 
            id="new_emotion_strength01" 
            name="new_emotion_strength01"
            value="{{ $new_emotions[1]->new_emotion_strength }}"
            required>
          @endif

          @if(isset($emotions[2]->emotion_strength))
          <input 
            type="number" 
            class="form-control mt-3" 
            id="new_emotion_strength02" 
            name="new_emotion_strength02"    
            value="{{ $new_emotions[2]->new_emotion_strength }}"
            style="height:50px;"
            required>
          @endif
        </div>
        <!-- /新しいの感情の強さ -->
      </div>
      <!-- /７新しい感情 -->

        @if($errors->has('new_emotion'))
          @foreach($errors->get('new_emotion') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
      
      </div>

      <div class="buttons-first">
        {!! Form::submit('更新', ['class' => 'btn btn-primary btn-lg']) !!}
      </div>

      <div class="buttons">
        <button type="button" class="btn btn-secondary btn-lg" onclick="history.back(-1)">戻る</button>
      </div>
    </form>
    
  </div>
</div>

@endsection