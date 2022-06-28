@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">   
    <h3 class="title_head">{{ __('solution.create_title') }}</h3>
      <form action="{{ route('events.store') }}" method="post">
        @csrf
    
        <table>
        <!-- タイトル -->
        <div class="form-group">
          <tr>  
          <th><label for="content"><h5>困っている事</h5></label></th>
          <td><input type="text" class="form-control" id="trouble" name="trouble" value = "{{ old('trouble') }}" required></td>
          </tr>
        </div>
        <!-- /タイトル-->

        <!-- タイトル -->
        <tr>
        <div class="form-group">
          <th><label for="content"><h5>解決策</h5></label></th>
          <td><input type="text" class="form-control" id="solution" name="solution" value = "{{ old('solution') }}" required></td>
        </div>
        </tr>
        <!-- /タイトル-->
        
        <!-- タイトル -->
        <tr>
        <div class="form-group">
          <th><label for="content"><h5>長所</h5></label></th>
          <td><input type="text" class="form-control" id="merit" name="merit" value = "{{ old('merit') }}" required></td>
        <!-- /タイトル-->
        </div>
        </tr>
        <tr>
        <!-- タイトル -->
        <div class="form-group">
          <th><label for="content"><h5>短所</h5></label></th>
          <td><input type="text" class="form-control" id="demerit" name="demerit" value = "{{ old('demerit') }}" required></td>
        </div>
        </tr>
        <!-- /タイトル-->
        </table>
        <!-- バリデーションエラー表示 -->
        @if($errors->has('title'))
        @foreach($errors->get('title') as $message)
        <ul>
            <li class="ml-2 my-1 text-danger">{{ $message }}</li>
        </ul>
        @endforeach
        @endif
    

        <input type="submit" value="作成" class="btn btn-primary btn-lg"> 
        
        <div class="buttons">
          <button type="button" class="btn btn-secondary btn-lg" onclick="history.back(-1)">{{ __('event.back')}}</button>
        </div>
        
      </form>

  </div>
</div>

@endsection