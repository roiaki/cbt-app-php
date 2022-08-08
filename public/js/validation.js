/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/validation.js ***!
  \************************************/
/**
 * 削除するときの確認フォーム
 * 
 * @returns boolean true or false 削除するかしないか
 */
window.confirmDelete = function () {
  if (window.confirm('本当に削除してもよろしいでしょうか?')) {
    document.forms[0].submit();
  } else {
    return false;
  }
}; // 出来事バリデーション


window.eventValidation = function (locale) {
  // エラーメッセージを表示させる要素を取得
  var errMsgName01 = document.querySelector('.err-msg-name01');
  var errMsgName02 = document.querySelector('.err-msg-name02');
  var errTitleCount = 0;
  var errContentCount = 0;
  var errCount = 0;
  errTitleCount += checkRequired(locale, "#eventTitle", ".err-msg-name01");
  errTitleCount += checkMaxNumInputChar(locale, "#eventTitle", ".err-msg-name01", 15);
  errContentCount += checkRequired(locale, "#eventContent", ".err-msg-name02");
  errContentCount += checkMaxNumInputChar(locale, "#eventContent", ".err-msg-name02", 500);

  if (errTitleCount === 0) {
    // エラーメッセージのテキストに空文字を代入
    errMsgName01.textContent = ''; // クラスを削除

    eventTitle.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }

  if (errContentCount === 0) {
    // エラーメッセージのテキストに空文字を代入
    errMsgName02.textContent = ''; // クラスを削除

    eventContent.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
  }

  errCount = errTitleCount + errContentCount;

  if (errCount > 0) {
    return false;
  }
};
/**
 * 3コラムバリデーション
 * 
 * @param locale 言語切り替え
 */


window.threecolumnValidation = function (locale) {
  console.log(locale); // フォームの要素を取得

  var emotion_name = document.querySelector('#emotion_name');
  var emotion_strength = document.querySelector('#emotion_strength');
  var thinking = document.querySelector('#thinking');
  var errMsgName01 = document.querySelector('.err-msg-name01');
  var errMsgName02 = document.querySelector('.err-msg-name02');
  var errMsgName03 = document.querySelector('.err-msg-name03');
  var errCount = 0;
  var errEmotionNameCount = 0;
  var errEmotionStrengthCount = 0;
  var errThinkingCount = 0;
  var errSum = 0;
  errEmotionNameCount += checkRequired(locale, "#emotion_name", ".err-msg-name01");
  errEmotionNameCount += checkMaxNumInputChar(locale, "#emotion_name", ".err-msg-name01", 15);
  errEmotionStrengthCount += checkRequired(locale, "#emotion_strength", ".err-msg-name02");
  errEmotionStrengthCount += isNumber(locale, "#emotion_strength", ".err-msg-name02");
  errThinkingCount += checkRequired(locale, "#thinking", ".err-msg-name03");
  errThinkingCount += checkMaxNumInputChar(locale, "#thinking", ".err-msg-name03", 500); // エラーがあった個所へスクロール

  if (errEmotionNameCount > 0) {
    window.scrollTo({
      top: emotion_name.offsetTop,
      behavior: 'smooth'
    });
  }

  if (errEmotionStrengthCount > 0) {
    window.scrollTo({
      top: emotion_strength.offsetTop,
      behavior: 'smooth'
    });
  }

  errSum = errEmotionNameCount + errEmotionStrengthCount;

  if (errSum === 0 && errThinkingCount > 0) {
    window.scrollTo({
      top: thinking.offsetTop - 200,
      behavior: 'smooth'
    });
  } // エラーがないなら赤枠リセット


  if (errEmotionNameCount === 0) {
    errMsgName01.textContent = '';
    emotion_name.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  } // エラーがないなら赤枠リセット


  if (errEmotionStrengthCount === 0) {
    errMsgName02.textContent = '';
    emotion_strength.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
  } // エラーがないなら赤枠リセット


  if (errThinkingCount === 0) {
    errMsgName03.textContent = '';
    thinking.classList.remove('border-danger');
    errMsgName03.classList.remove('alert');
    errMsgName03.classList.remove('alert-danger');
  }

  errCount = errEmotionNameCount + errEmotionStrengthCount + errThinkingCount;

  if (errCount > 0) {
    return false;
  }
};
/**
 * 7コラムバリデーション
 * @param locale 言語切り替え
 */


