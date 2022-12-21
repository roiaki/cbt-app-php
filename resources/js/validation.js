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
}
/**
 * ログイン画面で送信ボタンが押された時、問題がなければ送信する
 */
window.checkLogin = function() {
  let errCount = 0;

  errCount += validationLoginEmail();
  errCount += validationLoginPass();

  if(errCount > 0) {
    return false;
  } else {
    return true;
  }
}
/**
 * ログイン画面のメールアドレスのバリデーションをします
 * 
 * @return {Number} errCount エラーの数
 */
window.validationLoginEmail = function() {
  
  let errCount = 0;

  errCount += checkRequired(locale, "#email", ".err-msg-name01");

  if(errCount === 1) {
    //
  } else {
    errCount += checkEmailFormat(locale, "#email", ".err-msg-name01");
  }
  
  if(errCount === 0) {
    removeErrmsg("#email", ".err-msg-name01");
  }
  return errCount;
}

/**
 * ログイン画面でのパスワードのバリデーションをします
 * 
 * @returns {Number} errCount エラーの数
 */
window.validationLoginPass = function() {
  
  let errCount = 0;

  errCount += checkRequired(locale, "#password", ".err-msg-name02");

  if(errCount === 1) {
    //
  } else {
    errCount += checkMinNumInputChar(locale, "#password", ".err-msg-name02", 8);
  }
  
  if(errCount === 0) {
    removeErrmsg("#password", ".err-msg-name02");
  }
  return errCount;
}

/**
 * 登録画面で送信ボタンが押されたら各種バリデーションを検査し問題なければ送信し、
 *   問題があれば 送信をキャンセルする
 * 
 * @return {boolean} 
 */ 
window.checkRegister = function() {
  
  let err = 0;

  err += validationName();
  err += validationEmail();
  err += validationPass();
  err += validationConfirmPass();

  if(err > 0) {
    return false;
  } else {
    return true;
  }
}

/**
 * ユーザ登録画面での名前のバリデーション
 * @returns {Number} errNameCount エラーの数
 */
window.validationName = function() {
  
  let errNameCount     = 0;

  //名前に対して入力必須を検査してNGなら１が返ってくる
  errNameCount += checkRequired(locale, "#name", ".err-msg-name01");
  if(errNameCount === 1) {
    //
  } else {
    errNameCount += checkMaxNumInputChar(locale, "#name", ".err-msg-name01", 20);
    errNameCount += checkMinNumInputChar(locale, "#name", ".err-msg-name01", 2);
  }

  if(errNameCount === 0) {
    removeErrmsg("#name", ".err-msg-name01");
  }

  return errNameCount;
}

/**
 * ユーザ登録画面でのメールアドレスのバリデーション
 * @returns {Number} errEmailCount エラーの数
 */
window.validationEmail = function() {
  
  let errEmailCount = 0;
  const MAX_CHAR    = 50;

  //入力必須を検査
  errEmailCount += checkRequired(locale, "#email", ".err-msg-name02");
  
  // 入力があってもメール形式ではない場合
  errEmailCount += checkEmailFormat(locale, "#email", ".err-msg-name02");
  errEmailCount += checkMaxNumInputChar(locale, "#email", ".err-msg-name02", MAX_CHAR);
    
  if(errEmailCount === 0) {
    removeErrmsg("#email", ".err-msg-name02");
  }

  return errEmailCount;
}

/**
 * ユーザ登録画面でのパスワードのバリデーションをします
 * @returns {Number} errPassCount エラーの数
 */
window.validationPass = function() {
  
  let errPassCount = 0;
  const MAX_CHAR = 20;
  const MIN_CHAR = 8;

  errPassCount += checkRequired(locale, "#password", ".err-msg-name03");
  errPassCount += checkMaxNumInputChar(locale, "#password", ".err-msg-name03", MAX_CHAR);
  errPassCount += checkMinNumInputChar(locale, "#password", ".err-msg-name03", MIN_CHAR);

  if(errPassCount === 0) {
    removeErrmsg("#password", ".err-msg-name03");
  }
  return errPassCount;
}

/**
 * ユーザ登録画面での確認パスワードのバリデーション
 * @returns {Number} errPassConfirmCount エラーの数
 */
