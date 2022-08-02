

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
  console.log("test");

  // フォームの要素を取得
  const emotion_name = document.querySelector('#emotion_name_def');
  const emotion_strength = document.querySelector('#emotion_strength_def');
  const thinking = document.querySelector('#thinking');


  console.log(emotion_strength);

  const errMsgName01 = document.querySelector('.err-msg-name01');
  const errMsgName02 = document.querySelector('.err-msg-name02');
  const errMsgName03 = document.querySelector('.err-msg-name03');

  var errCount = 0;

  // 感情名入力必須バリデーション
  if(!emotion_name.value) {
    errMsgName01.classList.add('form-invalid');
    // エラーメッセージのテキスト
    errMsgName01.textContent = '入力してください';
    // クラスを追加(フォームの枠線を赤くする)
    emotion_name.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errCount += 1;
    
  } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName01.textContent ='';
    // クラスを削除
    emotion_name.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }

  // 感情の強さ入力必須バリデーション
  if(!emotion_strength.value) {
    errMsgName02.classList.add('form-invalid');
    // エラーメッセージのテキスト
    errMsgName02.textContent = '入力してください';
    // クラスを追加(フォームの枠線を赤くする)
    emotion_strength.classList.add('border-danger');
    errMsgName02.classList.add('alert');
    errMsgName02.classList.add('alert-danger');
    errCount += 1;
    
  } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName02.textContent ='';
    // クラスを削除
    emotion_strength.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
  }
  
  // 自動思考の入力必須バリデーション
  if(!thinking.value) {
    errMsgName03.classList.add('form-invalid');
    // エラーメッセージのテキスト
    errMsgName03.textContent = '入力してください';
    // クラスを追加(フォームの枠線を赤くする)
    thinking.classList.add('border-danger');
    errMsgName03.classList.add('alert');
    errMsgName03.classList.add('alert-danger');
    errCount += 1;
    
  } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName03.textContent ='';
    // クラスを削除
    thinking.classList.remove('border-danger');
    errMsgName03.classList.remove('alert');
    errMsgName03.classList.remove('alert-danger');
  }

  if (errCount > 0) {
    return false;
  }
}
