
$(function () { 
    $('#greet').click(function(){
    	if(!$('#message').val()) return;
        $.get('bbs.php', {
        	user_name: $('#user_name').val(),
			message: $('#message').val(),
			user_id: $('#user_id').val(),
			live_id: $('#live_id').val(),
        	mode: "0" // 書き込み
        }, function(data){
        	$('#result').html(data);
        	 scTarget();
		});
		
		$('#message').val("");
    });
    loadLog();
	logAll();
	//scTarget();



	
});

var chat_num = 0;

// ログをロードする
function loadLog(){
	$.get('bbs.php', {
		mode: "1", // 読み込み
		live_id: $('#live_id').val()
    }, function(data){
			$('#result').html(data);
			//console.log(data.length);
			if (chat_num != data.length) {
				scTarget();
				chat_num = data.length;
			}
    });
}

// 一定間隔でログをリロードする
function logAll(){
	setTimeout(function(){
		loadLog();
		logAll();
	},5000); //リロード時間はここで調整
}

/*
 * 画面を最下部へ移動させる
 */
 function scTarget(){
	 var pos = $("#end").offset().top; 
	 //console.log(pos+200000);
 	$("#talkField").animate({ 
 		scrollTop:pos+200000
 	}, 0, "swing"); //swingで0が良さそう
 	return false;
 }

 

