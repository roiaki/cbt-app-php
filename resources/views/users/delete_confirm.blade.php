@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card border-dark mb-3">
    <div class="card-header">
      <h3>退会の確認</h3>
    </div>
    <div class="card-body">
      <p class="card-text">退会をすると作成したデータも全て削除されます。</p>
      <p class="card-text">それでも退会をしますか？</p>
    </div>
  </div>


  @if(Auth::check())

  <div class="btn-group">
    {!! Form::open(['route' => ['user.delete'], 'method' => 'delete']) !!}
        {!! Form::submit('退会する', ['class' => 'btn btn-danger btn-m']) !!}
    {!! Form::close() !!}

    <div class="ml-3">
      <a href="/events" class="btn btn-primary">キャンセルする</a>
    </div>
  </div>
  @endif
</div>
@endsection