window.validationConfirmPass = function() {
  
  let errPassConfirmCount = 0;
  const MAX_CHAR = 20;

  errPassConfirmCount += checkRequired(locale, "#password", ".err-msg-name03");
  errPassConfirmCount += checkMaxNumInputChar(locale, "#password", ".err-msg-name03", MAX_CHAR);
  errPassConfirmCount += confirmPass(locale, "#password", "#password-confirm", ".err-msg-name03");

  if(errPassConfirmCount === 0) {
    removeErrmsg("#password", ".err-msg-name03");
  }
  return errPassConfirmCount;
}

/**
 * ユーザ登録画面での確認パスワードがパスワードと一致しているか確認
 * @param {string} locale 言語設定ロケール 
 * @param {string} elementId パスワードフォームのエレメントID 
 * @param {string} confirmelementId 確認パスワードのエレメントID
 * @param {string} errMessageClass　エラー表示する場所
 * @returns {Number} errCount エラーの数
 */
function confirmPass(locale, elementId, confirmelementId, errMessageClass) {
  
  const pass        = document.querySelector(elementId);
  const confirmPass = document.querySelector(confirmelementId);
  const errMsg      = document.querySelector(errMessageClass);
  
  let errCount = 0;

  if(pass.value === confirmPass.value) {
    //
  } else {
    errCount = 1;
    if(locale === "ja") {
      errMsg.textContent = "パスワードが確認用と一致しません";
    }
    if(locale === "en") {
      errMsg.textContent = "Password does not match confirmation";
    }
    if(locale === "uk") {
      errMsg.textContent = "Пароль не відповідає підтвердженню";
    }
    // クラスを追加(フォームの枠線を赤くする)
    pass.classList.add('border-danger');
    errMsg.classList.add('alert');
    errMsg.classList.add('alert-danger');
  }
  return errCount;
}


/**
 * エラー表示を消す
 * @param {string} elementId 入力フォームのエレメントID
 * @param {string} errMsg エラー表示の場所
 */
function removeErrmsg(elementId, errMsg) {
  const TARGET  = document.querySelector(elementId);
  const ERR_MSG = document.querySelector(errMsg);
  // エラーの表示を解除
  TARGET.classList.remove('border-danger');
  ERR_MSG.textContent ='';
  ERR_MSG.classList.remove('alert');
  ERR_MSG.classList.remove('alert-danger');
}

/**
 * メールアドレスの形式かどうかチェック
 * @param {string} locale 
 * @param {string} elementId 
 * @param {string} errClass 
 * @returns 
 */
function checkEmailFormat(locale, elementId, errClass) {
  
  const EMAIL   = document.querySelector(elementId);
  const ERR_MSG = document.querySelector(errClass);
  let pattern        = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;

  let errEmailCount  = 0;

  if(!pattern.test(EMAIL.value)) {
    errEmailCount += 1;
    if(locale === "ja") {
      ERR_MSG.textContent = "メールアドレスの形式で入力してください";
    }
    if(locale === "en") {
      ERR_MSG.textContent = "Please enter in the form of an email address";
    }
    if(locale === "uk") {
      ERR_MSG.textContent = "Будь ласка, введіть у формі електронної адреси";
    }
    // クラスを追加(フォームの枠線を赤くする)
    EMAIL.classList.add('border-danger');
    ERR_MSG.classList.add('alert');
    ERR_MSG.classList.add('alert-danger');
  } 
  return errEmailCount;
}

/**
 * 出来事作成ページのバリデーション
 * @param {string} locale 言語設定ロケール
 * @returns {Number} errCount エラーの数
 */
window.eventValidation = function (locale) {
  
  // エラーメッセージを表示させる要素を取得
  const errMsgName01 = document.querySelector('.err-msg-name01');
  const errMsgName02 = document.querySelector('.err-msg-name02');
  
  let errTitleCount   = 0;
  let errContentCount = 0;
  let errCount        = 0;
 
  errTitleCount += checkRequired(locale, "#eventTitle", ".err-msg-name01");
  errTitleCount += checkMaxNumInputChar(locale, "#eventTitle", ".err-msg-name01", 15)

  errContentCount += checkRequired(locale, "#eventContent", ".err-msg-name02");
  errContentCount += checkMaxNumInputChar(locale, "#eventContent", ".err-msg-name02", 500);

  // エラーがなかったら赤枠を消す
  if(errTitleCount === 0) {
    // エラーメッセージのテキストに空文字を代入
    errMsgName01.textContent ='';
    // クラスを削除
    eventTitle.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }

  // エラーがなかったら赤枠を消す
  if(errContentCount === 0) {
    // エラーメッセージのテキストに空文字を代入
    errMsgName02.textContent ='';
    // クラスを削除
    eventContent.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
  }
  errCount = errTitleCount + errContentCount;

  if(errCount > 0) {
    return false;
  }
}


