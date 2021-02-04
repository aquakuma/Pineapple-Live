
</div>
<footer class="container col-12 p-5 bg-dark text-secondary mb-0">
    <div class="row">
      <div class="col-12 col-md justify-content-center">
        <img src="./images/pineapple_white.png" alt="mian_logo" style="width:40px; margin-top: -10px; margin-bottom: 10px;">
        <small class="d-block mb-1 text-muted">&copy; Pineapple 2020</small>
        <small>write something here!write something here!write something here!write something here!write something here!write something here!</small>
      </div>
      <div class="col-3 col-md ">
        <h5>Contact</h5>
        <ul class="list-unstyled text-small">
          <small>〒160-0023<br>東京都新宿区西新宿１丁目7-3<br>総合校舎コクーンタワー</small><br>
          <small><i class="fa fa-phone"></i> XXーXXXXーXXXX</small><br>
		      <small><i class="fa fa-envelope"></i> Email: <a href="#">hellopineapple@hal.com</a></small>
        </ul>
      </div>
      <div class="col-3 col-md text-end">
        <h5>リンク</h5>
        <ul class="list-unstyled text-small">
          <small><li><a class="link-secondary" href="#">Home</a></li></small>
          <small><li><a class="link-secondary" href="#">Features</a></li></small>
          <small><li><a class="link-secondary" href="#">Team</a></li></small>
          <small><li><a class="link-secondary" href="#">Plan & Pricing</a></li></small>
          <small><li><a class="link-secondary" href="#">Shipping</a></li></small>
          <small><li><a class="link-secondary" href="#">Other</a></li></small>
        </ul>
      </div>
      <div class="col-3 col-md text-end">
        <h5>SNS</h5>
        <ul class="list-unstyled text-small">
          <small><li><a class="link-secondary" href="#"><i class="fa fa-twitter"></i> Twitter</a></li></small>
          <small><li><a class="link-secondary" href="#"><i class="fa fa-google-plus"></i> Google+</a></li></small>
          <small><li><a class="link-secondary" href="#"><i class="fa fa-instagram"></i> Instagram</a></li></small>
          <small><li><a class="link-secondary" href="#"><i class="fa fa-pinterest"></i> Pinterest</a></li></small>
          <small><li><a class="link-secondary" href="#"><i class="fa fa-snapchat"></i> Snapchat</a></li></small>
          <small><li><a class="link-secondary" href="#"><i class="fa fa-facebook"></i> Facebook</a></li></small>
        </ul>
      </div>
      </div>
    </div>
  </footer>
</body>


<script>

//フッター　動的　余白消す
function footer(){
    var inner = document.getElementById("inner");
    var style = window.getComputedStyle(inner);
    var hegiht = parseInt(style.height);

    //console.log(hegiht);
    if(hegiht<600){
        
        inner.style.paddingBottom = (600 -hegiht)+"px";
    }
    else{
        inner.style.paddingBottom = "0px";
    }

/*
    var str = window.location.href.split('/').pop();
    if(str == "index" || str == "index.php" || str == "video_all" || str == "live_all"){
        //inner.style.paddingBottom = (550 -hegiht)+"px";
    }*/
};

window.onload = setTimeout(footer, 200);


</script>