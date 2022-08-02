/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/sample01.js ***!
  \**********************************/
window.confirmDelete = function () {
  if (window.confirm('本当に削除してもよろしいでしょうか?')) {
    document.forms[0].submit();
  } else {
    return false;
  }
}; // 出来事バリデーション


window.eventValidation = function (locale) {
  console.log(locale); // フォームの要素を取得

  var eventTitle = document.querySelector('#eventTitle'); // エラーメッセージを表示させる要素を取得

  var errMsgName01 = document.querySelector('.err-msg-name01');
  var errMsgName02 = document.querySelector('.err-msg-name02');
  var errTitleCount = 0;
  var errContentCount = 0; //var a = window.sessionStorage.getItem([key01]); // キーkey-1をもつセッションの値を取得
  // タイトルの入力必須バリデーション
  // null 空文字　空配列　空のcountableオブジェクト　値がパスのないアップロード済みファイル

  if (!eventTitle.value) {
    // クラスを追加(エラーメッセージを表示する)
    errMsgName01.classList.add('form-invalid'); // エラーメッセージのテキスト

    if (locale === "ja") {
      errMsgName01.textContent = '入力してください';
    }

    if (locale === "en") {
      errMsgName01.textContent = 'Please input';
    }

    if (locale === "uk") {
      errMsgName01.textContent = 'будь ласка, введіть';
    } // クラスを追加(フォームの枠線を赤くする)


    eventTitle.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errTitleCount += 1;
  } // タイトル最大文字数バリデーション


  if (eventTitle.value.length > 30) {
    errMsgName01.classList.add('form-invalid'); // エラーメッセージのテキスト

    errMsgName01.textContent = '30文字以内で入力してください'; // クラスを追加(フォームの枠線を赤くする)

    eventTitle.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errTitleCount += 1;
  }

  if (errTitleCount === 0) {
    // エラーメッセージのテキストに空文字を代入
    errMsgName01.textContent = ''; // クラスを削除

    eventTitle.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  } // 内容の入力必須バリデーション


  if (!eventContent.value) {
    // クラスを追加(エラーメッセージを表示する)
    errMsgName02.classList.add('form-invalid'); // エラーメッセージのテキスト

    if (locale === "ja") {
      errMsgName02.textContent = '入力してください';
    }

    if (locale === "en") {
      errMsgName02.textContent = 'Please input';
    }

    if (locale === "uk") {
      errMsgName02.textContent = 'будь ласка, введіть';
    } // クラスを追加(フォームの枠線を赤くする)


    eventContent.classList.add('border-danger');
    errMsgName02.classList.add('alert');
    errMsgName02.classList.add('alert-danger');
    errContentCount += 1;
  } // 内容最大文字数バリデーション


  if (eventTitle.value.length > 500) {
    errMsgName02.classList.add('form-invalid'); // エラーメッセージのテキスト

    errMsgName02.textContent = '500文字以内で入力してください'; // クラスを追加(フォームの枠線を赤くする)

    eventTitle.classList.add('border-danger');
    errMsgName02.classList.add('alert');
    errMsgName02.classList.add('alert-danger');
    errContentCount += 1;
  }

  if (errContentCount === 0) {
    // エラーメッセージのテキストに空文字を代入
    errMsgName02.textContent = ''; // クラスを削除

    eventTitle.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
  }

  if (errTitleCount > 0 || errContentCount > 0) {
    return false;
  }
}; // 3コラムバリデーション


window.threecolumnValidation = function () {
  console.log("test"); // フォームの要素を取得

  var emotion_name = document.querySelector('#emotion_name_def');
  var emotion_strength = document.querySelector('#emotion_strength_def');
  var thinking = document.querySelector('#thinking');
  console.log(emotion_strength);
  var errMsgName01 = document.querySelector('.err-msg-name01');
  var errMsgName02 = document.querySelector('.err-msg-name02');
  var errMsgName03 = document.querySelector('.err-msg-name03');
  var errCount = 0; // 感情名入力必須バリデーション

  if (!emotion_name.value) {
    errMsgName01.classList.add('form-invalid'); // エラーメッセージのテキスト

    errMsgName01.textContent = '入力してください'; // クラスを追加(フォームの枠線を赤くする)

    emotion_name.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errCount += 1;
  } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName01.textContent = ''; // クラスを削除

    emotion_name.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  } // 感情の強さ入力必須バリデーション


  if (!emotion_strength.value) {
    errMsgName02.classList.add('form-invalid'); // エラーメッセージのテキスト

    errMsgName02.textContent = '入力してください'; // クラスを追加(フォームの枠線を赤くする)

    emotion_strength.classList.add('border-danger');
    errMsgName02.classList.add('alert');
    errMsgName02.classList.add('alert-danger');
    errCount += 1;
  } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName02.textContent = ''; // クラスを削除

    emotion_strength.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
  } // 自動思考の入力必須バリデーション


  if (!thinking.value) {
    errMsgName03.classList.add('form-invalid'); // エラーメッセージのテキスト

    errMsgName03.textContent = '入力してください'; // クラスを追加(フォームの枠線を赤くする)

    thinking.classList.add('border-danger');
    errMsgName03.classList.add('alert');
    errMsgName03.classList.add('alert-danger');
    errCount += 1;
  } else {
    // エラーメッセージのテキストに空文字を代入
    errMsgName03.textContent = ''; // クラスを削除

    thinking.classList.remove('border-danger');
    errMsgName03.classList.remove('alert');
    errMsgName03.classList.remove('alert-danger');
  }

  if (errCount > 0) {
    return false;
  }
};
/******/ })()
;