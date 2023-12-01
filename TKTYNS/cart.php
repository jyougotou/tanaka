<?php
if(!empty($_SESSION['Member'])){
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * 
                        from Shohin inner join Cart on Shohin.shohin_number = Cart.shohin_number
                        where member_number=?');
    $sql->execute([$_SESSION['Member']['member_number']]);
    if(!empty($sql->fetchAll())){
        echo '<table>';
        echo '<tr><th>商品名</th><th>数量</th>';
        echo '<th>+</th><th>-</th><th>商品説明</th><th>削除ボタン</th></tr>';
        $total = 0;
        //カートに商品の表示
        foreach( $sql as $row ){
            echo '<tr>';
            echo '<td>', $row['shohin_mei'] , '</td>';
            echo '<td>', $row['cart_kazu'] ,'</td>';
            echo '<td>'
                echo '<form action="cart-insert.php" method="post">';
                    echo '<input type="submit" value="+">';
                echo '</form>';
            echo '</td>';
            echo '<td>';
                echo '<form action="cart-delete1.php" method="post">';
                    echo '<input type="submit" value="-">';
                echo '</form>';
            echo '</td>'; 
            echo '<td>', $row['shohin_setu'] , '</td>';
            echo '<td>';
                echo '<form action="cart-delete2.php" method="post">';
                    echo '<input type="submit" value="削除">';
                echo '</form>';
            echo '</td>'; 
            echo '</tr>';
        }
        echo '<tr><td>合計</td><td></td><td></td><td></td><td>', $total,
            '</td><td></td></tr>';
        echo '</table>';
        echo '<form action = "product.php" method = "post">';
        echo '<input type = "submit" value = "戻る">';
        echo '</form>';
        echo '<form action = ".php" method = "post">';
        echo '<input type = "submit" value = "購入に進む">';
        echo '</form>';
    }else{
        //カートに商品がない場合
        echo 'カートに商品がありません';
    }
}else{
    //ログインしていない場合
    echo 'ログインしてください。';
}
echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" value = "戻る">';
echo '</form>';
?>