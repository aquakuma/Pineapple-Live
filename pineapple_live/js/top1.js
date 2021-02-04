//トップページ　配信中ライブ
function now_live() {
	

	$.ajax({
		url:'./top_process.php', //送信先
		type:'POST', //送信方法
		datatype: 'json', //受け取りデータの種類
        data:{
            'mode': "live"
        }


	})
	// Ajax通信が成功した時
	.done( function(data) {
		
		//console.log('通信成功');
		console.log(data);
		// now_live 要素IDを取得する
		var live_waku = document.getElementById("now_live");
        while (live_waku.querySelector('div')) {
            live_waku.querySelector('div').remove();
		}
		
		if (typeof data.live_id != 'undefined') {
			for(let i = 0; i < Object.keys(data.live_id).length;i++){
				// aタグを作成する
				var live = document.createElement("div");
				var live_page = document.createElement("a");
				live_page.href = 'live?live_id=' + data.live_id[i];
				live_page.textContent = data.live_title[i];
	
	
				var thumbnail = document.createElement("img");
				thumbnail.src = data.thumbnail[i];
				var thumbnail_link = document.createElement("a");
				thumbnail_link.href = 'live?live_id=' + data.live_id[i];
				thumbnail_link.appendChild(thumbnail);
				live.appendChild(thumbnail_link);
				live.appendChild(live_page);
				live_waku.appendChild(live);
				console.log(Object.keys(data.live_id).length);
				//document.write(date[i]+" ("+week[i]+")");
			}
		}

		
		console.log(data);
	})
	// Ajax通信が失敗した時
	.fail( function(data) {
		console.log('通信失敗');
		console.log(data);
	})

}
 
window.addEventListener('load', now_live);
