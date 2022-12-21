@extends('layouts.app')

@section('title', '解決策編集')

@section('content')

<div class="glasscard row justify-content-center">
  <div class="col-sm-7">   
    <h3 class="title_head">{{ __('solution.editPage') }}</h3>
    <form 
      action="{{ route('solution.update', ['param' => $trouble->id] ) }}" 
      method="POST"
    >
      @csrf
      @method('PUT')
        
        <!-- 問題 -->
        <div class="form-group">
          <tr>  
            <th><label for="content"><h5>{{ __('solution.trouble') }}</h5></label></th>
            <td>
              <input 
                type="text" 
                class="form-control" 
                id="trouble" 
                name="trouble" 
                value = "{{ $trouble->trouble }}" 
                required
              >
            </td>
          </tr>
        </div>
        <!-- /問題-->

        <!-- 解決策長所短所 -->
        <div class="row">
          <div class="col-4">
          
            <label for="emotion_name"><h5>{{ __('solution.solution') }}</h5></label>
              <p class="alert alert-success" role="alert">
                
              </p>
          </div>
          <div class="col-4">
            <label for="emotion_name"><h5>{{ __('solution.merit') }}</h5></label>
              <p class="alert alert-success" role="alert">
                
              </p>
          </div>
          <div class="col-4">
            <label for="emotion_name"><h5>{{ __('solution.demerit') }}</h5></label>
              <p class="alert alert-success" role="alert">
                
              </p>
          </div>
        </div>

        <div class="row">
          <div class="col-4">
            <textarea 
              name="solution00"
              class="form-control"
              type="text">{{ $solutions[0]->solution }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea 
              name="merit00"
              class="form-control"
              type="text">{{ $merits[0]->merit }}</textarea>
          </div>

          <div class="col-4">
            <textarea 
              name="demerit00"
              class="form-control"
              type="text">{{ $demerits[0]->demerit }}</textarea>
          </div>

        </div>

        @if(isset($solutions[1]->solution))
        <div class="row">
          <div class="col-4">
            <textarea 
              name="solution01"
              class="form-control"
              type="text">{{ $solutions[1]->solution }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea 
              name="merit01"
              class="form-control"
              type="text">{{ $merits[1]->merit }}</textarea>
          </div>

          <div class="col-4">
            <textarea 
              name="demerit01"
              class="form-control"
              type="text">{{ $demerits[1]->demerit }}</textarea>
          </div>
        </div>
        @endif

        @if(isset($solutions[2]->solution))
        <div class="row">
          <div class="col-4">
            <textarea 
              name="solution02"
              class="form-control"
              type="text">{{ $solutions[2]->solution }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea 
              name="merit02"
              class="form-control"
              type="text">{{ $merits[2]->merit }}</textarea>
          </div>

          <div class="col-4">
            <textarea 
              name="demerit02"
              class="form-control"
              type="text">{{ $demerits[2]->demerit }}</textarea>
          </div>
        </div>
        @endif

        @if(isset($solutions[3]->solution))
        <div class="row">
          <div class="col-4">
            <textarea 
              name="solution03"
              class="form-control"
              type="text">{{ $solutions[3]->solution }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea 
              name="merit03"
              class="form-control"
              type="text">{{ $merits[3]->merit }}</textarea>
          </div>

          <div class="col-4">
            <textarea 
              name="demerit03"
              class="form-control"
              type="text">{{ $demerits[3]->demerit }}</textarea>
          </div>
        </div>
        @endif

        @if(isset($solutions[4]->solution))
        <div class="row">
          <div class="col-4">
            <textarea 
              name="solution04"
              class="form-control"
              type="text">{{ $solutions[4]->solution }}</textarea>
          </div>
    
          <div class="col-4">
            <textarea 
              name="merit04"
              class="form-control"
              type="text">{{ $merits[4]->merit }}</textarea>
          </div>

          <div class="col-4">
            <textarea 
              name="demerit04"
              class="form-control"
              type="text">{{ $demerits[4]->demerit }}</textarea>
          </div>
        </div>
        @endif

        <input 
          type="submit" 
          value="{{ __('solution.update') }}" 
          class="btn btn-primary btn-lg mt-5"
        > 
        
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