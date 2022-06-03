@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">{{ __('event.event_detail_head') }} (id = {{ $event->id }} ) </h3>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('event.event_id') }}</th>
        <th>{{ __('event.created_day') }}</th>
        <th>{{ __('event.updated_day') }}</th>
      </tr>
      <tr>
        <td>{{ $event->id }}</td>
        <td>{{ date( 'Y/m/d H:i', strtotime($event->created_at) ) }}</td>
        <td>{{ date( 'Y/m/d H:i', strtotime($event->updated_at) ) }}</td>
      </tr>

    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('event.title') }}</th>
      </tr>
      <tr>
        <td>{{ $event->title }}</td>      
      </tr>
      </table>
      <table class="table table-bordered">
      <tr>
        <th>{{ __('event.content') }}</th>
      </tr>
      <tr>
        <td>{{ $event->content }}</td>
      </tr>
    </table>

    <div class="buttons-first">
      <form action="{{ route('three_columns.create', ['id' => $event->id]) }}" method="get">
        @csrf
        <button type="submit" class="btn btn-success btn-lg">{{ __('event.create_threecolumn_button') }}</button>
      </form>
    </div>

    <div class="buttons">
      <form action="{{ route('events.edit', ['event' => $event->id] ) }}" method="get">
        @csrf
        <button type="submit" class="btn btn-secondary btn-lg">{{ __('event.edit') }}</button>
      </form>
    </div>

    <div class="buttons">
      <form action="{{ route('events.destroy', ['event' => $event->id] ) }}" , method="post">
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