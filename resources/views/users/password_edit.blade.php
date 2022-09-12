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
            <table class="table">
<!--             
              <th>以前のパスワード</th>
              <td>
                <input 
                  type="password"
                  id="oldpassword"
                  class="form-control"
                  name="oldpassword">
              </td> -->
              
              <tr>
                <th class="col-3 profile">新しいパスワード</th>
                <td class="col-7">
                  <input 
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"> 
                </td>
              </tr>
           
              <!-- <tr>
                <th>新しいパスワードをもう一度</th>
                <td>
                  <input 
                    type="password"
                    id="confirmPassword"
                    class="form-control"
                    name="confirmPassword">
                </td>
              </tr> -->
              
            </table>
            
            <button type="submit" class="btn btn-primary mt-3">保存</button>
					</form>
        </div>
      </div>
  </div>

@endsection