/**
 * 動的に増減する感情名フォームのバリデーション
 * @returns {Number} errCountエラーの数
 */
function checkRequiredEmotionNames() {

  const EMOTION_NAME = document.querySelectorAll('#emotion_name');
  const ERR_MSG      = document.querySelector('.err-msg-name01');
  let errCount = 0;

  // @check 共通化
  if(EMOTION_NAME[0]) {
    if(!EMOTION_NAME[0].value) {
      EMOTION_NAME[0].classList.add('border-danger');
      errCount += 1;
    } else {
      EMOTION_NAME[0].classList.remove('border-danger');
    }
  }

  if(EMOTION_NAME[1]) {
    if(!EMOTION_NAME[1].value) {
      EMOTION_NAME[1].classList.add('border-danger');
      errCount += 1;
    } else {
      EMOTION_NAME[1].classList.remove('border-danger');
    }
  }

  if(EMOTION_NAME[2]) {
    if(!EMOTION_NAME[2].value) {
      EMOTION_NAME[2].classList.add('border-danger');
      errCount += 1;
    } else {
      EMOTION_NAME[2].classList.remove('border-danger');
    }
  }

  if(errCount === 0) {
    ERR_MSG.textContent ='';
    ERR_MSG.classList.remove('alert');
    ERR_MSG.classList.remove('alert-danger');
  }

  if(errCount > 0) {
    ERR_MSG.textContent = '入力してください';
    ERR_MSG.classList.add('alert');
    ERR_MSG.classList.add('alert-danger');
  }
  return errCount;
}

// 動的に増減する感情の強さ入力フォーム必須バリデーション
function checkRequiredEmotionStrengths() {

  const emotion_strength = document.querySelectorAll('#emotion_strength');
  const errMsg           = document.querySelector('.err-msg-name02');
  let errCount = 0;

  if(emotion_strength[0]) {
    if(!emotion_strength[0].value) {
      emotion_strength[0].classList.add('border-danger');
      errCount += 1;
    } else {
      emotion_strength[0].classList.remove('border-danger');
    }
  }

  if(emotion_strength[1]) {
    if(!emotion_strength[1].value) {
      emotion_strength[1].classList.add('border-danger');
      errCount += 1;
    } else {
      emotion_strength[1].classList.remove('border-danger');
    }
  }

  if(emotion_strength[2]) {
    if(!emotion_strength[2].value) {
      emotion_strength[2].classList.add('border-danger');
      errCount += 1;
    } else {
      emotion_strength[2].classList.remove('border-danger');
    }
  }

  if(errCount === 0) {
    errMsg.textContent ='';
    errMsg.classList.remove('alert');
    errMsg.classList.remove('alert-danger');
  }

  if(errCount > 0) {
    errMsg.textContent = '入力してください';
    errMsg.classList.add('alert');
    errMsg.classList.add('alert-danger');
  }
  return errCount;
}

/**
 * 送信ボタンを押した時の3コラムバリデーション
 * 
 * @param {string} locale 言語切り替え
 */
