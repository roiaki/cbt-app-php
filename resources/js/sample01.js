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
 * タイトルの入力必須をチェック
 * 
 * @param {*} locale 
 * @returns int errTitleCount 
*/
function checkTitleRequired(locale) {
 
  const eventTitle   = document.querySelector('#eventTitle');
  const errMsgName01 = document.querySelector('.err-msg-name01');
  
  var errTitleCount  = 0;

  if(!eventTitle.value) {
    // クラスを追加(エラーメッセージを表示する)
    errMsgName01.classList.add('form-invalid');
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName01.textContent = '入力してください';
    }
    if(locale === "en") {
      errMsgName01.textContent = 'Please input';
    }
    if(locale === "uk") {
      errMsgName01.textContent = 'будь ласка, введіть';
    }
    
    // クラスを追加(フォームの枠線を赤くする)
    eventTitle.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errTitleCount = 1;
  }
  return errTitleCount;
}

/**
 * タイトルの最大文字数をチェック
 * 
 * @param  locale 
 * @return int errTitleCount
 */
function checkTitleMaxNumber(locale) {
  const eventTitle    = document.querySelector('#eventTitle');
  const errMsgName01  = document.querySelector('.err-msg-name01');
  
  var errTitleCount   = 0;

  if(eventTitle.value.length >30) {
    errMsgName01.classList.add('form-invalid');
    
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName01.textContent = '30文字以内で入力してください';
    }
    if(locale === "en") {
      errMsgName01.textContent = 'Please enter up to 30 characters';
    }
    if(locale === "uk") {
      errMsgName01.textContent = 'Введіть до 30 символів';
    }

    // クラスを追加(フォームの枠線を赤くする)
    eventTitle.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errTitleCount = 1;
  }
  return errTitleCount;
}

/**
 * 内容の入力必須をチェック
 * 
 * @param {} locale 
 * @return
 */
function checkContentRequired(locale) {
  const eventContent = document.querySelector('#eventContent');
  const errMsgName02 = document.querySelector('.err-msg-name02');

  var errContentCount = 0;

 if(!eventContent.value) {
  // クラスを追加(エラーメッセージを表示する)
  errMsgName02.classList.add('form-invalid');
  
  // エラーメッセージのテキスト
  if(locale === "ja") {
    errMsgName02.textContent = '入力してください';
  }
  if(locale === "en") {
    errMsgName02.textContent = 'Please input';
  }
  if(locale === "uk") {
    errMsgName02.textContent = 'будь ласка, введіть';
  }
  // クラスを追加(フォームの枠線を赤くする)
  eventContent.classList.add('border-danger');
  errMsgName02.classList.add('alert');
  errMsgName02.classList.add('alert-danger');
  errContentCount = 1;
  }
  return errContentCount;
}

/**
 * 内容の最大文字数をチェック
 * 
 * @param {*} locale 
 * @return
 */
function checkContentMaxNumber(locale) {
  
  const eventContent = document.querySelector('#eventContent');
  const errMsgName02 = document.querySelector('.err-msg-name02');

  var errContentCount = 0;

  if(eventContent.value.length > 500) {
    errMsgName02.classList.add('form-invalid');
    
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName02.textContent = '500文字以内で入力してください';
    }
    if(locale === "en") {
      errMsgName02.textContent = 'Please enter up to 500 characters';
    }
    if(locale === "uk") {
      errMsgName02.textContent = 'Введіть до 500 символів';
    }

    // クラスを追加(フォームの枠線を赤くする)
    eventContent.classList.add('border-danger');
    errMsgName02.classList.add('alert');
    errMsgName02.classList.add('alert-danger');
    errContentCount = 1;
  } 
  return errContentCount;
}

// 出来事バリデーション
window.eventValidation = function (locale) {
  
  // エラーメッセージを表示させる要素を取得
  const errMsgName01 = document.querySelector('.err-msg-name01');
  const errMsgName02 = document.querySelector('.err-msg-name02');
  var errTitleCount   = 0;
  var errContentCount = 0;
  var errCount        = 0;
 
  errTitleCount += checkTitleRequired(locale);
  errTitleCount += checkTitleMaxNumber(locale);

  errContentCount += checkContentRequired(locale);
  errContentCount += checkContentMaxNumber(locale);


  if(errTitleCount === 0) {
    // エラーメッセージのテキストに空文字を代入
    errMsgName01.textContent ='';
    // クラスを削除
    eventTitle.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }

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
 * 3コラムの感情名の入力必須チェック
 * 
 * @param {} locale 
 * @returns 
 */
function checkEmotionNameRequired(locale) {
  const emotion_name = document.querySelector('#emotion_name_def');
  const errMsgName01 = document.querySelector('.err-msg-name01');
  var errEmotionNameCount = 0;
  
  // 感情名入力必須バリデーション
  if(!emotion_name.value) {
    errMsgName01.classList.add('form-invalid');
    
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName01.textContent = '入力してください';
    }
    if(locale === "en") {
      errMsgName01.textContent = 'Please input';
    }
    if(locale === "uk") {
      errMsgName01.textContent = 'будь ласка, введіть';
    }

    // クラスを追加(フォームの枠線を赤くする)
    emotion_name.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errEmotionNameCount = 1;
  }
  return errEmotionNameCount;
}

