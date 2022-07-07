@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">   
    <h3 class="title_head">{{ __('solution.create_title') }}</h3>
      <form action="{{ route('events.store') }}" method="post">
        @csrf
        <!-- 問題 -->
        <div class="form-group">
          <tr>  
            <th><label for="content"><h5>困っている事</h5></label></th>
            <td>
              <input type="text" 
                     class="form-control" 
                     id="trouble" 
                     name="trouble" 
                     value = "{{ old('trouble') }}" 
                     required>
            </td>
          </tr>
        </div>
        <!-- /問題-->
        <table class="table table-bordered table-hover">
        <!-- 解決策 -->
        <div class="form-group">
          <tr>
            <th><label for="content"><h5>解決策</h5></label></th>
            <td>
              <input type="text"
                     class="form-control"
                     id="solution"
                     name="solution"
                     value = "{{ old('solution') }}"
                     required>
            </td>
          </tr>
        </div>
        <!-- /解決策 -->
        
        <!-- 長所 -->
        <div class="form-group">
          <tr>
            <th><label for="content"><h5>長所</h5></label></th>
            <td>
              <input type="text" 
                     class="form-control" 
                     id="merit" 
                     name="merit" 
                     value = "{{ old('merit') }}" 
                     required>
            </td>
          </tr>
        </div>
        <!-- /長所-->
        
        <!-- 短所 -->
        <div class="form-group">
          <tr>
            <th><label for="content"><h5>短所</h5></label></th>
            <td>
              <input type="text" 
                     class="form-control" 
                     id="demerit" 
                     name="demerit" 
                     value = "{{ old('demerit') }}" 
                     required>
            </td>
          </tr>
        </div>
        <!-- /短所 -->

        </table>
        <div id="app">
        <p>ここ</p>

        <p>@{{ message }}</p>
        
        </div>

        <!--<div id="app01">  -->
        <!-- 入力ボックスを表示する場所 -->
        <!--
        <div v-for="(text,index) in texts">
-->
            <!-- 各入力ボックス -->
            <!--
            <div class="row mt-3">
              <div class="form-group col">
                <input ref="texts"
                       name="emotion_name[]"
                       class="form-control"
                       type="text"
                       v-model="texts[index]"
                       @keypress.shift.enter="addInput">
              </div>
              <div class="form-group col">
                <input ref="strength"
                       name="emotion_strength[]"
                       class="form-control"
                       type="text"
                       v-model="strength[index]"
                       @keypress.shift.enter="addInput">
              </div>
              <div class="form-group col">
                <input ref="strength"
                       name="emotion_strength[]"
                       class="form-control"
                       type="text"
                       v-model="strength[index]"
                       @keypress.shift.enter="addInput">
              </div>

              <div class="btn-group ml-auto">
                    <button type="button" 
                        class="btn btn-outline-danger mr-auto" 
                        v-if="remainingTextCount < 3"
                        @click="removeInput(index)">×</button>
              </div>
            </div>   
        </div>
-->
        <!-- 入力ボックスを追加するボタン -->
        <!--
        <div class="btn-toolbar">
          <div class="btn-group">
            <button class="btn btn-info" type="button" @click="addInput" v-if="!isTextMax">
                ＋
                <span v-text="remainingTextCount"></span>
            </button>
          </div>

          </div>
        </div>
-->
        <!-- バリデーションエラー表示 -->
        @if($errors->has('title'))
            @foreach($errors->get('title') as $message)
            <ul>
                <li class="ml-2 my-1 text-danger">{{ $message }}</li>
            </ul>
            @endforeach
        @endif
        <!-- /バリデーションエラー表示 -->

        <input type="submit" value="作成" class="btn btn-primary btn-lg"> 
        
        <div class="buttons">
          <button type="button" class="btn btn-secondary btn-lg" onclick="history.back(-1)">{{ __('event.back')}}</button>
        </div>
        
      </form>

  </div>
</div>

@endsection