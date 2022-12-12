@extends('layouts.app')

@section('content')
<div class="glasscard row justify-content-center">
  <div class="col-sm-9 mb-5">
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
    
    <!-- 3コラム一覧画面カード -->
    @foreach($three_columns as $threecolumn)
      <div class="d-flex justify-content-center">
        <div class="event_page_card col-11">
          <div class="card-body d-flex flex-row">
            <a href="" class="text-dark">
              <i class="fas fa-user-circle fa-3x mr-1"></i>
              
            </a>
            <div>
              <div class="font-weight-bold">
                {{ $threecolumn->user->name }}
              </div>
              <div class="font-weight-lighter">{{ date( 'Y n/j H:i', strtotime($threecolumn->updated_at) ) }}</div>
            </div>

      
            @if( Auth::id() === $threecolumn->user_id )
              <!-- dropdown -->
              <div class="ml-auto card-text">
                <div class="dropdown">
                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-edit"></i>
                  </a>
                  
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('three_columns.edit', ['param' => $threecolumn->id]) }}">
                      <i class="fas fa-pen mr-1"></i>3コラムを更新する
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" 
                       data-toggle="modal" 
                       data-target="#modal-delete-{{ $threecolumn->id }}">
                      <i class="fas fa-trash-alt mr-1"></i>3コラムを削除する
                    </a>
                  </div>
                </div>
              </div>
              <!-- dropdown -->

              <!-- modal -->
              <div id="" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="{{ route('three_columns.destroy', ['param' => $threecolumn->id]) }}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        を削除します。よろしいですか？
                      </div>
                      <div class="modal-footer justify-content-between">
                        <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                        <button type="submit" class="btn btn-danger">削除する</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- modal -->
            @endif

          </div>
          <a class="text-dark" href="{{ route('three_columns.show', $threecolumn->id) }}">
            <div class="card-body pt-0">
              <h3 class="h4 card-title">
                  
              </h3>
              <div class="card-text">
                @if (mb_strlen($threecolumn->thinking) > 40)
                  {{ $content = mb_substr($threecolumn->thinking, 0, 40 ) . "..."; }}
                @else
                {{ $threecolumn->thinking }}
                @endif
              </div>
            </div>
          </a>
        </div>
      </div>
    @endforeach
    <!-- 3コラム一覧画面カード -->
    
    <div class="d-flex justify-content-center">
      @if ( isset($three_columns) )
      {{ $three_columns->appends(request()->input())->links('pagination::bootstrap-4') }}
      @endif
    </div>

  </div>
</div>
@endsection