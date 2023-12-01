<?php 
      session_start();
      require 'db-connect.php';
      require 'header.php';
?>
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
            echo '<tr>';
            echo '<td>', $row['shohin_mei'] , '</td>';
            echo '<td>', $row['cart_kazu'] ,'</td>';
            echo '<td>', $row['shohin_setu'] , '</td>';
            echo '</tr>';
        }
        echo '</table>';

        echo '届け先住所：',$_SESSION['Member']['member_stay'],'<br>';
        echo '購入者情報：',$_SESSION['Member']['member_mei'],'様 ',$_SESSION['Member']['member_fon'],' ',$total,'円';

        echo '<form action = "purchase-complete.php" method = "post">';
            echo '<input type = "submit" value = "購入">';
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
<?php require 'footer.php'; ?>