<?php 
  $locale = App::currentLocale();
  $json_array = json_encode($locale);
?>
@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  
  <div class="col-sm-9">
    <h3 class="title_head">名前の編集</h3>
      <div class="container">
        <div class="row">
          <table class="table">
            <tr>
              <th class="col-3 profile">お名前</th>
              <td class="col-7">
                <form action="{{ route('user.nameupdate') }}"
                      method="POST">
                  @csrf
                  @method('PUT')
                  <input type="name"
                         id="name"
                         class="form-control"
                         name="name"
                         value="{{ $user->name }}">

                  @if($errors->has('name'))
                    @foreach($errors->get('name') as $message)
                      <div class="alert alert-danger mt-3" role="alert">
                        <ul>
                          <li class="text-danger">{{ $message }}</li>
                        </ul>
                      </div>
                    @endforeach
                  @endif

                  <button type="submit" class="btn btn-primary mt-5">保存</button>
                </form>
              </td>
            </tr>
          </table>
          
        </div>
      </div>
  </div>

@endsection

