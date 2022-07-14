@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">   
    <h3 class="title_head">{{ __('solution.create_title') }}</h3>
      <form action="{{ route('solutions.store') }}" method="post">
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

        <!-- 解決策長所短所 -->
        <div class="row">
          <div class="col-4">
            <label for="emotion_name"><h5>解決策</h5></label>
              <p class="alert alert-success" role="alert">
                解決策
              </p>
          </div>
          <div class="col-4">
            <label for="emotion_name"><h5>長所</h5></label>
              <p class="alert alert-success" role="alert">
                長所
              </p>
          </div>
          <div class="col-4">
            <label for="emotion_name"><h5>短所</h5></label>
              <p class="alert alert-success" role="alert">
                短所
              </p>
          </div>
        </div>
        <div id="app"> 
          <addsolution></addsolution>
        </div>
        <!-- /解決策長所短所 -->

        <!-- バリデーションエラー表示 -->
        @if($errors->has('title'))
            @foreach($errors->get('title') as $message)
            <ul>
                <li class="ml-2 my-1 text-danger">{{ $message }}</li>
            </ul>
            @endforeach
        @endif
        <!-- /バリデーションエラー表示 -->

        <input type="submit" value="作成" class="btn btn-primary btn-lg mt-5"> 
        
        <div class="buttons">
          <button type="button" class="btn btn-secondary btn-lg mt-5" onclick="history.back(-1)">{{ __('event.back')}}</button>
        </div>
        
      </form>

  </div>
</div>

@endsection