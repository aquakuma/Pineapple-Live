<?php

    include('./db_connect.php');
    if(!$_SESSION['user_id']){
        header('location:login');
        exit;
    }
    
    $pdo = db_connect();

    $user_id = $_SESSION['user_id'];
    
    //SQL文作成
    $sql = "SELECT * FROM order_list l,order_detail d,products p WHERE p.product_id = d.product_id AND l.order_id = d.order_id AND p.user_id=:user_id ORDER BY l.order_id desc";
    //$sql = "SELECT * FROM order_list WHERE user_id=:user_id";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);
    //値の設定
    $prestmt->bindValue(':user_id', $user_id);
    //SQL実行
    $prestmt->execute();
    //抽出結果取得
    $order_list = $prestmt->fetchAll(PDO::FETCH_ASSOC);
    $order_list_json = json_encode($order_list);

    $product_name = array();
    $quantity = array();
    $product_price = array();
    $size = array();

    //order_id 取得
    $sql = "SELECT DISTINCT l.order_id,l.purchase_date,l.summary FROM order_list l,order_detail d,products p WHERE p.product_id = d.product_id AND l.order_id = d.order_id AND p.user_id=:user_id ORDER BY l.order_id desc";
    //$sql = "SELECT * FROM order_list WHERE user_id=:user_id";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);
    //値の設定
    $prestmt->bindValue(':user_id', $user_id);
    //SQL実行
    $prestmt->execute();
    
    $order_id = $prestmt->fetchAll(PDO::FETCH_ASSOC);

 

    //合計金額 取得
    $sql = "SELECT SUM(d.quantity*d.product_price) as summary FROM order_list l,order_detail d,products p WHERE p.product_id = d.product_id AND l.order_id = d.order_id AND p.user_id=:user_id GROUP BY l.order_id ORDER BY l.order_id desc";
    //$sql = "SELECT * FROM order_list WHERE user_id=:user_id";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);
    //値の設定
    $prestmt->bindValue(':user_id', $user_id);
    //SQL実行
    $prestmt->execute();
    
    $order_summary = $prestmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($order_summary as $key => $row){
        $order_summary[$key]['summary'] = number_format($row['summary']);
    }


    //初期化
    foreach($order_id as $row){
        $product_id[$row['order_id']] = array();
        $product_name[$row['order_id']] = array();
        $quantity[$row['order_id']] = array();
        $product_price[$row['order_id']] = array();
        $image_id[$row['order_id']] = array();
    }
    

    foreach($order_list as $row){

        if(empty($product_id[$row['order_id']])){

            
            $product_id_index = 1;
            $product_id[$row['order_id']][0] = $row['product_id'];
        }
        else{

            $product_id[$row['order_id']][$product_id_index] = $row['product_id'];
            $product_id_index++;
        }

        if(empty($product_name[$row['order_id']])){

            $product_name_index = 1;
            if($row['size'] == " "){
                $product_name[$row['order_id']][0] = $row['product_name'];
            }
            else{
                $product_name[$row['order_id']][0] = $row['product_name']."(".$row['size'].")";
            }

        }
        else{
            if($row['size'] == " "){
                $product_name[$row['order_id']][$product_name_index] = $row['product_name'];
            }
            else{
                $product_name[$row['order_id']][$product_name_index] = $row['product_name']."(".$row['size'].")";
            }

            $product_name_index++;
        }
        if(empty($quantity[$row['order_id']])){

            $quantity_index = 1;
            $quantity[$row['order_id']][0] = $row['quantity'];
        }
        else{

            $quantity[$row['order_id']][$quantity_index] = $row['quantity'];
            $quantity_index++;
        }
        if(empty($product_price[$row['order_id']])){

            $product_price_index = 1;
            $product_price[$row['order_id']][0] = number_format($row['product_price']);
        }
        else{

            $product_price[$row['order_id']][$product_price_index] = number_format($row['product_price']);
            $product_price_index++;
        }
        if(empty($image_id[$row['order_id']])){
            $image_id_index = 1;
            $image_id[$row['order_id']][0] = $row['image_id'];
        }
        else{
            $image_id[$row['order_id']][$image_id_index] = $row['image_id'];
            $image_id_index++;
        }
        
        
    }


    $product_id_json = json_encode($product_id);
    $product_name_json = json_encode($product_name);
    $quantity_json = json_encode($quantity);
    $product_price_json = json_encode($product_price);
    $order_id_json = json_encode($order_id);
    $order_summary_json = json_encode($order_summary); 
    $image_id_json = json_encode($image_id); 