window.sevencolumnValidation = function (locale) {
  // フォームの要素を取得
  var basis_thinking = document.querySelector('#basis_thinking');
  var opposite_fact = document.querySelector('#opposite_fact');
  var new_thinking = document.querySelector('#new_thinking');
  var new_emotion_strength01 = document.querySelector('#new_emotion_strength');
  var new_emotion_strength02 = document.querySelector('#new_emotion_strength00');
  var new_emotion_strength03 = document.querySelector('#new_emotion_strength01');
  var new_emotion_strength04 = document.querySelector('#new_emotion_strength02');
  var errMsgName01 = document.querySelector('.err-msg-name01');
  var errMsgName02 = document.querySelector('.err-msg-name02');
  var errMsgName03 = document.querySelector('.err-msg-name03');
  var errMsgName04 = document.querySelector('.err-msg-name04');
  var errCount = 0;
  var errBasisThinkingCount = 0;
  var errOppsiteFactCount = 0;
  var errThinkingCount = 0;
  var errNewEmotionCount01 = 0;
  var errNewEmotionCount02 = 0;
  var errNewEmotionCount03 = 0;
  var errNewEmotionCount04 = 0;
  var errNewEmotionSumCount = 0;
  errBasisThinkingCount += checkRequired(locale, "#basis_thinking", ".err-msg-name01");
  errBasisThinkingCount += checkMaxNumInputChar(locale, "#basis_thinking", ".err-msg-name01", 500);
  errOppsiteFactCount += checkRequired(locale, "#opposite_fact", ".err-msg-name02");
  errOppsiteFactCount += checkMaxNumInputChar(locale, "#opposite_fact", ".err-msg-name02", 500);
  errThinkingCount += checkRequired(locale, "#new_thinking", ".err-msg-name03");
  errThinkingCount += checkMaxNumInputChar(locale, "#new_thinking", ".err-msg-name03", 500);

  if (new_emotion_strength01) {
    errNewEmotionCount01 += checkRequired(locale, "#new_emotion_strength", ".err-msg-name04");
    console.log(errNewEmotionCount01);
  }

  if (new_emotion_strength02) {
    errNewEmotionCount02 += checkRequired(locale, "#new_emotion_strength00", ".err-msg-name04");
    console.log(errNewEmotionCount02);
  }

  if (new_emotion_strength03) {
    errNewEmotionCount03 += checkRequired(locale, "#new_emotion_strength01", ".err-msg-name04");
    console.log(errNewEmotionCount03);
  }

  if (new_emotion_strength04) {
    errNewEmotionCount04 += checkRequired(locale, "#new_emotion_strength02", ".err-msg-name04");
    console.log(errNewEmotionCount04);
  }

  if (errBasisThinkingCount > 0) {
    window.scrollTo({
      top: basis_thinking.offsetTop - 100,
      behavior: 'smooth'
    });
  }

  if (errOppsiteFactCount > 0 && errBasisThinkingCount === 0) {
    window.scrollTo({
      top: opposite_fact.offsetTop - 100,
      behavior: 'smooth'
    });
  }

  if (errThinkingCount > 0 && errOppsiteFactCount === 0 && errBasisThinkingCount === 0) {
    window.scrollTo({
      top: new_thinking.offsetTop - 100,
      behavior: 'smooth'
    });
  } // エラーがないなら赤枠リセット


  if (errBasisThinkingCount === 0) {
    errMsgName01.textContent = '';
    basis_thinking.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  } // エラーがないなら赤枠リセット


  if (errOppsiteFactCount === 0) {
    errMsgName02.textContent = '';
    opposite_fact.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
  } // エラーがないなら赤枠リセット


  if (errThinkingCount === 0) {
    errMsgName03.textContent = '';
    new_thinking.classList.remove('border-danger');
    errMsgName03.classList.remove('alert');
    errMsgName03.classList.remove('alert-danger');
  } // エラーがないなら赤枠リセット


  if (new_emotion_strength01) {
    if (errNewEmotionCount01 === 0) {
      new_emotion_strength01.classList.remove('border-danger');
    }
  }

  if (new_emotion_strength02) {
    if (errNewEmotionCount02 === 0) {
      new_emotion_strength02.classList.remove('border-danger');
    }
  }

  if (new_emotion_strength03) {
    if (errNewEmotionCount03 === 0) {
      new_emotion_strength03.classList.remove('border-danger');
    }
  }

  if (new_emotion_strength04) {
    if (errNewEmotionCount04 === 0) {
      new_emotion_strength04.classList.remove('border-danger');
    }
  }

  errNewEmotionSumCount = errNewEmotionCount01 + errNewEmotionCount02 + errNewEmotionCount03 + errNewEmotionCount04;

  if (errNewEmotionSumCount === 0) {
    errMsgName04.textContent = '';
    errMsgName04.classList.remove('alert');
    errMsgName04.classList.remove('alert-danger');
  }

  errCount = errBasisThinkingCount + errOppsiteFactCount + errThinkingCount + errNewEmotionCount01 + errNewEmotionCount02 + errNewEmotionCount03 + errNewEmotionCount04;

  if (errCount > 0) {
    return false;
  }
};
/**
 * 入力必須チェック
 * 
 * @param {string} locale 
 * @param {string} elementId 
 * @param {string} errMessageClass 
 * @returns int errCount
 */


