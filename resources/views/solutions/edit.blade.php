@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">   
    <h3 class="title_head">解決策更新</h3>
    <form action="{{ route('solution.update', ['param' => $solution->id] ) }}" method="POST">
      @csrf
      @method('PUT')
        
        <!-- 問題 -->
        <div class="form-group">
          <tr>  
            <th><label for="content"><h5>困っている事</h5></label></th>
            <td>
              <input type="text" 
                     class="form-control" 
                     id="trouble" 
                     name="trouble" 
                     value = "{{ $solution->trouble }}" 
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

        <div class="row">
          <div class="col-4">
            <textarea name="solution00"
                      class="form-control"
                      type="text">{{ $solution->solution00 }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea name="merit00"
                      class="form-control"
                      type="text">{{ $solution->merit00 }}</textarea>
          </div>

          <div class="col-4">
            <textarea name="demerit00"
                      class="form-control"
                      type="text">{{ $solution->demerit00 }}</textarea>
          </div>

        </div>

        @if(isset($solution->solution01))
        <div class="row">
          <div class="col-4">
            <textarea name="solution01"
                      class="form-control"
                      type="text">{{ $solution->solution01 }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea name="merit01"
                      class="form-control"
                      type="text">{{ $solution->merit01 }}</textarea>
          </div>

          <div class="col-4">
            <textarea name="demerit01"
                      class="form-control"
                      type="text">{{ $solution->demerit01 }}</textarea>
          </div>
        </div>
        @endif

        @if(isset($solution->solution02))
        <div class="row">
          <div class="col-4">
            <textarea name="solution02"
                      class="form-control"
                      type="text">{{ $solution->solution02 }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea name="merit02"
                      class="form-control"
                      type="text">{{ $solution->merit02 }}</textarea>
          </div>

          <div class="col-4">
            <textarea name="demerit02"
                      class="form-control"
                      type="text">{{ $solution->demerit02 }}</textarea>
          </div>
        </div>
        @endif

        @if(isset($solution->solution03))
        <div class="row">
          <div class="col-4">
            <textarea name="solution03"
                      class="form-control"
                      type="text">{{ $solution->solution03 }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea name="merit03"
                      class="form-control"
                      type="text">{{ $solution->merit03 }}</textarea>
          </div>

          <div class="col-4">
            <textarea name="demerit03"
                      class="form-control"
                      type="text">{{ $solution->demerit03 }}</textarea>
          </div>
        </div>
        @endif

        @if(isset($solution->solution04))
        <div class="row">
          <div class="col-4">
            <textarea name="solution04"
                      class="form-control"
                      type="text">{{ $solution->solution04 }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea name="merit04"
                      class="form-control"
                      type="text">{{ $solution->merit04 }}</textarea>
          </div>

          <div class="col-4">
            <textarea name="demerit04"
                      class="form-control"
                      type="text">{{ $solution->demerit04 }}</textarea>
          </div>
        </div>
        @endif

        <input type="submit" value="作成" class="btn btn-primary btn-lg mt-5"> 
        
        <div class="buttons">
          <button type="button" class="btn btn-secondary btn-lg mt-5" onclick="history.back(-1)">{{ __('event.back')}}</button>
        </div>
        
      </form>

  </div>
</div>

@endsection