window.threecolumnValidation = function (locale) {

  // フォームの要素を取得
  const emotion_name     = document.querySelectorAll('#emotion_name');
  const emotion_strength = document.querySelector('#emotion_strength');
  const thinking         = document.querySelector('#thinking');
  const errMsgName03     = document.querySelector('.err-msg-name03');

  let errCount                = 0;
  let errEmotionNameCount     = 0;
  let errEmotionStrengthCount = 0;
  let errThinkingCount        = 0;
  let errSum                  = 0;

  errEmotionNameCount     += checkRequiredEmotionNames();
  errEmotionNameCount     += checkMaxNumInputChar(locale, "#emotion_name", ".err-msg-name01", 15);

  errEmotionStrengthCount += checkRequiredEmotionStrengths();
  errEmotionStrengthCount += isNumber(locale, "#emotion_strength", ".err-msg-name02");

  errThinkingCount        += checkRequired(locale, "#thinking", ".err-msg-name03");
  errThinkingCount        += checkMaxNumInputChar(locale, "#thinking", ".err-msg-name03", 500);

  // エラーがあった個所へスクロール
  if(errEmotionNameCount > 0) {
    window.scrollTo({
      top: emotion_name.offsetTop,
      behavior: 'smooth'
    });
  }
  if(errEmotionStrengthCount > 0) {
    window.scrollTo({
      top: emotion_strength.offsetTop,
      behavior: 'smooth'
    });
  }

  errSum = errEmotionNameCount + errEmotionStrengthCount;

  // エラーがあった個所へスクロール
  if(errSum === 0 && errThinkingCount > 0) {
    window.scrollTo({
      top: thinking.offsetTop - 200,
      behavior: 'smooth'
    });
  }
  // エラーがないなら赤枠リセット
  if(errThinkingCount === 0) {
    errMsgName03.textContent ='';
    thinking.classList.remove('border-danger');
    errMsgName03.classList.remove('alert');
    errMsgName03.classList.remove('alert-danger');
  }

  errCount = errEmotionNameCount + errEmotionStrengthCount + errThinkingCount;

  if (errCount > 0) {
    return false;
  }
}


