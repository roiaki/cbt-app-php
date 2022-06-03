@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-sm-7">

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

    @if ( isset($events) )
      @if ( count($events) > 0 )
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="table-primary">
            <th>{{ __('event.title') }}</th>
            <th>{{ __('event.contents') }}</th>
            <th>{{ __('event.updated_day') }}</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($events as $event)
          <tr>
            <td>{{ $event->title }}</td>
            <td>
              @if (mb_strlen($event->content) > 25)
              {{ $content = mb_substr($event->content, 0, 25 ) . "....."; }}
              @else
              {{ $event->content}}
              @endif
            </td>
            <td>{{ date( 'Y/m/d H:i', strtotime($event->updated_at) ) }}
              <p><a href="{{ route('events.show', $event->id) }}">{{ __('event.detail') }}</a></p>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    @endif

    {!! link_to_route('events.create', __('event.create_new'), [], ['class' => 'btn btn-primary btn-lg']) !!}

    <div class="d-flex justify-content-center pages">
      @if ( isset($events) )
      {{ $events->appends(request()->input())->links('pagination::bootstrap-4') }}
      @endif
    </div>
  </div>
</div>
@endsection