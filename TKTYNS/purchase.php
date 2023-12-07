<?php 
      session_start();
      require 'db-connect.php';
      require 'header.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/purchase.css">
    <title>購入</title>
</head>
<body>
<?php
echo '<h1>購入情報</h1>';
if(!empty($_SESSION['Member'])){
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select *
                        from Shohin inner join Cart on Shohin.shohin_number = Cart.shohin_number
                        where Cart.member_number=?');
    $sql->execute([$_SESSION['Member']['member_number']]);
    if(!empty($sql->fetchAll())){
        echo '<table>';
        echo '<tr><th>商品名</th><th>数量</th>';
        echo '<th>商品説明</th></tr>';
        $total = 0;
        //カートに商品の表示
        $sql=$pdo->prepare('select *
                        from Shohin inner join Cart on Shohin.shohin_number = Cart.shohin_number
                        where Cart.member_number=?');
        $sql->execute([$_SESSION['Member']['member_number']]);
        $total=0;
        foreach( $sql as $row ){
            $total+=$row['shohin_price']*$row['cart_kazu'];
            echo '<tr class = "total-section">';
            echo '<td>', $row['shohin_mei'] , '</td>';
            echo '<td>', $row['cart_kazu'] ,'</td>';
            echo '<td>', $row['shohin_setu'] , '</td>';
            echo '</tr>';
        }
        echo '</table>';

        echo '<p class = "total-section">届け先住所：',$_SESSION['Member']['member_stay'],'</p>';
        echo '<p class = "total-section">購入者情報：',$_SESSION['Member']['member_mei'],'様 ',$_SESSION['Member']['member_fon'],' ','</p><p>合計：',$total,'円</p>';

        echo '<form action = "purchase-complete.php" method = "post">';
            echo '<input type = "submit" class = "custom-button" value = "購入">';
        echo '</form>';
    }else{
        //カートに商品がない場合
        echo '<p>カートに商品がありません</p>';
    }
}else{
    //ログインしていない場合
    echo '<p>ログインしてください。</p>';
}
echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" class = "back-button" value = "戻る">';
echo '</form>';
?>
</body>
</html>

<?php require 'footer.php'; ?>