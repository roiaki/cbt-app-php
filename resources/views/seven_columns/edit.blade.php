@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">  
  <h3 class="title_head">7コラム編集ページ ( id={{ $seven_column->id }} )</h3>
    <!-- 'route' => ['messages.update', $message->id] というルーティング指定になります。
        配列の2つ目に $message->id を入れることで 
        update の URL である /messages/{message} の {message} に id が入ります
        -->
    {!! Form::model($seven_column, 
          ['route' => ['seven_columns.update', $seven_column->id], 
          'method' => 'put']) 
    !!}

    <form action="{{ route('seven_columns.update', ['param' => $seven_column->id] ) }}" method="POST">
      @csrf
      @method('PUT')
        <div class="form-group">
          <!-- タイトル -->
          <label for="title"><h5>{{ __('sevencolumn.1-1_title') }}</h5></label>
          <input type="text"
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
        <textarea class="form-control" 
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
        <label for="emotion-name">②-1  感情名</label>
        <input type="text" 
              class="form-control" 
              name="emotion_name" 
              readonly 
              value="{{ $three_column->emotion_name }}">

        <!-- 内容必須バリデーション表示-->
        @if($errors->has('emotion_name'))
        @foreach($errors->get('emotion_name') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>
      
      <div class="form-group">
        <label for="emotion-strength">②-2  強さ</label>
        <input type="number" 
              class="form-control" 
              name="emotion_strength" 
              readonly 
              value="{{ $three_column->emotion_strength }}">

        <!-- 内容必須バリデーション表示-->
        @if($errors->has('emotion_strength'))
        @foreach($errors->get('emotion_strength') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>
      
      <div class="form-group">
        <label for="thinking"><h5>{{ __('sevencolumn.3-1_title') }}</h5></label>
        <textarea class="form-control" 
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

      <div class="form-group">
        <label for="basis_thinking"><h5>{{ __('sevencolumn.4_title') }}</h5></label>
        <textarea class="form-control" 
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

      <div class="form-group">
        <label for="opposite_fact"><h5>{{ __('sevencolumn.5_title') }}</h5></label>
        <textarea class="form-control" 
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

      <div class="form-group">
        <label for="new_thinking"><h5>{{ __('sevencolumn.6_title') }}</h5></label>
        <textarea class="form-control" 
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
      <div class="form-group">
        <h5>{{ __('sevencolumn.7_title') }}</h5>
        <!-- ここから　-->
        <div class="row mt-3">
        <div class="form-group col-3">
          <label for="emotion_name">{{ __('sevencolumn.emotion_name') }}</label>
          
          <ul class="list-group">
            <li class="list-group-item">{{$three_column->emotion_name }}</li>
            <input type="hidden"
                   name="new_emotion_name"
                   value="{{$three_column->emotion_name }}"
            >

            @if(isset($three_column->emotion_name00))
              <li class="list-group-item">{{$three_column->emotion_name00 }}</li>
              <input type="hidden"
                     name="new_emotion_name00"
                     value="{{$three_column->emotion_name00 }}"
              >
            @endif

            @if(isset($three_column->emotion_name01))
              <li class="list-group-item">{{$three_column->emotion_name01 }}</li>
              <input type="hidden"
                     name="new_emotion_name01"
                     value="{{$three_column->emotion_name01 }}"
              >
            @endif

            @if(isset($three_column->emotion_name02))
              <li class="list-group-item">{{$three_column->emotion_name02 }}</li>
              <input type="hidden"
                     name="new_emotion_name02"
                     value="{{ $three_column->emotion_name02 }}"
              >
            @endif
          </ul>

        </div>

        <!-- 以前の感情の強さ -->
        <div class="form-group col-3">
          <label for="emotion_strength">{{ __('sevencolumn.prev_emotion_strength') }}</label>
          <ul class="list-group">
            <li class="list-group-item">{{$three_column->emotion_strength }}</li>
            
            @if(isset($three_column->emotion_strength00))
              <li class="list-group-item">{{$three_column->emotion_strength00 }}</li>
            @endif
            
            @if(isset($three_column->emotion_strength01))
              <li class="list-group-item">{{$three_column->emotion_strength01 }}</li>
            @endif
            
            @if(isset($three_column->emotion_strength02))
              <li class="list-group-item">{{$three_column->emotion_strength02 }}</li>
            @endif
          </ul>
        </div>
        <!-- /以前の感情の強さ -->

        <!-- 新しいの感情の強さ -->
        <div class="form-group col-3">
          <label for="emotion_strength">{{ __('sevencolumn.new_emotion_strength') }}</label>
          <input type="number" 
                 class="form-control mt-1" 
                 id="new_emotion_strength" 
                 name="new_emotion_strength"
                 value="{{ $seven_column->new_emotion_strength }}"
                 required>

          @if(isset($three_column->emotion_strength00))
          <input type="number" 
                 class="form-control mt-3" 
                 id="new_emotion_strength00" 
                 name="new_emotion_strength00"
                 value="{{ $seven_column->new_emotion_strength00 }}"
                 required>
          @endif

          @if(isset($three_column->emotion_strength01))
          <input type="number" 
                 class="form-control mt-3" 
                 id="new_emotion_strength01" 
                 name="new_emotion_strength01"
                 value="{{ $seven_column->new_emotion_strength01 }}"
                 required>
          @endif

          @if(isset($three_column->emotion_strength02))
          <input type="number" 
                 class="form-control mt-3" 
                 id="new_emotion_strength02" 
                 name="new_emotion_strength02"    
                 value="{{ $seven_column->new_emotion_strength02 }}"
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