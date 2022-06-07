@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-sm-7">
    <h3 class="title_head">{{ __('threecolumn.showPageTitle') }}　( id={{ $three_column->id }} )</h3>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('threecolumn.title01') }}</th>
        <th>{{ __('threecolumn.title02') }}</th>
        <th>{{ __('threecolumn.title03') }}</th>
        <th>{{ __('threecolumn.title04') }}</th>
        <th>{{ __('threecolumn.title05') }}</th>
      </tr>

      <tr>
        <td>{{ $three_column->created_at}}</td>
        <td>{{ $three_column->updated_at }}</td>
        <td>{{ $user->id }}</td>
        <td>{{ $event->id }}</td>
        <td>{{ $three_column->id }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('threecolumn.1-1_title') }}</th>
        <th>{{ __('threecolumn.1-2_title') }}</th>
      </tr>

      <tr>
        <td>{{ $event->title }}</td>
        <td>{{ $event->content }}</td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <th>{{ __('threecolumn.2-1_title') }}</th>
        <th>{{ __('threecolumn.2-2_title') }}</th>
        </th>
      </tr>
      <tr>
        <td>{{ $three_column->emotion_name }}</td>
        <td>{{ $three_column->emotion_strength }}</td> 
      </tr>

      @if($three_column->emotion_name00)
        <tr>
          <td>{{ $three_column->emotion_name00 }}</td>
          <td>{{ $three_column->emotion_strength00 }}</td>
        </tr>
      @endif

      @if($three_column->emotion_name01)
        <tr>
          <td>{{ $three_column->emotion_name01 }}</td>
          <td>{{ $three_column->emotion_strength01 }}</td>
        </tr>
      @endif

      @if($three_column->emotion_name02)
        <tr>
          <td>{{ $three_column->emotion_name02 }}</td>
          <td>{{ $three_column->emotion_strength02 }}</td>
        </tr>
      @endif
      
      </table>

    <table class="table table-bordered" class="table table-bordered">
      <tr>
        <th width="70%">{{ __('threecolumn.3-1_title') }}</th>
      </tr>
      <tr>
        <td width="70%">{{ $three_column->thinking }}</td>
      </tr>
    </table>


    <table class="table table-bordered">
      <tr>
        <th>{{ __('threecolumn.3-2_title') }}</th>
      </tr>
      <tr>
        <td>
          <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" 
                     type="checkbox" 
                     name="habit[0]" 
                     id="1" 
                     <?php
                       if (in_array(1, $habit_id)) {
                         echo 'checked';
                       }
                     ?>
              >
              <label class="form-check-label" for="1">
              {{ __('threecolumn.habitName01') }}
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" 
                     type="checkbox" 
                     name="habit[0]" 
                     id="1" 
                     <?php
                       if (in_array(2, $habit_id)) {
                         echo 'checked';
                       }
                     ?>
              >
              <label class="form-check-label" for="1">
                {{ __('threecolumn.habitName02') }}
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="habit[0]" id="1" <?php
                                                                                      if (in_array(3, $habit_id)) {
                                                                                        echo 'checked';
                                                                                      }
                                                                                      ?>>
              <label class="form-check-label" for="1">
                {{ __('threecolumn.habitName03') }}              
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="habit[0]" id="1" <?php
                                                                                      if (in_array(4, $habit_id)) {
                                                                                        echo 'checked';
                                                                                      }
                                                                                      ?>>
              <label class="form-check-label" for="1">
                {{ __('threecolumn.habitName04') }}
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="habit[0]" id="1" <?php
                                                                                      if (in_array(5, $habit_id)) {
                                                                                        echo 'checked';
                                                                                      }
                                                                                      ?>>
              <label class="form-check-label" for="1">
                {{ __('threecolumn.habitName05') }}
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="habit[0]" id="1" <?php
                                                                                      if (in_array(6, $habit_id)) {
                                                                                        echo 'checked';
                                                                                      }
                                                                                      ?>>
              <label class="form-check-label" for="1">
                {{ __('threecolumn.habitName06') }}
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="habit[0]" id="1" <?php
                                                                                      if (in_array(7, $habit_id)) {
                                                                                        echo 'checked';
                                                                                      }
                                                                                      ?>>
              <label class="form-check-label" for="1">
                {{ __('threecolumn.habitName07') }}
              </label>
            </div>
          </div>
        </td>

      </tr>
    </table>

    <div class="buttons-first">
      <form action="{{ route('seven_columns.create', ['id' => $three_column->id]) }}" method="get">
        @CSRF
        <button type="submit" class="btn btn-success btn-lg">{{ __('threecolumn.buttonCreate7') }}</button>
      </form>
    </div>

    <div class="buttons">
      <form action="{{ route('three_columns.edit', ['param' => $three_column->id] ) }}" method="get">
        @CSRF
        <button type="submit" class="btn btn-secondary btn-lg">{{ __('threecolumn.buttonEdit') }}</button>
      </form>
    </div>

    <div class="buttons">
      <form action="{{ route('three_columns.destroy', ['param' => $three_column->id] ) }}" method="post">
        @CSRF
        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirmDelete();">{{ __('threecolumn.buttonDelete') }}</button>
      </form>
    </div>

    <div class="buttons">
      <button class="btn btn-primary btn-lg" onclick="history.back(-1)">{{ __('threecolumn.buttonBack') }}</button>
    </div>
  </div>
</div>
@endsection