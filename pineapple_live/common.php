<?php
session_start();

function connect()
{
    //データベース接続
    return new PDO("mysql:dbname=hew2_pineapple", "root");
}

function img_tag($product_id)
{
    // filesから $product_id番目のファイルを探してくる
    if (file_exists("files/products/$product_id.jpg")) $name = $product_id;
    //画像なかったら
    else $name = 'noimage';
    return '<img src="files/products/' . $name . '.jpg" alt="">';
}
// return '<img src="files/products/' . $name . '.jpg" alt="" style="width:120px; height:80px>';
