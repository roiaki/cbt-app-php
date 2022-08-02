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


