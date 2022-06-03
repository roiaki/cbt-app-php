// 削除確認 froms[0] ?
function confirmDelete() {
  if (window.confirm('本当に削除してもよろしいでしょうか?')) {
    document.forms[0].submit();
  } else {
    return false;
  }
}

//setTimeout関数でfadeOut()の実行を遅延させる

setTimeout(function() {s}, 9000);

var s = $('#flash').fadeOut(2000, function() {
  $(this).remove();
});

