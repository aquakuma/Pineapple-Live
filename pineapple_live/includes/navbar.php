</head>
<body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><img src="./images/pineapple_white.png" alt="mian_logo" style="width:25px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="main_product">商品一覧</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="live_all">ライブ一覧</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="video_all">動画一覧</a>
      </li>
    </ul>

    <a class="btn btn-link" href="cart"><i class="fa fa-shopping-cart fa-2x mr-4" style="color:white"></i></a>
    <!-- Default dropstart button -->
    <div class="btn-group dropstart">
      <i class="fa fa-user-circle fa-2x" style="color:white" data-bs-toggle="dropdown" aria-expanded="false"></i>
      <ul class="dropdown-menu">
          <small><a class="dropdown-item" href="mypage">マイページ</a></small>
          <small><a class="dropdown-item" href="live_admin">ライブ管理</a></small>
          <small><a class="dropdown-item" href="index_kanri">商品管理</a></small>
          <small><a class="dropdown-item border-bottom" href="video_admin">動画管理</a></small>
          <?php 
                if(isset($_SESSION['user_id'])){
                    echo '<small><a class="dropdown-item mt-2" href="logout">ログアウト</a></small>';
                }
                else{
                    echo '<small><a class="dropdown-item mt-2" href="login">ログイン</a></small>';
                }
          ?>
          
      </ul>
    </div>
  </div>
</nav>

<div class="row" style="margin-top: -20px;">
  <nav class="d-flex justify-content-evenly border-bottom mb-4">
      <a href="main_product?category_id=1"><button class="btn btn-sm btn-link " type="button" >ファッション</button></a>
      <a href="main_product?category_id=2"><button class="btn btn-sm btn-link border-left" type="button">ビューティー</button></a>
      <a href="main_product?category_id=3"><button class="btn btn-sm btn-link border-left" type="button">スポーツ・アウトドア</button></a>
      <a href="main_product?category_id=4"><button class="btn btn-sm btn-link border-left" type="button">家電・カメラ・AV機器</button></a>
      <a href="main_product?category_id=5"><button class="btn btn-sm btn-link border-left" type="button">パソコン・周辺機器</button></a>
      <a href="main_product?category_id=6"><button class="btn btn-sm btn-link border-left" type="button" >DVD・楽器・ゲーム</button></a>
      <a href="main_product?category_id=7"><button class="btn btn-sm btn-link border-left" type="button" >本・コミック・雑誌</button></a>
      <a href="main_product?category_id=8"><button class="btn btn-sm btn-link border-left" type="button" >キッチン・ホーム</button></a>
      <a href="main_product?category_id=9"><button class="btn btn-sm btn-link border-left" type="button" >食品・飲料</button></a>
      <a href="main_product?category_id=10"><button class="btn btn-sm btn-link border-left" type="button" >ベビー・おもちゃ</button></a>
      <a href="main_product?category_id=11"><button class="btn btn-sm btn-link border-left" type="button" >その他</button></a>
  </nav>
</div>
<div id = "inner">