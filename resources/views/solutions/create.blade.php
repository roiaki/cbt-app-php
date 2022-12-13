@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  <div class="col-sm-7">   
    <h3 class="title_head">{{ __('solution.create_title') }}</h3>
      <form action="{{ route('solutions.store') }}" method="post">
        @csrf
        <!-- 問題 -->
        <div class="form-group">
            
            <label for="content"><h5>困っている事</h5></label>
            <p class="alert alert-success" role="alert">
              自分が現在何ができなくて困っているかをはっきりさせます。
              漠然と主観的に記入するのではなく感情を分けて客観的かつ具体的に記入しましょう。
            </p>
            <textarea 
              type="text" 
              class="form-control" 
              id="trouble" 
              name="trouble" 
              value = "{{ old('trouble') }}" 
              required></textarea>
        </div>
        <!-- /問題-->

        <!-- 解決策 長所 短所 -->
        <div class="row">
          <div class="col-12">
            <p class="alert alert-success" role="alert">
           「こんな事は無理だ」と思うような事があっても決めつけずにできるだけ多くの案を出してみましょう。
            この点は良いかもしれないというポイント。自分にとってどうか。周囲の人にとってはどうか。長期的にはどうか。短期的にはどうか。
            </p>
          </div>
          <div class="col-4">
            <label for="emotion_name"><h5>解決策</h5></label>
              
          </div>
          <div class="col-4">
            <label for="emotion_name"><h5>長所</h5></label>
              
          </div>
          <div class="col-4">
            <label for="emotion_name"><h5>短所</h5></label>
              
          </div>
        </div>
        <div id="app"> 
          <addsolution></addsolution>
        </div>
        <!-- /解決策 長所 短所 -->

        <!-- バリデーションエラー表示 -->
        @if($errors->has('solution.*'))
          @foreach($errors->get('solution') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif

        @if($errors->has('merit.*'))
          @foreach($errors->get('merit') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif

        @if($errors->has('demerit.*'))
          @foreach($errors->get('demerit') as $message)
          <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
          </ul>
          @endforeach
        @endif
        <!-- /バリデーションエラー表示 -->

        <input type="submit" value="作成" class="btn btn-primary btn-lg mt-5"> 
        
        <div class="buttons">
          <button 
            type="button" 
            class="btn btn-secondary btn-lg mt-5" 
            onclick="history.back(-1)">{{ __('event.back')}}
          </button>
        </div>
        
      </form>

  </div>
</div>

@endsection