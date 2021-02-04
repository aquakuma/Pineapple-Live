//datファイルの更新
$(function () {
	//処理終了のフラグ(true)
	allowAjax = true;
	$('.btn_vote').click(function() {
		if (allowAjax) {
			//falseの間の処理
			allowAjax = false;
			$(this).toggleClass('on');
			var id = $(this).attr('id');
			$(this).hasClass('on') ? Vote(id, 'plus') : Vote(id, 'minus');
		}
	});
});

//クリックのカウント
function Vote(id, plus) {
	cls = $('.' + id);
	cls_num = Number(cls.html());
	//ボタンクリック時のカウント処理
	count = plus == 'minus' ? cls_num - 1 : cls_num + 1;
	$.post('vote.php', {'file': id, 'count': count}, function(data) {
		if (data == 'success') cls.html(count);
		setTimeout(function() {
			allowAjax = true;
		}, 400); //連打防止に0.4秒の遅延
	});
}