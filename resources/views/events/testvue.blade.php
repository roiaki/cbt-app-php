@extends('layouts.app')

@section('content')

<h3>VueTest</h3>
<div class="row">

  <form action="{{ route('events.create') }}" class="form-group" method="get">
    <div id="form_area" class="col-xs-2" style="flex-direction: column;">
      <div class="form-group" style="flex-direction: column;">
        <input type="text" name="text_0" id="text_0" class="form-control" style="margin:5px" size="10" placeholder="感情名_0">
        <input type="number" name="number_0" id="number_0" class="form-control" style="margin:5px" size="10" placeholder="感情の強さ_0">



        <div class="col-xs-2" id="form_area01">
        </div>

        <div class="col-xs-2" id="form_area02">
        </div>

        <div class="col-xs-2" id="form_area03"></div>
      </div>
      <input type="button" value="フォーム追加" onclick="addForm()">
      <input type="button" value="フォーム削除" onclick="deleteForm()">

      <input type="submit" value="送信">
    </div>
</div>
</form>
</div>


<script>
  var i = 1;

  // フォーム追加
  function addForm() {

    // input text要素を作成
    var input_data = document.createElement('input');
    input_data.type = 'text';
    input_data.name = 'text_' + i;
    input_data.class = 'form-control';
    input_data.size = '20';
    input_data.style = "margin:5px";
    input_data.id = 'inputform_' + i;
    input_data.placeholder = '感情名_' + i;
    var a = document.getElementById('form_area01');
    a.appendChild(input_data);

    // input number 要素を作成
    var input_data = document.createElement('input');
    input_data.type = 'number';
    input_data.name = 'number_' + i;
    input_data.class = 'form-control';
    input_data.size = '20';
    input_data.style = "margin:5px";
    input_data.id = 'inputform_' + i;
    input_data.placeholder = '強さ_' + i;
    var b = document.getElementById('form_area02');
    b.appendChild(input_data);

    i++;
  }

  // フォーム削除
  function deleteForm() {
    const element01 = document.getElementById('form_area01');
    const element02 = document.getElementById('form_area02');
    element01.innerHTML = '';
    element02.innerHTML = '';
  }
</script>
@endsection