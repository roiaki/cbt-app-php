@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">{{ __('solution.pageTitle') }}</h3>
    
    <!-- 検索フォーム -->
    <div class="row">
      <div class="col-sm-3 serch">
        <form class="form-inline" action="{{ route('seven_columns.serch') }}" method="get">
        @csrf
          <div class="form-group">
            <input type="text" 
                   name="keyword" 
                   value="@if ( !empty($keyword) ){{ $keyword }}@endif"
                   class="form-control" placeholder="{{ __('sevencolumn.search_word') }}">
                   
            <input type="submit" value="{{ __('sevencolumn.search') }}" class="btn btn-info">
          </div>          
        </form>
      </div>
    </div>
    <!-- /検索フォーム -->
    
    @if ( isset($solutions) )
      @if ( count($solutions) > 0 )
      <table class="table table-bordered table-hover">
        <thread>
          <tr class="table-info">
            <th>{{ __('solution.trouble') }}</th>
            <th>{{ __('solution.merit') }}</th>
            <th>{{ __('solution.updated') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($solutions as $solution)
          <tr>
            <td>  
              {{ $solution->trouble }}
            </td>
            <td>
              {{ $solution->merit00 }}
            </td>
            <td>
              {{ date( 'Y/n/j H:i', strtotime($solution->updated_at) ) }}
              <p><a href="{{ route('solutions.show', $solution->id) }}">{{ __('event.detail') }}</a></p>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="d-flex justify-content-center">
        {{ $solutions->appends(request()->input())->links('pagination::bootstrap-4') }}
      </div>
      @endif
    @endif
    {!! link_to_route('solution.create', __('event.create_new'), [], ['class' => 'btn btn-primary btn-lg']) !!}
  </div>
</div>

@endsection