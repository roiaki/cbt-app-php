@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">{{ __('threecolumn.three_title') }}</h3>

    <!--↓↓ 検索フォーム ↓↓-->
    <div class="row">
      <div class="col-sm-3 serch">
        <form class="form-inline" action="{{ route('three_columns.serch') }}" method="get">
          @csrf
          <div class="form-group">
            <input type="text" name="keyword" value="@if ( !empty($keyword) ){{ $keyword }}@endif" class="form-control" placeholder="{{ __('threecolumn.search_word') }}">

            <input type="submit" value="{{ __('threecolumn.search') }}" class="btn btn-info">
          </div>
        </form>
      </div>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->
    
    @if ( isset($three_columns) )
      @if (count($three_columns) > 0)
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="table-primary">
            <th>{{ __('threecolumn.threecolId') }}</th>
            <th>{{ __('threecolumn.emotion_name') }}</th>
            <th>{{ __('threecolumn.thinking') }}</th>
            <th>{{ __('threecolumn.updated_day') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($three_columns as $three_column)
          <tr>
            <td>
              <a href="{{ route('three_columns.show', $three_column->id) }}">{{ $three_column->id }}</a>
            </td>
            <td>{{ $three_column->emotion_name }}</td>
            <td>
              @if (mb_strlen($three_column->thinking) > 25)
              {{ $thinking = mb_substr($three_column->thinking, 0, 25 ) . "....."; }}
              @else
              {{ $three_column->thinking }}
              @endif
            </td>
            <td>{{ date( 'Y/m/d H:i', strtotime($three_column->updated_at) ) }}
              <p><a href="{{ route('three_columns.show', $three_column->id) }}">{{ __('threecolumn.detail') }}</a></p>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    @endif

    <div class="d-flex justify-content-center">
      @if ( isset($three_columns) )
      {{ $three_columns->appends(request()->input())->links('pagination::bootstrap-4') }}
      @endif
    </div>

  </div>
</div>
@endsection