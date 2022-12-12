@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">{{ __('solution.DetailPage')}} (id = {{ $trouble->id }} ) </h3>

    <table class="table table-bordered">
      <tr>
        <th>解決策ID</th>
        <th>{{ __('solution.createDay')}}</th>
        <th>{{ __('solution.updateDay')}}</th>
      </tr>
      <tr>
       <td>{{ $trouble->id }}</td>
       <td>{{ $trouble->created_at }}</td>
       <td>{{ $trouble->updated_at }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('solution.trouble') }}</th>
      </tr>
      <tr>
        <td>{{ $trouble->trouble }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('solution.solution') }}</th>
        <th>{{ __('solution.merit') }}</th>
        <th>{{ __('solution.demerit') }}</th>
      </tr>
      @if(isset($solutions[0]))
      <tr>
        <td>{{ $solutions[0]->solution}}</td>
        <td>{{ $merits[0]->merit }}</td>
        <td>{{ $demerits[0]->demerit }}</td>
      </tr>
      @endif
      @if(isset($solutions[1]))
      <tr>
        <td>{{ $solutions[1]->solution }}</td>
        <td>{{ $merits[1]->merit }}</td>
        <td>{{ $demerits[1]->demerit }}</td>
      </tr>
      @endif
      @if(isset($solutions[2]))
      <tr>
        <td>{{ $solutions[2]->solution }}</td>
        <td>{{ $merits[2]->merit }}</td>
        <td>{{ $demerits[2]->demerit }}</td>
      </tr>
      @endif
      @if(isset($solutions[3]))
      <tr>
        <td>{{ $solutions[3]->solution }}</td>
        <td>{{ $merits[3]->merit }}</td>
        <td>{{ $demerits[3]->demerit }}</td>
      </tr>
      @endif
      @if(isset($solutions[4]))
      <tr>
        <td>{{ $solutions[4]->solution }}</td>
        <td>{{ $merits[4]->merit }}</td>
        <td>{{ $demerits[4]->demerit }}</td>
      </tr>
      @endif
    </table>
    
    <div class="buttons-first">
      <form action="{{ route('solution.edit', ['param' => $trouble->id]) }}" method="get">
        @csrf
        <button type="submit" class="btn btn-secondary btn-lg">{{ __('solution.edit')}}</button>
      </form>
    </div>

    <div class="buttons">
      <form action="{{ route('solution.destroy', ['param' => $trouble->id] ) }}" method="post">
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