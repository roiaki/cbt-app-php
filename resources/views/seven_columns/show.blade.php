@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
<div class="glasscard row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">{{ __('sevencolumn.sevenShowPageTitle') }} ( id = {{ $seven_column->id }} )</h3>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('sevencolumn.created_day') }}</th>
        <th>{{ __('sevencolumn.updated_day') }}</th>
        <th>{{ __('sevencolumn.id') }}</th>
        <th>{{ __('sevencolumn.eventId') }}</th>
        <th>{{ __('sevencolumn.3colId') }}</th>
        <th>{{ __('sevencolumn.userId') }}</th>
      </tr>

      <tr>
        <td>{{ date('Y/n/d H:i', strtotime( $seven_column->created_at)) }}</td>
        <td>{{ date('Y/n/d H:i', strtotime( $seven_column->updated_at)) }}</td>
        <td>{{ $seven_column->id }}</td>
        <td>{{ $seven_column->event_id }}</td>
        <td>{{ $seven_column->threecol_id }}</td>
        <td>{{ $seven_column->user_id }}</td>
      </tr>

    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('sevencolumn.1-1_title') }}</th>
      </tr>
      <tr>
        <td>{{ $event->title }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('sevencolumn.1-2_title') }}</th>
      </tr>
      <tr>
        <td>{{ $event->content }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('sevencolumn.3-1_title') }}</th>
      </tr>
      <tr>
        <td>{{ $three_column->thinking }}</td>
      </tr>
    </table>
    
    <table class="table table-bordered">
      <tr>
        <th>{{ __('sevencolumn.3-2_title') }}</th>
      </tr>
      <td><?php foreach ($habit_names as $name) {
            echo "・" . $name . "<br>";
          }
          ?>
      </td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('sevencolumn.4_title') }}</th>
      </tr>
      <tr>
        <td>{{ $seven_column->basis_thinking }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('sevencolumn.5_title') }}</th>
      </tr>
      <tr>
        <td>{{ $seven_column->opposite_fact }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('sevencolumn.6_title') }}</th>
      </tr>
      <tr>
        <td>{{ $seven_column->new_thinking }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th colspan="3">{{ __('sevencolumn.emotion_change') }}</th>
      </tr>
      <tr>
        <td>{{ __('sevencolumn.emotion_name') }}</td>
        <td>{{ __('sevencolumn.prev_emotion_strength') }}</td>
        <td>{{ __('sevencolumn.new_emotion_strength') }}</td>
      </tr>
      <tr>
        <td>{{ $seven_column->new_emotion_name }}</td>
        <td>{{ $three_column->emotion_strength }}</td>
        <td>{{ $seven_column->new_emotion_strength }}</td>
      </tr>
      @if(isset($seven_column->new_emotion_name00))
        <tr>
          <td>{{ $seven_column->new_emotion_name00 }}</td>
          <td>{{ $three_column->emotion_strength00 }}</td>
          <td>{{ $seven_column->new_emotion_strength00 }}</td>
        </tr>
      @endif

      @if(isset($seven_column->new_emotion_name01))
        <tr>
          <td>{{ $seven_column->new_emotion_name01 }}</td>
          <td>{{ $three_column->emotion_strength01 }}</td>
          <td>{{ $seven_column->new_emotion_strength01 }}</td>
        </tr>
      @endif

      @if(isset($seven_column->new_emotion_name02))
        <tr>
          <td>{{ $seven_column->new_emotion_name02 }}</td>
          <td>{{ $three_column->emotion_strength02 }}</td>
          <td>{{ $seven_column->new_emotion_strength02 }}</td>
        </tr>
      @endif
    </table>

    <div class="buttons-first">
      <form action="{{ route('seven_columns.edit', ['param' => $seven_column->id] ) }}" , method="GET">
        @csrf
        <button type="submit" class="btn btn-secondary btn-lg">編集</button>
      </form>
    </div>

    <div class="buttons">
      <form action="{{ route('seven_columns.destroy', ['param' => $seven_column->id] ) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirmDelete();">削除</button>
      </form>
    </div>

    <div class="buttons">
      <button class="btn btn-primary btn-lg" onclick="history.back(-1)">戻る</button>
    </div>

  </div>
</div>
@endsection