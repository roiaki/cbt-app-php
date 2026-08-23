<?php 
  $locale = App::currentLocale();
  $json_array = json_encode($locale);
?>
@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  
  <div class="col-sm-9">
    <h3 class="title_head">パスワードの編集</h3>
      <div class="container">
        <div class="row">
          <form action="{{ route('user.passwordUpdate') }}"
            method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="userId" value="{{ $user->id }}">
            <table class="table">
              <tr>
                <th class="col-3 profile">現在のパスワード</th>
                <td class="col-7">
                  <input
                    type="password"
                    id="current_password"
                    class="form-control @error('current_password') is-invalid @enderror"
                    name="current_password">

                  @error('current_password')
                    <div class="alert alert-danger mt-3" role="alert">
                      <ul>
                        <li class="text-danger">{{ $message }}</li>
                      </ul>
                    </div>
                  @enderror
                </td>
              </tr>
              
              <tr>
                <th class="col-3 profile">新しいパスワード</th>
                <td class="col-7">
                  <input 
                    type="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"> 

                  @error('password')
                    <div class="alert alert-danger mt-3" role="alert">
                      <ul>
                        <li class="text-danger">{{ $message }}</li>
                      </ul>
                    </div>
                  @enderror
                </td>
              </tr>
           
              <tr>
                <th>新しいパスワードをもう一度</th>
                <td>
                  <input 
                    type="password"
                    id="password_confirmation"
                    class="form-control"
                    name="password_confirmation">
                </td>
              </tr>
              
            </table>
            
            <button type="submit" class="btn btn-primary mt-3 mb-3">保存</button>
					</form>
        </div>
      </div>
  </div>

@endsection