/**
 * 感情名の最大入力文字数
 * 
 * @param {} locale 
 * @returns 
 */
function checkEmotionNameMaxNumber(locale) {
  const emotion_name = document.querySelector('#emotion_name_def');
  const errMsgName01 = document.querySelector('.err-msg-name01');
  var errEmotionNameCount = 0;

  // 感情名の入力最大文字数バリデーション
  if(emotion_name.value.length > 15) {
    errMsgName01.classList.add('form-invalid');
  
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName01.textContent = '15文字以内で入力してください';
    }
    if(locale === "en") {
      errMsgName01.textContent = 'Please enter up to 15 characters';
    }
    if(locale === "uk") {
      errMsgName01.textContent = 'Введіть до 15 символів';
    }

    // クラスを追加(フォームの枠線を赤くする)
    emotion_name.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errEmotionNameCount = 1;
  }
  return errEmotionNameCount;
}

/**
 * 感情の強さ入力必須
 * @param {*} locale 
 * @returns 
*/
function checkEmotionStrenghtRequired(locale) {
  // フォームの要素を取得 
  const emotion_strength = document.querySelector('#emotion_strength_def');
  const errMsgName02 = document.querySelector('.err-msg-name02');

  var errEmotionStrengthCount = 0;

  // 感情の強さ入力必須バリデーション
  if(!emotion_strength.value) {
    errMsgName02.classList.add('form-invalid');
    
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName02.textContent = '入力してください';
    }
    if(locale === "en") {
      errMsgName02.textContent = 'Please input';
    }
    if(locale === "uk") {
      errMsgName02.textContent = 'будь ласка, введіть';
  }

  // クラスを追加(フォームの枠線を赤くする)
  emotion_strength.classList.add('border-danger');
  errMsgName02.classList.add('alert');
  errMsgName02.classList.add('alert-danger');
  errEmotionStrengthCount = 1;
  }
  return errEmotionStrengthCount;
}

/**
 * 感情の強さが数字かチェック
 * 
 * @param {*} locale 
 * @returns 
*/
function isNumberEmotionStrength(locale) {
  const emotion_strength = document.querySelector('#emotion_strength_def');
  const errMsgName02     = document.querySelector('.err-msg-name02');
  var errEmotionStrengthCount = 0;

  // 数字がどうかバリデーション
  if(isNaN(emotion_strength.value)) {
    errMsgName02.classList.add('form-invalid');
    
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName02.textContent = '数字を入力してください';
    }
    if(locale === "en") {
      errMsgName02.textContent = 'Please enter a number';
    }
    if(locale === "uk") {
      errMsgName02.textContent = 'Будь ласка, введіть номер';
    }

    emotion_strength.classList.add('border-danger');
    errMsgName02.classList.add('alert');
    errMsgName02.classList.add('alert-danger');
    errEmotionStrengthCount = 1;
  }
  return errEmotionStrengthCount;
}

/**
 * 自動思考の入力必須チェック
 * @param {*} locale 
 * @returns 
*/
function checkThinkingRequired(locale) {
  const thinking       = document.querySelector('#thinking');
  const errMsgName03   = document.querySelector('.err-msg-name03');
  var errThinkingCount = 0;
  // 自動思考の入力必須バリデーション
  if(!thinking.value) {
    errMsgName03.classList.add('form-invalid');
  
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName03.textContent = '入力してください';
    }
    if(locale === "en") {
      errMsgName03.textContent = 'Please input';
    }
    if(locale === "uk") {
      errMsgName03.textContent = 'будь ласка, введіть';
    }

    // クラスを追加(フォームの枠線を赤くする)
    thinking.classList.add('border-danger');
    errMsgName03.classList.add('alert');
    errMsgName03.classList.add('alert-danger');
    errThinkingCount = 1;
  }
  return errThinkingCount;
}