function checkRequired(locale, elementId, errMessageClass) {
  var tagetElement = document.querySelector(elementId);
  var errMsg = document.querySelector(errMessageClass);
  errCount = 0;

  if (!tagetElement.value) {
    // エラーメッセージのテキスト
    if (locale === "ja") {
      errMsg.textContent = '入力してください';
    }

    if (locale === "en") {
      errMsg.textContent = 'Please input';
    }

    if (locale === "uk") {
      errMsg.textContent = 'будь ласка, введіть';
    } // クラスを追加(フォームの枠線を赤くする)


    tagetElement.classList.add('border-danger');
    errMsg.classList.add('alert');
    errMsg.classList.add('alert-danger');
    errCount = 1;
  }

  return errCount;
}
/**
 * 最大入力文字数チェック
 * 
 * @param {*} locale 
 * @param {*} elementId 
 * @param {*} errMessageClass 
 * @returns 
 */


function checkMaxNumInputChar(locale, elementId, errMessageClass, maxNumber) {
  var tagetElement = document.querySelector(elementId);
  var errMsg = document.querySelector(errMessageClass);
  var errCount = 0;

  if (tagetElement.value.length > maxNumber) {
    if (locale === "ja") {
      errMsg.textContent = String(maxNumber) + "文字以内で入力してください";
    }

    if (locale === "en") {
      errMsg.textContent = 'Please enter up to 500 characters';
    }

    if (locale === "uk") {
      errMsg.textContent = 'Введіть до 500 символів';
    } // クラスを追加(フォームの枠線を赤くする)


    tagetElement.classList.add('border-danger');
    errMsg.classList.add('alert');
    errMsg.classList.add('alert-danger');
    errCount = 1;
  }

  return errCount;
}
/**
 * 数字かチェック
 * 
 * @param {*} locale 
 * @returns 
*/


function isNumber(locale, elementId, errMsgClass) {
  var targetElement = document.querySelector(elementId);
  var errMsg = document.querySelector(errMsgClass);
  var errCount = 0; // 数字がどうかバリデーション

  if (isNaN(targetElement.value)) {
    errMsg.classList.add('form-invalid'); // エラーメッセージのテキスト

    if (locale === "ja") {
      errMsg.textContent = '数字を入力してください';
    }

    if (locale === "en") {
      errMsg.textContent = 'Please enter a number';
    }

    if (locale === "uk") {
      errMsg.textContent = 'Будь ласка, введіть номер';
    }

    targetElement.classList.add('border-danger');
    errMsg.classList.add('alert');
    errMsg.classList.add('alert-danger');
    errEmotionStrengthCount = 1;
  }

  return errCount;
}
/******/ })()
;