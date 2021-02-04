<?php
    function db_connect(){
        include('../db/pineapple.php');
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        //let logo = getElementById('id');
    
        //PDOの設定変更
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $pdo->setAttribute(
            PDO::ATTR_EMULATE_PREPARES,
            false
        );
        return $pdo;
    }

    function img_tag($img_id)
    {
        return '<img src="'.$img_id.'" alt="">';
    }


?>