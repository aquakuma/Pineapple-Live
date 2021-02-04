<?php

function connect()
{
    //データベース接続
    include("../db/pineapple.php");
    return new PDO(DSN, DB_USER, DB_PASSWORD);
}

function img_tag($img_id)
{
    return '<img src="'.$img_id.'" alt="">';
}
