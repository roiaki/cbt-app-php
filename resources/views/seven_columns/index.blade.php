@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">7コラム一覧</h3>
    
    <!--↓↓ 検索フォーム ↓↓-->
    <div class="row">
      <div class="col-sm-3 serch">
        <form class="form-inline" action="{{ route('seven_columns.serch') }}" method="get">
        @csrf
          <div class="form-group">
            <input type="text" 
                   name="keyword" 
                   value="@if ( !empty($keyword) ){{ $keyword }}@endif"
                   class="form-control" placeholder="検索キーワード">
                   
            <input type="submit" value="検索" class="btn btn-info">
          </div>          
        </form>
      </div>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->
    
    @if ( isset($seven_columns) )
      @if ( count($seven_columns) > 0 )
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="table-primary">
            <th>id</th>
            <th>タイトル</th>
            <th>内容</th>
            <th>更新日</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($seven_columns as $seven_column)
          <tr>
            <td>{{ $seven_column->id }}</td>
            <td>{{ $seven_column->basis_thinking }}</td>
            
            <td>  
              @if (mb_strlen($seven_column->opposite_fact) > 25)
                {{ $short_content = mb_substr($seven_column->opposite_fact, 0, 25 ) . "....."; }}
              @else
                {{ $seven_column->opposite_fact }}
              @endif
            </td>

            <td>{{ date( 'Y/m/d H:i', strtotime($seven_column->updated_at) ) }}
              <p><a href="{{ route('seven_columns.show', $seven_column->id) }}">詳細</a></p>
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