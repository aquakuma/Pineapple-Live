//トップページ　配信中ライブ
function now_live() {
	

	$.ajax({
		url:'./top_process.php', //送信先
		type:'POST', //送信方法
		datatype: 'json', //受け取りデータの種類
        data:{
            'mode': "live_all"
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
			console.log(data);
			for (let i = 0; i < Object.keys(data.live_id).length; i++){
				


				var div1 = document.createElement("div");
				div1.classList.add('col-md-3');
				var div2 = document.createElement("div");
				div2.classList.add('card','mb-5','shadow-sm');
				div2.style.height = "350px";
				var img = document.createElement("img");
				//img.style.width = "250px";
				//img.style.height = "200px";
				img.style.objectFit = "cover";
				img.src = data.thumbnail[i];
				div2.appendChild(img);
				var div3 = document.createElement("div");
				div3.classList.add('card-body');
				var p = document.createElement("p");
				p.classList.add('card-text','fw-bolder');
	
				var a = document.createElement("a");
				a.href = 'live?live_id=' + data.live_id[i];
				a.text = data.live_title[i];
				p.appendChild(a);
				div3.appendChild(p);
	
				var div4 = document.createElement("div");
				div4.classList.add('d-flex','justify-content-start','align-items-center');
				var img = document.createElement("img");
				img.classList.add('rounded-circle', 'float-left');
				img.src = data.user_icon[i];
				img.style.width = "60px";
				img.style.height = "60px";
				img.style.objectFit = "cover";
				div4.appendChild(img);
	
				var div5 = document.createElement("div");
				div5.classList.add('d-flex','align-items-start','flex-column','ml-3');
				var small = document.createElement("small");
				small.classList.add('text-center', 'text-muted');
				small.textContent = data.user_name[i];
				div5.appendChild(small);
				var small = document.createElement("small");
				small.classList.add('text-muted');
				small.textContent = data.start_date[i];
				div5.appendChild(small);
				div4.appendChild(div5);
				div3.appendChild(div4);
				div2.appendChild(div3);
				div1.appendChild(div2);
				live_waku.appendChild(div1);

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


window.addEventListener('DOMContentLoaded', now_live);
