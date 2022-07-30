

// 削除する場合に確認ウインドウを表示する
function confirmDelete() {
  if (window.confirm('本当に削除してもよろしいでしょうか?')) {
    document.forms[0].submit();
  } else {
    return false;
  }
}

// 出来事バリデーション
function eventValidation() {
  console.log("test");

  // フォームの要素を取得
  const eventTitle = document.querySelector('#eventTitle');
  // エラーメッセージを表示させる要素を取得
  const errMsgName01 = document.querySelector('.err-msg-name01');
  const errMsgName02 = document.querySelector('.err-msg-name02');
  var errCount = 0;
  
  // タイトルの入力必須バリデーション
  if(!eventTitle.value) {
    // クラスを追加(エラーメッセージを表示する)
    errMsgName01.classList.add('form-invalid');
    // エラーメッセージのテキスト
    errMsgName01.textContent = '入力してください';
    // クラスを追加(フォームの枠線を赤くする)
    eventTitle.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errCount += 1;
    
  } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName01.textContent ='';
    // クラスを削除
    eventTitle.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }

  // 内容の入力必須バリデーション
  if(!eventContent.value) {
    // クラスを追加(エラーメッセージを表示する)
    errMsgName02.classList.add('form-invalid');
    // エラーメッセージのテキスト
    errMsgName02.textContent = '入力してください';
    // クラスを追加(フォームの枠線を赤くする)
    eventContent.classList.add('border-danger');
    errMsgName02.classList.add('alert');
    errMsgName02.classList.add('alert-danger');
    errCount += 1;
    
    } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName02.textContent ='';
    // クラスを削除
    eventContent.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
}

  if (errCount > 0) {
    return false;
  }
  
}

// 3コラム入力必須バリデーション
function threecolumnValidation() {

}
