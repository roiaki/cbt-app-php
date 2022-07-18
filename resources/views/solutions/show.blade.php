@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">{{ __('solution.DetailPage')}} (id = {{ $solution->id }} ) </h3>

    <table class="table table-bordered">
      <tr>
        <th>解決策ID</th>
        <th>{{ __('solution.createDay')}}</th>
        <th>{{ __('solution.updateDay')}}</th>
      </tr>
      <tr>
       <td>{{ $solution->id }}</td>
       <td>{{ $solution->created_at }}</td>
       <td>{{ $solution->updated_at }}</td>
      </tr>

    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('solution.trouble') }}</th>
      </tr>
      <tr>
        <td>{{ $solution->trouble }}</td>
      </tr>
      </table>

      <table class="table table-bordered">
      <tr>
        <th>{{ __('solution.solution') }}</th>
        <th>{{ __('solution.merit') }}</th>
        <th>{{ __('solution.demerit') }}</th>
      </tr>
      <tr>
        <td>{{ $solution->solution00 }}</td>
        <td>{{ $solution->merit00 }}</td>
        <td>{{ $solution->demerit00 }}</td>
      </tr>
      @if(isset($solution->solution01))
      <tr>
        <td>{{ $solution->solution01 }}</td>
        <td>{{ $solution->merit01 }}</td>
        <td>{{ $solution->demerit01 }}</td>
      </tr>
      @endif
      @if(isset($solution->solution02))
      <tr>
        <td>{{ $solution->solution02 }}</td>
        <td>{{ $solution->merit02 }}</td>
        <td>{{ $solution->demerit02 }}</td>
      </tr>
      @endif
      @if(isset($solution->solution03))
      <tr>
        <td>{{ $solution->solution03 }}</td>
        <td>{{ $solution->merit03 }}</td>
        <td>{{ $solution->demerit03 }}</td>
      </tr>
      @endif
      @if(isset($solution->solution04))
      <tr>
        <td>{{ $solution->solution04 }}</td>
        <td>{{ $solution->merit04 }}</td>
        <td>{{ $solution->demerit04 }}</td>
      </tr>
      @endif
    </table>
    
    <div class="buttons-first">
      <form action="{{ route('solutions.edit', ['param' => $solution->id]) }}" method="get">
        @csrf
        <button type="submit" class="btn btn-secondary btn-lg">{{ __('solution.edit')}}</button>
      </form>
    </div>

    <div class="buttons">
      <form action="{{ route('solution.destroy', ['param' => $solution->id] ) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirmDelete();">{{ __('event.delete') }}</button>
      </form>
    </div>

    <div class="buttons">
      <button class="btn btn-primary btn-lg" onclick="history.back(-1)">{{ __('event.back') }}</button>
    </div>
    
  </div>
</div>
@endsection