/**
 * 7コラムバリデーション
 * @param {string} locale 言語切り替え
 * @return {Number} errCount エラーの数
 */
 window.sevencolumnValidation = function (locale) {
  
  // フォームの要素を取得
  const BASIS_THINKING = document.querySelector('#basis_thinking');
  const OPPOSITE_FACT  = document.querySelector('#opposite_fact');
  const NEW_THINKING   = document.querySelector('#new_thinking');
  
  const NEW_EMOTION_STRENGTH_FIRST   = document.querySelector('#new_emotion_strength');
  const NEW_EMOTION_STRENGTH_SECOND  = document.querySelector('#new_emotion_strength00');
  const NEW_EMOTION_STRENGTH_THIRD   = document.querySelector('#new_emotion_strength01');
  const NEW_EMOTION_STRENGTH_FOURTH  = document.querySelector('#new_emotion_strength02');

  const ERR_MSG_FIRST  = document.querySelector('.err-msg-name01');
  const ERR_MSG_SECOND = document.querySelector('.err-msg-name02');
  const ERR_MSG_THIRD  = document.querySelector('.err-msg-name03');
  const ERR_MSG_FORTH  = document.querySelector('.err-msg-name04');

  const MAX_CHAR = 500;

  let errCount              = 0;
  let errBasisThinkingCount = 0;
  let errOppsiteFactCount   = 0;
  let errThinkingCount      = 0;
  let errNewEmotionCount01  = 0;
  let errNewEmotionCount02  = 0;
  let errNewEmotionCount03  = 0;
  let errNewEmotionCount04  = 0;
  let errNewEmotionSumCount = 0;

  errBasisThinkingCount += checkRequired(locale, "#basis_thinking", ".err-msg-name01");
  errBasisThinkingCount += checkMaxNumInputChar(locale, "#basis_thinking", ".err-msg-name01", MAX_CHAR);

  errOppsiteFactCount   += checkRequired(locale, "#opposite_fact", ".err-msg-name02");
  errOppsiteFactCount   += checkMaxNumInputChar(locale, "#opposite_fact", ".err-msg-name02", MAX_CHAR);

  errThinkingCount      += checkRequired(locale, "#new_thinking", ".err-msg-name03");
  errThinkingCount      += checkMaxNumInputChar(locale, "#new_thinking", ".err-msg-name03", MAX_CHAR);

  if(NEW_EMOTION_STRENGTH_FIRST) {
    errNewEmotionCount01 += checkRequired(locale, "#new_emotion_strength", ".err-msg-name04");
    console.log(errNewEmotionCount01);
  }
  if(NEW_EMOTION_STRENGTH_SECOND) {
    errNewEmotionCount02 += checkRequired(locale, "#new_emotion_strength00", ".err-msg-name04");
    console.log(errNewEmotionCount02);
  }
  if(NEW_EMOTION_STRENGTH_THIRD) {
    errNewEmotionCount03 += checkRequired(locale, "#new_emotion_strength01", ".err-msg-name04");
    console.log(errNewEmotionCount03);
  }
  if(NEW_EMOTION_STRENGTH_FOURTH) {
    errNewEmotionCount04 += checkRequired(locale, "#new_emotion_strength02", ".err-msg-name04");
    console.log(errNewEmotionCount04);
  }

  if(errBasisThinkingCount > 0) {
    window.scrollTo({
      top: BASIS_THINKING.offsetTop - 100,
      behavior: 'smooth'
    });
  }

  if(errOppsiteFactCount > 0 && errBasisThinkingCount === 0) {
    window.scrollTo({
      top: OPPOSITE_FACT.offsetTop - 100,
      behavior: 'smooth'
    });
  }

  if(errThinkingCount > 0 && errOppsiteFactCount === 0 && errBasisThinkingCount === 0) {
    window.scrollTo({
      top: NEW_THINKING.offsetTop - 100,
      behavior: 'smooth'
    });
  }

  // エラーがないなら赤枠リセット
  if(errBasisThinkingCount === 0) {
    ERR_MSG_FIRST.textContent ='';
    BASIS_THINKING.classList.remove('border-danger');
    ERR_MSG_FIRST.classList.remove('alert');
    ERR_MSG_FIRST.classList.remove('alert-danger');
  }
  // エラーがないなら赤枠リセット
  if(errOppsiteFactCount === 0) {
    ERR_MSG_SECOND.textContent ='';
    OPPOSITE_FACT.classList.remove('border-danger');
    ERR_MSG_SECOND.classList.remove('alert');
    ERR_MSG_SECOND.classList.remove('alert-danger');
  }
  // エラーがないなら赤枠リセット
  if(errThinkingCount === 0) {
    ERR_MSG_THIRD.textContent ='';
    NEW_THINKING.classList.remove('border-danger');
    ERR_MSG_THIRD.classList.remove('alert');
    ERR_MSG_THIRD.classList.remove('alert-danger');
  }

  // エラーがないなら赤枠リセット
  if(NEW_EMOTION_STRENGTH_FIRST) {
    if(errNewEmotionCount01 === 0) {
      (NEW_EMOTION_STRENGTH_FIRST).classList.remove('border-danger');
    }
  }
  if(NEW_EMOTION_STRENGTH_SECOND) {
    if(errNewEmotionCount02 === 0) {
      NEW_EMOTION_STRENGTH_SECOND.classList.remove('border-danger');
    }
  }
  if(NEW_EMOTION_STRENGTH_THIRD) {
    if(errNewEmotionCount03 === 0) {
      NEW_EMOTION_STRENGTH_THIRD.classList.remove('border-danger');
    }
  }
  if(NEW_EMOTION_STRENGTH_FOURTH) {
    if(errNewEmotionCount04 === 0) {
      NEW_EMOTION_STRENGTH_FOURTH.classList.remove('border-danger');
    }
  }
  
  errNewEmotionSumCount = errNewEmotionCount01 + errNewEmotionCount02 + errNewEmotionCount03 + errNewEmotionCount04;
  
  if(errNewEmotionSumCount === 0) {
    ERR_MSG_FORTH.textContent ='';
    ERR_MSG_FORTH.classList.remove('alert');
    ERR_MSG_FORTH.classList.remove('alert-danger');
  }

  errCount = errBasisThinkingCount + errOppsiteFactCount + errThinkingCount 
            + errNewEmotionCount01 + errNewEmotionCount02 + errNewEmotionCount03 + errNewEmotionCount04;
  if(errCount > 0) {
    return false;
  }
}

