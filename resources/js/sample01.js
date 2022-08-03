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
  const tnew_thinking  = document.querySelector('#new_thinking');

  const errMsgName01 = document.querySelector('.err-msg-name01');
  const errMsgName02 = document.querySelector('.err-msg-name02');
  const errMsgName03 = document.querySelector('.err-msg-name03');

  var errCount                = 0;
  var errBasisThinkingCount   = 0;
  var errEmotionStrengthCount = 0;
  var errThinkingCount        = 0;

  var errSum                  = 0;

  errBasisThinkingCount += checkBasisThinkingRequired(locale);
  errBasisThinkingCount += checkMaxNumberBasisThinking(locale);
  
  // エラーがないなら赤枠リセット
  if(errBasisThinkingCount === 0) {
    errMsgName01.textContent ='';
    basis_thinking.classList.remove('border-danger');
    errMsgName01.classList.remove('alert');
    errMsgName01.classList.remove('alert-danger');
  }

  errCount = errBasisThinkingCount;
  if(errCount > 0) {
    return false;
  }
}

/**
 * 根拠の入力必須をチェック
 * 
 * @param {*} locale 
 * @return　int errBasisThinking エラーの数
*/
function checkBasisThinkingRequired(locale) {
  const basis_thinking      = document.querySelector('#basis_thinking');
  const errMsgName01        = document.querySelector('.err-msg-name01');
  var errBasisThinkingCount = 0;
 // 自動思考の入力必須バリデーション
  if(!basis_thinking.value) {
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
    basis_thinking.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errBasisThinkingCount = 1;
  }
  return errBasisThinkingCount;
}

/**
 * 自動思考の最大入力文字数チェック
 * 
 * @param {*} locale 
 * @returns 
*/
function checkMaxNumberBasisThinking(locale) {
  const basis_thinking = document.querySelector('#thinking');
  const errMsgName01   = document.querySelector('.err-msg-name01');
  var errBasisThinkingCount = 0;
  
  // 自動思考の入力最大文字数バリデーション
  if(basis_thinking.value.length > 500) {
    errMsgName01.classList.add('form-invalid');

    // エラーメッセージのテキスト
    if(locale === "ja") {
      errMsgName01.textContent = '500文字以内で入力してください';
    }
    if(locale === "en") {
      errMsgName01.textContent = 'Please enter up to 500 characters';
    }
    if(locale === "uk") {
      errMsgName01.textContent = 'Введіть до 500 символів';
    }

    // クラスを追加(フォームの枠線を赤くする)
    basis_thinking.classList.add('border-danger');
    errMsgName01.classList.add('alert');
    errMsgName01.classList.add('alert-danger');
    errBasisThinkingCount = 1;
  }
  return errBasisThinkingCount;
}
