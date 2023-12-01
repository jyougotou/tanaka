<?php 
    session_start();
    require 'db-connect.php';
    require 'header.php';

    //購入する商品の在庫確認
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select *
                        from Cart inner join Stock on Cart.shohin_number = Stock.shohin_number
                        where Cart.member_number=?');
    $sql->execute([$_SESSION['Member']['member_number']]);
    $flg = false;
    foreach( $sql as $row ) {
        if($row['cart_kazu'] > $row['stock_kazu']){
            $flg = true;
            $sql=$pdo->prepare('update Cart set cart_kazu=? where shohin_number=? and member_number=?');
            $sql->execute([$row['stock_kazu'],$row['shohin_number'],$_SESSION['Member']['member_number']]);
        }
    }
    if($flg){
        echo '在庫が足りない商品がありました。申し訳ありませんがカート確認画面からやり直してください。';
        echo '<form action = "cart-show.php" method = "post">';
            echo '<input type = "submit" value = "カート確認画面へ">';
        echo '</form>';
    }else{
        //購入処理
        $sql=$pdo->prepare('select *
                            from Cart inner join Stock on Cart.shohin_number = Stock.shohin_number
                            where Cart.member_number=?');
        $sql->execute([$_SESSION['Member']['member_number']]);
        foreach( $sql as $row ) {
            //購入数増やす
            $sql=$pdo->prepare('update Stock set konyu_kazu=konyu_kazu+? where shohin_number=?');
            $sql->execute([$row['cart_kazu'],$row['shohin_number']]);
            //在庫数減らす
            $sql=$pdo->prepare('update Stock set stock_kazu=stock_kazu-? where shohin_number=?');
            $sql->execute([$row['cart_kazu'],$row['shohin_number']]);
        }
        //カートリセット
        $sql=$pdo->prepare('delete from Cart where member_number=?');
        $sql->execute([$_SESSION['Member']['member_number']]);
        echo '注文が完了しました。<br>';
        echo 'またのご利用をお待ちしております!';
        echo '<form action = "product.php" method = "post">';
            echo '<input type = "submit" value = "商品検索画面へ">';
        echo '</form>';
    }
    require 'footer.php';
?>