?>

<script>
    console.log('in');
    function init(){
        var product_id = JSON.parse('<?php echo $product_id_json; ?>');
        var product_name = JSON.parse('<?php echo $product_name_json; ?>');
        var quantity = JSON.parse('<?php echo $quantity_json; ?>');
        var product_price = JSON.parse('<?php echo $product_price_json; ?>');
        var order_id = JSON.parse('<?php echo $order_id_json; ?>');
        var order_summary = JSON.parse('<?php echo $order_summary_json; ?>');
        var image_id = JSON.parse('<?php echo $image_id_json; ?>');
        

        var order_table = document.getElementById('order');
        while (order_table.querySelector('table')) {
            order_table.querySelector('table').remove();
        }

        console.log(product_name);

        for(var row in order_id){
            var table = document.createElement("table");
            table.classList.add('table');
            table.classList.add('my-5');
            table.classList.add('px-5');
            var thead = document.createElement("thead");

            var tr = document.createElement("tr");
            tr.classList.add("text-center");

            var th = document.createElement("th");
            th.setAttribute('scope', 'col'); 
            th.setAttribute('colspan', '2'); 
            th.textContent = "商品";
            tr.appendChild(th);

            var th = document.createElement("th");
            th.setAttribute('scope', 'col'); 
            th.textContent = "単価";
            tr.appendChild(th);

            var th = document.createElement("th");
            th.setAttribute('scope', 'col'); 
            th.textContent = "数量";
            tr.appendChild(th);
            thead.appendChild(tr);

            var tr = document.createElement("tr");
            tr.classList.add("table-secondary","text-left");

            var th = document.createElement("th");
            th.setAttribute('scope', 'col'); 
            th.setAttribute('colspan', '4'); 

            var div_pa = document.createElement("div");
            div_pa.classList.add("row");

            var div = document.createElement("div");
            div.classList.add("col-4");
            div.textContent = "注文日時："+order_id[row]['purchase_date'];
            div_pa.appendChild(div);

            var div = document.createElement("div");
            div.classList.add("col-4");
            div.textContent = "注文番号："+order_id[row]['order_id'];
            div_pa.appendChild(div);

            th.appendChild(div_pa);
            tr.appendChild(th);
            thead.appendChild(tr);
            table.appendChild(thead);


            var tbody = document.createElement("tbody");
            for(var product_row in product_name[order_id[row]['order_id']]){

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var img = document.createElement("img");
                img.setAttribute('src', image_id[order_id[row]['order_id']][product_row]); 
                td.appendChild(img);
                tr.appendChild(td);

                var td = document.createElement("td");
                td.classList.add("centered_text");
                var a = document.createElement("a");
                a.setAttribute('href', 'product_detail?product_id='+product_id[order_id[row]['order_id']][product_row]); 
                a.textContent = product_name[order_id[row]['order_id']][product_row];
                td.appendChild(a);
                tr.appendChild(td);

                var td = document.createElement("td");
                td.classList.add("centered_text");
                td.textContent = "￥"+product_price[order_id[row]['order_id']][product_row];
                tr.appendChild(td);

                var td = document.createElement("td");
                td.classList.add("centered_text");
                td.textContent = quantity[order_id[row]['order_id']][product_row];
                tr.appendChild(td);

                tbody.appendChild(tr);
            }

            var tr = document.createElement("tr");
            tr.classList.add("table-secondary");
            tr.classList.add("text-right");
            var td = document.createElement("td");
            td.setAttribute('scope', 'col'); 
            td.setAttribute('colspan', '4'); 

            var div_pa = document.createElement("div");
            div_pa.classList.add("row");

            var div = document.createElement("div");
            div.classList.add("col-12");
            div.textContent = "合計金額：￥"+order_summary[row]['summary'];
            div_pa.appendChild(div);
            td.appendChild(div_pa);
            tr.appendChild(td);
            tbody.appendChild(tr);
            table.appendChild(tbody);
            order_table.appendChild(table);
        }
        
    }

    window.addEventListener('load', init);
</script>