<?php 
  $locale = App::currentLocale();
  $json_array = json_encode($locale);
?>
@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  
  <div class="col-sm-8">
    <h3 class="title_head">プロフィール</h3>
      <div class="container">
        <div class="row">
          <table class="table table-bordered">
          <tr>
            <th class="col-12 profile">お名前</th>
            <td class="col-7">{{ $user->name }}</td>
            <td class="col-2">
              <a href="{{ route('user.name_edit') }}" class="profiles">編集</a>
            </td>
          </tr>
          <tr>
            <th class="col-3 profile">メールアドレス</th>
            <td class="col-7">{{ $user->email }}</td>
            <td class="col-2">
              <a href="{{ route('user.email_edit') }}" class="profiles">編集</a></td>
          </tr>
          <tr>
            <th class="col-3 profile">パスワード</th>
            <td class="col-7"></td>
            <td class="col-2">
              <a href="{{ route('user.password_edit') }}" class="profiles">編集</a></td>
          </tr>
          </table>
        </div>
      </div>
      
      <!-- モーダル -->
      <div id="modal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            
            <h3>名前の編集</h3>
          </div>
          <div class="modal-body">
            <form action="{{ route('user.nameupdate') }}" method="POST">
              @csrf
              @method('PUT')
              <label for="name" class="form-lavel mt-3">名前</label>
              <input type="name"
                     id="name"
                     class="form-control"
                     name="name"
                     value="{{ $user->name }}">

          </div>

            <div class="modal-footer">
              <button type="submit" onclick="sa()" id="nameSubmit" class="btn btn-primary">保存</button>
              <button type="button" id="close" class="modalClose btn btn-danger">キャンセル</button>
            </div>
          </form>
        </div>
      </div>

  </div>
  
<!-- </div> -->
<script>
// const modal = document.getElementById('demo-modal');
// const btn = document.getElementById('open-modal');
// // var close = modal.getElementsByClassName('close')[0];
// // var close = modal.getElementById('close');
// const buttonClose = modal.getElementsByClassName('modalClose')[0];
// // When the user clicks the button, open the modal.


// btn.onclick = function() {
//   modal.style.display = 'block';
// };

// // When the user clicks on 'X', close the modal
// close.onclick = function() {
//   modal.style.display = 'none';
// };

// // When the user clicks outside the modal -- close it.
// window.onclick = function(event) {
//   if (event.target == modal) {
//     // Which means he clicked somewhere in the modal (background area), but not target = modal-content
//     modal.style.display = 'none';
//   }
// };
const buttonOpen  = document.getElementById('open-modal');
const modal       = document.getElementById('modal');
const buttonClose = document.getElementsByClassName('modalClose')[0];
const nameSubmit  = document.getElementById('nameSubmit');
console.log(nameSubmit);
// ボタンがクリックされた時
buttonOpen.addEventListener('click', modalOpen);
function modalOpen() {
  modal.style.display = 'block';
}

// バツ印がクリックされた時
buttonClose.addEventListener('click', modalClose);
function modalClose() {
  modal.style.display = 'none';
}

// モーダルコンテンツ以外がクリックされた時
addEventListener('click', outsideClose);
function outsideClose(e) {
  if (e.target == modal) {
    modal.style.display = 'none';
  }
}

function sa() {
  doc
}

</script>
@endsection

