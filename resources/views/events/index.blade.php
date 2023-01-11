@extends('layouts.app')

@section('title', '出来事一覧')

@section('content')

<div class="d-flex justify-content-center">
  <div class="col-sm-8">

    <h3 class="title_head">{{ __('event.event_title') }}</h3>
    <!--↓↓ 検索フォーム ↓↓-->
    <div class="row">
      <div class="col-sm-3 serch">
        <form class="form-inline" action="{{ route('events.serch') }}" method="get">
          @csrf
          <div class="form-group">
            <input type="text" name="keyword" value="@if ( !empty($keyword) ){{ $keyword }}@endif" class="form-control" placeholder="{{ __('event.search_word') }}">

            <input type="submit" value="{{ __('event.search') }}" class="btn btn-info">
          </div>
        </form>
      </div>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->

    <!-- 出来事一覧カード -->
    @foreach($events as $event)
      @if(Auth::id() === $event->user_id)
      <div class="d-flex justify-content-center">
        <div class="event_page_card col-12">
          <div class="card-body d-flex flex-row">
            <a href="" class="text-dark">
              <i class="fas fa-user-circle fa-3x mr-1"></i>
            </a>
            <div>
              <div class="font-weight-bold">
                 <!-- @check event->user->name とすると検索条件によってエラーが出るが原因が分からない　-->
              </div>
              <div class="font-weight-lighter">{{ date( 'Y n/j H:i', strtotime($event->updated_at) ) }}</div>
            </div>

            <!-- dropdown -->
            <div class="ml-auto card-text">
              <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-edit"></i>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{ route('events.edit', ['event' => $event->id]) }}">
                    <i class="fas fa-pen mr-1"></i>出来事を更新する
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" 
                    data-toggle="modal" 
                    data-target="#modal-delete-{{$event->id}}">
                    <i class="fas fa-trash-alt mr-1"></i>出来事を削除する
                  </a>
                </div>
              </div>
            </div>
            <!-- dropdown -->

          </div>

          <a class="text-dark" href="{{ route('events.show', $event->id) }}">
            <div class="card-body pt-0">
              <h3 class="h4 card-title">
                {{ $event->title }}
              </h3>
              <div class="card-text">
                @if (mb_strlen($event->content) > 40)
                  {{ $content = mb_substr($event->content, 0, 40 ) . "..."; }}
                @else
                  {{ $event->content}}
                @endif
              </div>
            </div>
          </a>
        </div>
      </div>

      <!-- modal ok -->
      <div class="modal fade" 
           id="modal-delete-{{ $event->id }}" 
           tabindex="-1" 
           role="dialog">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">削除確認</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="{{ route('events.destroy', ['event' => $event->id] ) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                <p>{{ $event->created_at}}</p>
                <p>{{ $event->title }} </p>
                を削除しますがいいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-info" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      @endif
    @endforeach
    <!-- 出来事カード -->

    {!! link_to_route('events.create', __('event.create_new'), [], ['class' => 'mt-5 btn btn-primary btn-lg']) !!}

    <div class="d-flex justify-content-center pages mb-5">
      @if(isset($events))
      {{ $events->appends(request()->input())->links('pagination::bootstrap-4') }}
      @endif
    </div>
  </div>
</div>

@endsection