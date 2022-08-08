@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">{{ __('sevencolumn.pageTitle') }}</h3>
    
    <!--↓↓ 検索フォーム ↓↓-->
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
    <!--↑↑ 検索フォーム ↑↑-->
    
    @if ( isset($seven_columns) )
      @if ( count($seven_columns) > 0 )
      <table class="table table-bordered table-hover">
        <thread>
          <tr class="table-info">
            <th>{{ __('sevencolumn.basis_thinking') }}</th>
            <th>{{ __('sevencolumn.opposite_fact') }}</th>
            <th>{{ __('sevencolumn.updated_day') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($seven_columns as $seven_column)
          <tr>
            <td>
              @if(mb_strlen($seven_column->basis_thinking) > 25)
                {{ $short_basis_thinking = mb_substr($seven_column->basis_thinking, 0, 25 ) . "..."; }}
              @else
                {{ $seven_column->basis_thinking }}
              @endif
            <td>  
              @if (mb_strlen($seven_column->opposite_fact) > 25)
                {{ $short_content = mb_substr($seven_column->opposite_fact, 0, 25 ) . "..."; }}
              @else
                {{ $seven_column->opposite_fact }}
              @endif
            </td>
            <td>{{ date( 'Y/n/j H:i', strtotime($seven_column->updated_at) ) }}
              <p><a href="{{ route('seven_columns.show', $seven_column->id) }}">{{ __('sevencolumn.detail') }}</a></p>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="d-flex justify-content-center">
        {{ $seven_columns->appends(request()->input())->links('pagination::bootstrap-4') }}
      </div>
      @endif
    @endif
  </div>
</div>

@endsection