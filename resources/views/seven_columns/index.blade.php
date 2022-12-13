@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-8 mb-5">
    <h3 class="title_head">{{ __('sevencolumn.pageTitle') }}</h3>
    
    <!--↓↓ 検索フォーム ↓↓-->
    <div class="row">
      <div class="col-sm-3 serch">
        <form class="form-inline" action="{{ route('seven_columns.serch') }}" method="get">
        @csrf
          <div class="form-group">
            <input 
              type="text" 
              name="keyword" 
              value="@if ( !empty($keyword) ){{ $keyword }}@endif"
              class="form-control" placeholder="{{ __('sevencolumn.search_word') }}">
                   
            <input type="submit" value="{{ __('sevencolumn.search') }}" class="btn btn-info">
          </div>          
        </form>
      </div>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->
    
    <!-- 7コラム一覧カード -->
    @foreach($seven_columns as $sevencolumn)
      <div class="d-flex justify-content-center">
        <div class="event_page_card col-12">
          <div class="card-body d-flex flex-row">
            <a href="" class="text-dark">
              <i class="fas fa-user-circle fa-3x mr-1"></i>
              
            </a>
            <div>
              <div class="font-weight-bold">
                {{ $sevencolumn->user->name }}
              </div>
              <div class="font-weight-lighter">{{ date( 'Y n/j H:i', strtotime($sevencolumn->updated_at) ) }}</div>
            </div>

      
            @if( Auth::id() === $sevencolumn->user_id )
              <!-- dropdown -->
              <div class="ml-auto card-text">
                <div class="dropdown">
                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-edit"></i>
                  </a>
                  
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('seven_columns.edit', ['param' => $sevencolumn->id]) }}">
                      <i class="fas fa-pen mr-1"></i>7コラムを更新する
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" 
                       data-toggle="modal" 
                       data-target="#modal-delete-{{ $sevencolumn->id }}">
                      <i class="fas fa-trash-alt mr-1"></i>7コラムを削除する
                    </a>
                  </div>
                </div>
              </div>
              <!-- dropdown -->

              <!-- modal ok-->
              <div id="modal-delete-{{ $sevencolumn->id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="{{ route('seven_columns.destroy', ['param' => $sevencolumn->id]) }}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        {{ $sevencolumn->updated_at }} <br><br>
                        {{ $sevencolumn->basis_thinking }} を削除します。よろしいですか？
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
          <a class="text-dark" href="{{ route('seven_columns.show', $sevencolumn->id) }}">
            <div class="card-body pt-0">
              <h3 class="h4 card-title">
                  
              </h3>
              <div class="card-text">
                @if (mb_strlen($sevencolumn->basis_thinking) > 50)
                  {{ $content = mb_substr($sevencolumn->basis_thinking, 0, 50 ) . "..."; }}
                @else
                {{ $sevencolumn->basis_thinking }}
                @endif
              </div>
            </div>
          </a>
        </div>
      </div>
    @endforeach
    <!-- 7コラム一覧カード -->
     
  </div>
</div>

@endsection