/**
 * 入力必須の確認
 * @param {string} locale 
 * @param {string} elementId 
 * @param {string} errMessageClass  
 * @returns {Number} errCount エラーの数
 */
 function checkRequired(locale, elementId, errMessageClass) {
  const TAGET_ELEMENT = document.querySelector(elementId);
  const ERR_MSG       = document.querySelector(errMessageClass);
  errCount = 0;
  
  if(!TAGET_ELEMENT.value) {
    // エラーメッセージのテキスト
    if(locale === "ja") {
      ERR_MSG.textContent = '入力してください';
    }
    if(locale === "en") {
      ERR_MSG.textContent = 'Please input';
    }
    if(locale === "uk") {
      ERR_MSG.textContent = 'будь ласка, введіть';
    }

    // クラスを追加(フォームの枠線を赤くする)
    TAGET_ELEMENT.classList.add('border-danger');
    ERR_MSG.classList.add('alert');
    ERR_MSG.classList.add('alert-danger');
    errCount = 1;
  }
  return errCount;
}

/**
 * 入力フォームの最大入力文字数チェックします
 * 
 * @param {locale}：言語設定ロケール
 * @param {elementId}：検査するタグ（エレメント）のID
 * @param {errMessageClass}：エラー表示するタグ、エレメントＩＤ
 * @return {errCount}：エラーの数
 */
 function checkMaxNumInputChar(locale, elementId, errMessageClass, maxNumber) {
  
  const TAGET_ELEMENT = document.querySelector(elementId);
  const ERR_MSG       = document.querySelector(errMessageClass);
  let errCount       = 0;

  if(TAGET_ELEMENT.value.length > maxNumber) {
    if(locale === "ja") {
      ERR_MSG.textContent = String(maxNumber) + "文字以内で入力してください";
    }
    if(locale === "en") {
      ERR_MSG.textContent = 'Please enter up to' + String(maxNumber) + 'characters';
    }
    if(locale === "uk") {
      ERR_MSG.textContent = 'Введіть до' + String(maxNumber) + 'символів';
    }

    // クラスを追加(フォームの枠線を赤くする)
    TAGET_ELEMENT.classList.add('border-danger');
    ERR_MSG.classList.add('alert');
    ERR_MSG.classList.add('alert-danger');
    errCount = 1;
  }
  return errCount;
}

/**
 * 入力フォームの最小入力文字数をチェックします
 * 
 * @param {string} locale 
 * @param {string} elementId 
 * @param {string} errMessageClass 
 * @param {Number} minNumber 
 * @returns {Number} errCount 
 */
function checkMinNumInputChar(locale, elementId, errMessageClass, minNumber) {
  
  const TAGET_ELEMENT = document.querySelector(elementId);
  const ERR_MSG = document.querySelector(errMessageClass);
  let errCount = 0;

  if(TAGET_ELEMENT.value.length < minNumber) {
    if(locale === "ja") {
      ERR_MSG.textContent = String(minNumber) + "文字以上で入力してください";
    }
    if(locale === "en") {
      ERR_MSG.textContent = 'Please enter at least' + String(minNumber) + 'characters';
    }
    if(locale === "uk") {
      ERR_MSG.textContent = 'Введіть принаймні один символ' + String(minNumber);
    }

    // クラスを追加(フォームの枠線を赤くする)
    TAGET_ELEMENT.classList.add('border-danger');
    ERR_MSG.classList.add('alert');
    ERR_MSG.classList.add('alert-danger');
    errCount = 1;
  }
  return errCount;
}

/**
 * 数字であるかチェックします
 * 
 * @param {string}：locale 言語設定ロケール
 * @param {string}：ecementId 検査するタグ（エレメント）のID
 * @param {string}：errMsgClass エラー表示するタグ、エレメントＩＤ
 * @return {number}：errCount エラーの数
*/
function isNumber(locale, elementId, errMsgClass) {
  const targetElement = document.querySelector(elementId);
  const errMsg        = document.querySelector(errMsgClass);
  let errCount        = 0;

  // 数字がどうかバリデーション
  if(isNaN(targetElement.value)) {
    errMsg.classList.add('form-invalid');
    
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsg.textContent = '数字を入力してください';
    }
    if(locale === "en") {
      errMsg.textContent = 'Please enter a number';
    }
    if(locale === "uk") {
      errMsg.textContent = 'Будь ласка, введіть номер';
    }

    targetElement.classList.add('border-danger');
    errMsg.classList.add('alert');
    errMsg.classList.add('alert-danger');
    errEmotionStrengthCount = 1;
  }
  return errCount;
}


