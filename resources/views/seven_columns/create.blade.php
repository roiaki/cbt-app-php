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
  <h3 class="title_head">{{ __('sevencolumn.createPageTitle') }}</h3>
    <!-- model 第一引数：Modelのインスタンス、第二引数：連想配列　-->
    <form action="{{ route('seven_columns.store') }}" 
          method="post"
          onsubmit="return sevencolumnValidation(locale);">
      @csrf

      <!-- 隠しデータ -->
      <input type="hidden" name="threecol_id" value="{{ $three_column->id }}">
      <input type="hidden" name="event_id" value="{{ $three_column->event_id }}">
      
      <div class="form-group">
        <label for="title"><h5>{{ __('sevencolumn.1-1_title') }}</h5></label>
        <!-- idはグローバル属性であり、HTML内の全ての要素に適用される。
                 name属性はHTMLの特定の要素（フォーム要素）主にバックエンド
            -->
        <input 
          type="text" 
          class="form-control" 
          id="title" 
          name="title" 
          value="{{ $event->title }}"
          readonly>

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
        <label for="content"><h5>{{ __('sevencolumn.1-2_title') }}</h5></label>
        <textarea 
          class="form-control" 
          id="content" 
          name="content" 
          cols="90" 
          rows="5"
          readonly>{{ $event->content }}</textarea>

        <!-- バリデーションエラーメッセージ-->
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
          cols="90" 
          rows="5" 
          readonly>{{ $three_column->thinking }}</textarea>

        <!-- バリデーションエラーメッセージ-->
        @if($errors->has('thinking'))
          @foreach($errors->get('thinking') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
      </div>

      <!-- 自動思考を裏付ける根拠 -->
      <div class="form-group mt-5">
        <label for="basis_thinking"><h5>{{ __('sevencolumn.4_title') }}</h5></label>
        <p class="alert alert-success" role="alert">
          {{ __('sevencolumn.4_sentence') }}
        </p>
        <textarea 
          class="form-control" 
          id="basis_thinking" 
          name="basis_thinking" 
          cols="90" 
          rows="5">{{ old('basis_thinking') }}</textarea>

        <!-- フロントバリデーションエラーメッセージ -->
        <div class="err-msg-name01 mt-3"></div>

        <!-- バリデーションエラーメッセージ-->
        @if($errors->has('basis_thinking'))
          @foreach($errors->get('basis_thinking') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
      </div>
      <!-- /自動思考を裏付ける根拠 -->

      <!-- 反証 -->
      <div class="form-group mt-5">
        <label for="opposite_fact"><h5>{{ __('sevencolumn.5_title') }}</h5></label>
        <p class="alert alert-success" role="alert">
          {{ __('sevencolumn.5_sentence') }}
        </p>
        <textarea 
          class="form-control" 
          id="opposite_fact" 
          name="opposite_fact" 
          cols="90" 
          rows="5">{{ old('opposite_fact') }}</textarea>

        <!-- フロントバリデーションエラーメッセージ -->
        <div class="err-msg-name02 mt-3"></div>

        <!-- バリデーションエラーメッセージ-->
        @if($errors->has('opposite_fact'))
          @foreach($errors->get('opposite_fact') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
      </div>
      <!-- /反証 -->

      <!-- 適応的思考 -->
      <div class="form-group mt-5">
        <label for="new_thinking"><h5>{{ __('sevencolumn.6_title') }}</h5></label>
        <p class="alert alert-success" role="alert">
        {{ __('sevencolumn.6_sentence') }}
        </p>
        <textarea 
          class="form-control" 
          id="new_thinking" 
          name="new_thinking" 
          cols="90" 
          rows="5">{{ old('new_thinking') }}</textarea>
        
        <!-- フロントバリデーションエラーメッセージ -->
        <div class="err-msg-name03 mt-3"></div>

        <!-- バリデーションエラーメッセージ-->
        @if($errors->has('new_thinking'))
          @foreach($errors->get('new_thinking') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
      </div>
      <!-- /適応的思考 -->

      <!-- 感情の変化-->
      <div class="form-group mt-5">
        <label for="new_emotion"><h5>{{ __('sevencolumn.7_title') }}</h5></label>
        <p class="alert alert-success" role="alert">
        {{ __('sevencolumn.7_sentence') }}
        </p>

        <div class="mt-3">
          <table class="table table-bordered">
            <tr>
              <th>{{ __('sevencolumn.emotion_name') }}</th>
              <th>{{ __('sevencolumn.prev_emotion_strength') }}</th>
              <th>{{ __('sevencolumn.new_emotion_strength') }}</th></tr>
            </tr>

            <tr>
              <td>
                {{ $emotions[0]->emotion_name }}
                <input type="hidden"
                       name="new_emotion_name00"
                       value="{{$emotions[0]->emotion_name }}">
              </td>
              <td>
                {{ $emotions[0]->emotion_strength }}
              </td>
              <td align="center">
                <input 
                  type="number" 
                  class="form-control mt-1" 
                  id="new_emotion_strength" 
                  name="new_emotion_strength00">
              </td>
            </tr>

            @if(isset($emotions[1]->emotion_name))
            <tr>
              <td>       
                @if(isset($emotions[1]->emotion_name))
                  {{ $emotions[1]->emotion_name }}
                  <input 
                    type="hidden"
                    name="new_emotion_name01"
                    value="{{$emotions[1]->emotion_name }}">
                @endif
              </td>
              <td>
                @if(isset($emotions[1]->emotion_strength))
                  {{ $emotions[1]->emotion_strength }}
                @endif
              </td>
              @if(isset($emotions[1]->emotion_strength))
                <td>
                  <input 
                    type="number" 
                    class="form-control mt-2" 
                    id="new_emotion_strength01" 
                    name="new_emotion_strength01">
                </td>
              @endif
            </tr>
            @endif

            @if(isset($emotions[2]->emotion_name))
            <tr>
              @if(isset($emotions[2]->emotion_name))
                <td>       
                  {{ $emotions[2]->emotion_name }}
                  <input 
                    type="hidden"
                    name="new_emotion_name02"
                    value="{{$emotions[2]->emotion_name }}">
                </td>
              @endif

              @if(isset($emotions[2]->emotion_strength))
                <td>
                  {{ $emotions[2]->emotion_strength }}
                  
                </td>
              @endif

              @if(isset($emotions[2]->emotion_strength))
                <td>
                  <input 
                    type="number" 
                    class="form-control mt-2" 
                    id="new_emotion_strength02" 
                    name="new_emotion_strength02">
                </td>
              @endif
            </tr>
            @endif
            
          </table>

          <!-- フロントバリデーションエラーメッセージ -->
          <div class="err-msg-name04 mt-3"></div>

          <!-- バリデーションエラーメッセージ-->
          @if($errors->has('new_emotion_strength'))
            @foreach($errors->get('new_emotion_strength') as $message)
            <ul>
              <li class="ml-2 my-1 text-danger">{{ $message }}</li>
            </ul>
            @endforeach
          @endif
       
        </div>
        <!-- /感情の変化-->

        <input 
          type="submit" 
          class="btn btn-primary btn-lg" 
          value="{{ __('sevencolumn.button_create') }}">

        <div class="buttons">
          <button type="button" class="btn btn-secondary btn-lg" onclick="history.back(-1)">{{ __('sevencolumn.button_back') }}</button>
        </div>

    </form>
    
  </div>
</div>
@endsection