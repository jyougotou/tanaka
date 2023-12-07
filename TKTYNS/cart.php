<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
    <title>Cart</title>
</head>
<style>
     .total {
            background-color: #9d9b9b;
            position: absolute;
            position: fixed;
            bottom: 25px;
            border: 3px solid black;
            margin-left: 20px;
            padding: 15px 15px; /* サイズを大きく調整 */
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
        }
</style>
<body>
 
<?php
if(!empty($_SESSION['Member'])){
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select *
                        from Shohin inner join Cart on Shohin.shohin_number = Cart.shohin_number
                        where Cart.member_number=?');
    $sql->execute([$_SESSION['Member']['member_number']]);
    if(!empty($sql->fetchAll())){
        echo '<table>';
        echo '<tr class="header-row"><th class="product-name">商品名</th><th class="quantity">数量</th>';
        echo '<th class="plus-button">+</th><th class="minus-button">-</th><th class="product-description">商品説明</th><th class="delete-button">削除ボタン</th></tr>';
       
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
                    echo '<input type="submit" class="plus" value="+">';
                echo '</form>';
            echo '</td>';
            echo '<td>';
                echo '<form action="cart-reduce.php" method="post">';
                echo '<input type="hidden" name="shohin_number" value="', $row['shohin_number'], '">';
                echo '<input type="submit" class="minus" value="-">';
                echo '</form>';
            echo '</td>';
            echo '<td>', $row['shohin_setu'] , '</td>';
            echo '<td>';
                echo '<form action="cart-delete.php" method="post">';
                    echo '<input type="hidden" name="shohin_number" value="', $row['shohin_number'], '">';
                    echo '<input type="submit" class="productdelete" value="削除">';
                echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
 
echo '<div class="total-section">';
echo '届け先住所：',$_SESSION['Member']['member_stay'],'<br>';
echo '購入者情報：',$_SESSION['Member']['member_mei'],'様 ',$_SESSION['Member']['member_fon'],' ','<p class="total">合計料金',$total,'円</p>';
echo '</div>';
 
        echo '<form action = "purchase.php" method = "post">';
            echo '<input type = "submit" class="buy" value = "購入に進む">';
        echo '</form>';
    }else{
        //カートに商品がない場合
        echo '<div class="message">カートに商品がありません</div>';
    }
}else{
    //ログインしていない場合
    echo '<div class="message">ログインしてください。</div>';
}
 
echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" class="back" value = "戻る">';
echo '</form>';
 
?>
</body>
</html>
