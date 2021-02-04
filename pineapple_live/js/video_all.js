function video() {
	$.ajax({
		url:'./top_process.php', //送信先
		type:'POST', //送信方法
		datatype: 'json', //受け取りデータの種類
        data:{
            'mode': "video_all"
        }


	})
	// Ajax通信が成功した時
	.done( function(data) {
		
		//console.log('通信成功');
		//console.log(data);
		// now_live 要素IDを取得する
		var video_waku = document.getElementById("video_all");
		while (video_waku.querySelector('div')) {
            video_waku.querySelector('div').remove();
		}
		
		for(var key in data){
            // aタグを作成する
			var div1 = document.createElement("div");
			div1.classList.add('col-md-3');
			var div2 = document.createElement("div");
			div2.classList.add('card','mb-5','shadow-sm');

			var img = document.createElement("img");
			//img.style.width = "253px";
			//img.style.height = "200px";
			img.style.objectFit = "cover";
			img.src = data[key]['thumbnail'];
			div2.appendChild(img);
			div2.style.height = "350px";
			var div3 = document.createElement("div");
			div3.classList.add('card-body');
			var p = document.createElement("p");
			p.classList.add('card-text','fw-bolder');

			var a = document.createElement("a");
			a.href = 'video?video_id=' + data[key]['video_id'];
			a.text = data[key]['video_title'];
			p.appendChild(a);
			div3.appendChild(p);

			var div4 = document.createElement("div");
			div4.classList.add('d-flex','justify-content-start','align-items-center');
			var img = document.createElement("img");
			img.classList.add('rounded-circle', 'float-left');
			img.src = data[key]['user_icon'];
			img.style.width = "60px";
			img.style.height = "60px";
			img.style.objectFit = "cover";
			div4.appendChild(img);

			var div5 = document.createElement("div");
			div5.classList.add('d-flex','align-items-start','flex-column','ml-3');
			var small = document.createElement("small");
			small.classList.add('text-center', 'text-muted');
			small.textContent = data[key]['user_name'];
			div5.appendChild(small);
			var small = document.createElement("small");
			small.classList.add('text-muted');
			small.textContent = data[key]['upload_date'];
			div5.appendChild(small);
			div4.appendChild(div5);
			div3.appendChild(div4);
			div2.appendChild(div3);
			div1.appendChild(div2);
			video_waku.appendChild(div1);

		}

		console.log(data);

	})
	// Ajax通信が失敗した時
	.fail( function(data) {
		console.log('通信失敗');
		console.log(data);
	})
}


window.addEventListener('DOMContentLoaded', video);