/**
 * 自動思考の最大入力文字数チェック
 * 
 * @param {*} locale 
 * @returns 
*/
function checkMaxNumberThinking(locale) {
  const thinking         = document.querySelector('#thinking');
  const errMsgName03 = document.querySelector('.err-msg-name03');
  var errThinkingCount        = 0;
  
  // 自動思考の入力最大文字数バリデーション
  if(thinking.value.length > 500) {
    errMsgName03.classList.add('form-invalid');

    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName03.textContent = '500文字以内で入力してください';
    }
    if(locale === "en") {
      errMsgName03.textContent = 'Please enter up to 500 characters';
    }
    if(locale === "uk") {
      errMsgName03.textContent = 'Введіть до 500 символів';
    }

    // クラスを追加(フォームの枠線を赤くする)
    thinking.classList.add('border-danger');
    errMsgName03.classList.add('alert');
    errMsgName03.classList.add('alert-danger');
    errThinkingCount = 1;
  }
  return errThinkingCount;
}

/**
 * 3コラムバリデーション
 * @param locale 言語切り替え
 */
window.threecolumnValidation = function (locale) {
  console.log(locale);

  // フォームの要素を取得
  const emotion_name     = document.querySelector('#emotion_name_def');
  const emotion_strength = document.querySelector('#emotion_strength_def');
  const thinking         = document.querySelector('#thinking');

  const errMsgName01 = document.querySelector('.err-msg-name01');
  const errMsgName02 = document.querySelector('.err-msg-name02');
  const errMsgName03 = document.querySelector('.err-msg-name03');

  var errCount                = 0;
  var errEmotionNameCount     = 0;
  var errEmotionStrengthCount = 0;
  var errThinkingCount        = 0;

  var errSum                  = 0;

  errEmotionNameCount     += checkEmotionNameRequired(locale);
  errEmotionNameCount     += checkEmotionNameMaxNumber(locale);
  errEmotionStrengthCount += checkEmotionStrenghtRequired(locale);
  errEmotionStrengthCount += isNumberEmotionStrength(locale);
  errThinkingCount        += checkThinkingRequired(locale);
  errThinkingCount        += checkMaxNumberThinking(locale);

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

  if(errSum === 0 && errThinkingCount > 0) {
    window.scrollTo({
      top: thinking.offsetTop - 200,
      behavior: 'smooth'
    });
  }

  // エラーがないなら赤枠リセット
  if(errEmotionNameCount === 0) {
    errMsgName01.textContent ='';
    emotion_name.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }

  // エラーがないなら赤枠リセット
  if(errEmotionStrengthCount === 0) {
    errMsgName02.textContent ='';
    emotion_strength.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
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
 * @param locale 言語切り替え
 */
 window.sevencolumnValidation = function (locale) {
  // フォームの要素を取得
  const basis_thinking = document.querySelector('#basis_thinking');
  const opposite_fact  = document.querySelector('#opposite_fact');
  const new_thinking   = document.querySelector('#new_thinking');
  
  const new_emotion_strength01   = document.querySelector('#new_emotion_strength');
  const new_emotion_strength02   = document.querySelector('#new_emotion_strength00');
  const new_emotion_strength03   = document.querySelector('#new_emotion_strength01');
  const new_emotion_strength04   = document.querySelector('#new_emotion_strength02');

  const errMsgName01 = document.querySelector('.err-msg-name01');
  const errMsgName02 = document.querySelector('.err-msg-name02');
  const errMsgName03 = document.querySelector('.err-msg-name03');
  const errMsgName04 = document.querySelector('.err-msg-name04');

  var errCount              = 0;
  var errBasisThinkingCount = 0;
  var errOppsiteFactCount   = 0;
  var errThinkingCount      = 0;
  var errNewEmotionCount01  = 0;
  var errNewEmotionCount02  = 0;
  var errNewEmotionCount03  = 0;
  var errNewEmotionCount04  = 0;
  var errNewEmotionSumCount = 0;

  errBasisThinkingCount += checkRequired(locale, "#basis_thinking", ".err-msg-name01");
  errBasisThinkingCount += checkMaxNumInputChar(locale, "#basis_thinking", ".err-msg-name01");

  errOppsiteFactCount   += checkRequired(locale, "#opposite_fact", ".err-msg-name02");
  errOppsiteFactCount   += checkMaxNumInputChar(locale, "#opposite_fact", ".err-msg-name02");

  errThinkingCount      += checkRequired(locale, "#new_thinking", ".err-msg-name03");
  errThinkingCount      += checkMaxNumInputChar(locale, "#new_thinking", ".err-msg-name03");

  if(new_emotion_strength01) {
    errNewEmotionCount01 += checkRequired(locale, "#new_emotion_strength", ".err-msg-name04");
    console.log(errNewEmotionCount01);
  }
  if(new_emotion_strength02) {
    errNewEmotionCount02 += checkRequired(locale, "#new_emotion_strength00", ".err-msg-name04");
    console.log(errNewEmotionCount02);
  }
  if(new_emotion_strength03) {
    errNewEmotionCount03 += checkRequired(locale, "#new_emotion_strength01", ".err-msg-name04");
    console.log(errNewEmotionCount03);
  }
  if(new_emotion_strength04) {
    errNewEmotionCount04 += checkRequired(locale, "#new_emotion_strength02", ".err-msg-name04");
    console.log(errNewEmotionCount04);
  }

  if(errBasisThinkingCount > 0) {
    window.scrollTo({
      top: basis_thinking.offsetTop - 100,
      behavior: 'smooth'
    });
  }

  if(errOppsiteFactCount > 0 && errBasisThinkingCount === 0) {
    window.scrollTo({
      top: opposite_fact.offsetTop - 100,
      behavior: 'smooth'
    });
  }

  if(errThinkingCount > 0 && errOppsiteFactCount === 0 && errBasisThinkingCount === 0) {
    window.scrollTo({
      top: new_thinking.offsetTop - 100,
      behavior: 'smooth'
    });
  }

  // エラーがないなら赤枠リセット
  if(errBasisThinkingCount === 0) {
    errMsgName01.textContent ='';
    basis_thinking.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }
  // エラーがないなら赤枠リセット
  if(errOppsiteFactCount === 0) {
    errMsgName02.textContent ='';
    opposite_fact.classList.remove('border-danger');
    errMsgName02.classList.remove('alert');
    errMsgName02.classList.remove('alert-danger');
  }
  // エラーがないなら赤枠リセット
  if(errThinkingCount === 0) {
    errMsgName03.textContent ='';
    new_thinking.classList.remove('border-danger');
    errMsgName03.classList.remove('alert');
    errMsgName03.classList.remove('alert-danger');
  }

  // エラーがないなら赤枠リセット
  if(new_emotion_strength01) {
    if(errNewEmotionCount01 === 0) {
      new_emotion_strength01.classList.remove('border-danger');
    }
  }
  if(new_emotion_strength02) {
    if(errNewEmotionCount02 === 0) {
      new_emotion_strength02.classList.remove('border-danger');
    }
  }
  if(new_emotion_strength03) {
    if(errNewEmotionCount03 === 0) {
      new_emotion_strength03.classList.remove('border-danger');
    }
  }
  if(new_emotion_strength04) {
    if(errNewEmotionCount04 === 0) {
      new_emotion_strength04.classList.remove('border-danger');
    }
  }
  
  errNewEmotionSumCount = errNewEmotionCount01 + errNewEmotionCount02 + errNewEmotionCount03 + errNewEmotionCount04;
  
  if(errNewEmotionSumCount === 0) {
    errMsgName04.textContent ='';
    errMsgName04.classList.remove('alert');
    errMsgName04.classList.remove('alert-danger');
  }

  errCount = errBasisThinkingCount + errOppsiteFactCount + errThinkingCount 
            + errNewEmotionCount01 + errNewEmotionCount02 + errNewEmotionCount03 + errNewEmotionCount04;
  if(errCount > 0) {
    return false;
  }
}

/**
 * 入力必須チェック
 * 
 * @param {string} locale 
 * @param {string} elementId 
 * @param {string} errMessageClass 
 * @returns int errCount
 */
 function checkRequired(locale, elementId, errMessageClass) {
  const tagetElement = document.querySelector(elementId);
  const errMsg       = document.querySelector(errMessageClass);
  errCount = 0;
  
  if(!tagetElement.value) {
    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsg.textContent = '入力してください';
    }
    if(locale === "en") {
      errMsg.textContent = 'Please input';
    }
    if(locale === "uk") {
      errMsg.textContent = 'будь ласка, введіть';
    }

    // クラスを追加(フォームの枠線を赤くする)
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
 function checkMaxNumInputChar(locale, elementId, errMessageClass) {
  
  const tagetElement = document.querySelector(elementId);
  const errMsg = document.querySelector(errMessageClass);
  var errCount = 0;

  if(tagetElement.value.length > 500) {
    if(locale === "ja") {
      errMsg.textContent = "500文字以内で入力してください";
    }
    if(locale === "en") {
      errMsg.textContent = 'Please enter up to 500 characters';
    }
    if(locale === "uk") {
      errMsg.textContent = 'Введіть до 500 символів';
    }

    // クラスを追加(フォームの枠線を赤くする)
    tagetElement.classList.add('border-danger');
    errMsg.classList.add('alert');
    errMsg.classList.add('alert-danger');
    errCount = 1;
  }
  return errCount;
}
