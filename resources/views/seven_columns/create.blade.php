@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">
  <h3 class="title_head">７コラム新規作成</h3>
    <!-- model 第一引数：Modelのインスタンス、第二引数：連想配列　-->
    <form action="{{ route('seven_columns.store') }}" method="POST">
      @csrf

      <input type="hidden" name="threecol_id" value="{{ $three_column->id }}">
      <input type="hidden" name="event_id" value="{{ $three_column->event_id }}">
      
      <div class="form-group">
        <label for="title">①-1　出来事 の タイトル</label>
        <!-- idはグローバル属性であり、HTML内の全ての要素に適用される。
                 name属性はHTMLの特定の要素（フォーム要素）主にバックエンド
            -->
        <input type="text" 
               class="form-control" 
               id="title" 
               name="title" 
               value="{{ $event->title }}"
               readonly
        >

        <!-- タイトル必須バリデーション表示-->
        @if($errors->has('title'))
        @foreach($errors->get('title') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <div class="form-group">
        <label for="content">①-2  出来事 の 内容</label>
        <textarea class="form-control" 
                  id="content" 
                  name="content" 
                  cols="90" 
                  rows="5"
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
        <label for="thinking">③　その時考えたこと</label>
        <p>ポイント：言い訳せずに簡単な言葉で表現する</p>
        <textarea class="form-control" 
                  id="thinking" 
                  name="thinking" 
                  cols="90" 
                  rows="5" 
                  readonly>{{ $three_column->thinking }}</textarea>

        <!-- 感情名必須バリデーション表示-->
        @if($errors->has('thinking'))
        @foreach($errors->get('thinking') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <div class="form-group">
        <label for="basis_thinking"><h5>④　自分の考えの根拠</h5></label>
        <p class="alert alert-success" role="alert">ポイント：客観的であるとベスト。<br>人から尋ねられた時に「だって」と説明するように</p>
        <textarea class="form-control" 
                  id="basis_thinking" 
                  name="basis_thinking" 
                  cols="90" 
                  rows="5"></textarea>

        @if($errors->has('basis_thinking'))
        @foreach($errors->get('basis_thinking') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <div class="form-group">
        <label for="opposite_fact"><h5>⑤　逆の事実</h5></label>
        <p class="alert alert-success" role="alert">ポイント：「でも」そう考えなくても良いのでは？</p>
        <textarea class="form-control" 
                  id="opposite_fact" 
                  name="opposite_fact" 
                  cols="90" 
                  rows="5"></textarea>

        @if($errors->has('opposite_fact'))
        @foreach($errors->get('opposite_fact') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <div class="form-group">
        <label for="new_thinking"><h5>⑥　新しい考え方</h5></label>
        <p class="alert alert-success" role="alert">ポイント：④と考えられるけど、⑤とも考えられる</p>
        <textarea class="form-control" 
                  id="new_thinking" 
                  name="new_thinking" 
                  cols="90" 
                  rows="5"></textarea>

        @if($errors->has('new_thinking'))
        @foreach($errors->get('new_thinking') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>

      <div class="form-group">
        <label for="new_emotion"><h5>⑦  新しい感情</h5></label>
        <p class="alert alert-success" role="alert">ポイント：「⑥新しい考え」のように考えると、抱いていた感情の強さはどう変わった？</p>

        <!-- ここから　-->
        <div class="row mt-3">
        <div class="form-group col-3">
          <label for="emotion_name">感情名</label>
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
                     value="{{$three_column->emotion_name02 }}"
              >
            @endif
          </ul>

        </div>

        <div class="form-group col-3">
          <label for="emotion_strength">以前の感情の強さ</label>
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

        <div class="form-group col-3">
          <label for="emotion_strength">新しい感情の強さ</label>
          <input type="number" 
                class="form-control mt-1" 
                id="new_emotion_strength" 
                name="new_emotion_strength" 
          >

          @if(isset($three_column->emotion_strength00))
          <input type="number" 
                class="form-control mt-2" 
                id="new_emotion_strength00" 
                name="new_emotion_strength00"
          >
          @endif

          @if(isset($three_column->emotion_strength01))
          <input type="number" 
                class="form-control mt-2" 
                id="new_emotion_strength01" 
                name="new_emotion_strength01"
          >
          @endif

          @if(isset($three_column->emotion_strength02))
          <input type="number" 
                class="form-control mt-3" 
                id="new_emotion_strength02" 
                name="new_emotion_strength02"    
          >
          @endif
        </div>
      </div>

        @if($errors->has('new_emotion'))
        @foreach($errors->get('new_emotion') as $message)
        <ul>
          <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
      </div>
  
      <input type="submit" class="btn btn-primary btn-lg" value="3コラムから7コラムへ">

      <div class="buttons">
        <button type="button" class="btn btn-secondary btn-lg" onclick="history.back(-1)">戻る</button>
      </div>

    </form>
    
  </div>
</div>
@endsection