@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
<div class="row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">7コラム詳細ページ ( id = {{ $seven_column->id }} )</h3>

    <table class="table table-bordered">
      <tr>
        <th>作成日時</th>
        <th>最終変更日時</th>
        <th>id</th>
        <th>出来事ID</th>
        <th>3コラムID</th>
        <th>ユーザーID</th>
      </tr>

      <tr>
        <td>{{ date( 'Y/m/d H:i', strtotime( $seven_column->created_at) ) }}</td>
        <td>{{ date( 'Y/m/d H:i', strtotime( $seven_column->updated_at) ) }}</td>
        <td>{{ $seven_column->id }}</td>
        <td>{{ $seven_column->event_id }}</td>
        <td>{{ $seven_column->threecol_id }}</td>
        <td>{{ $seven_column->user_id }}</td>
      </tr>

    </table>

    <table class="table table-bordered">
      <tr>
        <th>タイトル</th>
      </tr>
      <tr>
        <td>{{ $event->title }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>内容</th>
      </tr>
      <tr>
        <td>{{ $event->content }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>その時考えた事</th>
      </tr>
      <tr>
        <td>{{ $three_column->thinking }}</td>
      </tr>
    </table>
    
    <table class="table table-bordered">
      <tr>
        <th>考え方の癖</th>
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
        <th>その考えの根拠</th>
      </tr>
      <tr>
        <td>{{ $seven_column->basis_thinking }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>逆の事実</th>
      </tr>
      <tr>
        <td>{{ $seven_column->opposite_fact }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>新しい考え</th>
      </tr>
      <tr>
        <td>{{ $seven_column->new_thinking }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th colspan="3">感情の変化</th>
      </tr>
      <tr>
        <td>感情名</td>
        <td>以前の感情の強さ</td>
        <td>新しい感情の強さ</td>
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
        @CSRF
        <button type="submit" class="btn btn-secondary btn-lg">編集</button>
      </form>
    </div>

    <div class="buttons">
      <form action="{{ route('seven_columns.destroy', ['param' => $seven_column->id] ) }}" method="POST">
        @CSRF
        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirmDelete();">削除</button>
      </form>
    </div>

    <div class="buttons">
      <button class="btn btn-primary btn-lg" onclick="history.back(-1)">戻る</button>
    </div>

  </div>
</div>
@endsection