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
			console.log(data);
			for (let i = 0; i < Object.keys(data.live_id).length; i++){
				
				var div1 = document.createElement("div");

				div1.classList.add('col-md-3');
				var div2 = document.createElement("div");
				div2.style.height = "350px";
				div2.classList.add('card','mb-5','shadow-sm');
	
				var img = document.createElement("img");
				//img.style.width = "253px";
				//img.style.maxHeight = "200px";
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



		/*
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
		*/
		
		console.log(data);
	})
	// Ajax通信が失敗した時
	.fail( function(data) {
		console.log('通信失敗');
		console.log(data);
	})

}
 
function new_product() {
	$.ajax({
		url:'./top_process.php', //送信先
		type:'POST', //送信方法
		datatype: 'json', //受け取りデータの種類
        data:{
            'mode': "product"
        }


	})
	// Ajax通信が成功した時
	.done( function(data) {
		
		//console.log('通信成功');
		//console.log(data);
		// now_live 要素IDを取得する




		var product_waku = document.getElementById("new_product");
		while (product_waku.querySelector('div')) {
            product_waku.querySelector('div').remove();
		}
		
		for(var key in data){
            // aタグを作成する
			var div1 = document.createElement("div");

			div1.classList.add('col-md-3');
			var div2 = document.createElement("div");
			div2.style.height = "380px";
			div2.classList.add('card','mb-5','shadow-sm');

			var img = document.createElement("img");
			//img.style.width = "253px";
			//img.style.height = "200px";
			img.style.objectFit = "cover";
			img.src = data[key]['image_id'];
			div2.appendChild(img);
			var div3 = document.createElement("div");
			div3.classList.add('card-body','d-flex','flex-column','flex-column','justify-content-center');
			var p = document.createElement("p");
			p.classList.add('card-text','fw-bolder','text-center');

			var a = document.createElement("a");
			a.href = 'product_detail?product_id=' + data[key]['product_id'];
			a.text = data[key]['product_name'];
			p.appendChild(a);
			div3.appendChild(p);


			var small = document.createElement("small");
			small.classList.add('text-center', 'h6');
			small.textContent = data[key]['product_number'];
			div3.appendChild(small);

			var small = document.createElement("small");
			small.classList.add('text-center', 'h6');
			small.textContent = '￥'+ data[key]['product_price'];
			//div4.appendChild(small);

			div3.appendChild(small);
			div2.appendChild(div3);
			div1.appendChild(div2);
			product_waku.appendChild(div1);

		}




		/*
		var product_waku = document.getElementById("new_product");
		while (product_waku.querySelector('div')) {
            product_waku.querySelector('div').remove();
		}
		console.log(data);
		for(var key in data){
            // aタグを作成する
			var good_waku = document.createElement("div");
			var good_img = document.createElement("img");
			var good_a = document.createElement("a");
			good_img.style.width = "300px";
			good_img.style.height = "auto";
			good_img.src = data[key]['image_id'];
			good_a.href = 'product_detail?product_id=' + data[key]['product_id'];
			good_a.text = data[key]['product_name']+' (￥'+ data[key]['product_price'] +')';


			good_waku.appendChild(good_a);
			good_waku.appendChild(good_img);
			product_waku.appendChild(good_waku);

            //document.write(date[i]+" ("+week[i]+")");
		}
*/
	})
	// Ajax通信が失敗した時
	.fail( function(data) {
		console.log('通信失敗');
		console.log(data);
	})
}

//video 表示処理
function new_video() {
	$.ajax({
		url:'./top_process.php', //送信先
		type:'POST', //送信方法
		datatype: 'json', //受け取りデータの種類
        data:{
            'mode': "video"
        }


	})
	// Ajax通信が成功した時
	.done( function(data) {
		
		//console.log('通信成功');
		//console.log(data);
		// now_live 要素IDを取得する




		var video_waku = document.getElementById("new_video");
		while (video_waku.querySelector('div')) {
            video_waku.querySelector('div').remove();
		}
		
		for(var key in data){
            // aタグを作成する
			var div1 = document.createElement("div");
			
			div1.classList.add('col-md-3');
			var div2 = document.createElement("div");
			div2.style.height = "350px";
			div2.classList.add('card','mb-5','shadow-sm');

			var img = document.createElement("img");
			//img.style.width = "253px";
			//img.style.height = "200px";
			img.style.objectFit = "cover";
			img.src = data[key]['thumbnail'];
			div2.appendChild(img);
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




		/*
		var video_waku = document.getElementById("new_video");
		while (video_waku.querySelector('div')) {
            video_waku.querySelector('div').remove();
		}
		
		for(var key in data){
            // aタグを作成する
			var div = document.createElement("div");
			var img = document.createElement("img");
			var a = document.createElement("a");
			img.style.width = "300px";
			img.style.height = "auto";
			img.src = data[key]['thumbnail'];
			a.href = 'video?video_id=' + data[key]['video_id'];
			a.text = data[key]['video_title']+' ('+ data[key]['user_name']+')';


			div.appendChild(a);
			div.appendChild(img);
			video_waku.appendChild(div);

            //document.write(date[i]+" ("+week[i]+")");
		}

		console.log(data);
		*/
	})
	// Ajax通信が失敗した時
	.fail( function(data) {
		console.log('通信失敗');
		console.log(data);
	})
}


window.addEventListener('DOMContentLoaded', now_live);
window.addEventListener('DOMContentLoaded', new_product);
window.addEventListener('DOMContentLoaded', new_video);