<?php
if(!empty($_SESSION['Member'])){
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select *
                        from Shohin inner join Cart on Shohin.shohin_number = Cart.shohin_number
                        where Cart.member_number=?');
    $sql->execute([$_SESSION['Member']['member_number']]);
    if(!empty($sql->fetchAll())){
        echo '<table>';
        echo '<tr><th>商品名</th><th>数量</th>';
        echo '<th>+</th><th>-</th><th>商品説明</th><th>削除ボタン</th></tr>';
        $total = 0;
        //カートに商品の表示
        $sql=$pdo->prepare('select *
                        from Shohin inner join Cart on Shohin.shohin_number = Cart.shohin_number
                        where Cart.member_number=?');
        $sql->execute([$_SESSION['Member']['member_number']]);
        $total=0;
        foreach( $sql as $row ){
            $total+=$row['shohin_price']*$row['cart_kazu'];
            echo '<tr>';
            echo '<td>', $row['shohin_mei'] , '</td>';
            echo '<td>', $row['cart_kazu'] ,'</td>';
            echo '<td>';
                echo '<form action="cart-insert.php" method="post">';
                    echo '<input type="hidden" name="shohin_number" value="', $row['shohin_number'], '">';
                    echo '<input type="submit" value="+">';
                echo '</form>';
            echo '</td>';
            echo '<td>';
                echo '<form action="cart-reduce.php" method="post">';
                echo '<input type="hidden" name="shohin_number" value="', $row['shohin_number'], '">';
                echo '<input type="submit" value="-">';
                echo '</form>';
            echo '</td>'; 
            echo '<td>', $row['shohin_setu'] , '</td>';
            echo '<td>';
                echo '<form action="cart-delete.php" method="post">';
                    echo '<input type="hidden" name="shohin_number" value="', $row['shohin_number'], '">';
                    echo '<input type="submit" value="削除">';
                echo '</form>';
            echo '</td>'; 
            echo '</tr>';
        }
        echo '</table>';

        echo '届け先住所：',$_SESSION['Member']['member_stay'],'<br>';
        echo '購入者情報：',$_SESSION['Member']['member_mei'],'様 ',$_SESSION['Member']['member_fon'],' ',$total,'円';

        echo '<form action = "purchase.php" method = "post">';
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