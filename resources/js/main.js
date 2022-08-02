// 削除確認 froms[0] ?
function confirmDelete() {
  if (window.confirm('本当に削除してもよろしいでしょうか?')) {
    document.forms[0].submit();
  } else {
    return false;
  }
}

function eventValidation() {
  console.log("test");
  alert("お名前を入力してください。");
  return false;
}

/*
  // フォームの要素を取得
  const eventTitle = document.querySelector('#eventTitle');
  // エラーメッセージを表示させる要素を取得
  const errMsgName01 = document.querySelector('.err-msg-name01');
  const errMsgName02 = document.querySelector('.err-msg-name02');
  var errCount;
  
  if(!eventTitle.value) {
    // クラスを追加(エラーメッセージを表示する)
    errMsgName01.classList.add('form-invalid');
    // エラーメッセージのテキスト
    errMsgName01.textContent = '入力してください';
    // クラスを追加(フォームの枠線を赤くする)
    eventTitle.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    //errCount += 1;
    // 後続の処理を止める
    //return;
  } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName01.textContent ='';
    // クラスを削除
    eventTitle.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }
  */

