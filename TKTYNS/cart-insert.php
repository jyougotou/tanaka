<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart-insert.css">
    <title>カート</title>
</head>
<body>
<?php
    echo '<h1>カートに入っている商品</h1>';
    if(!empty($_POST['shohin_number']) and !empty($_SESSION['Member']['member_number'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from Cart where shohin_number=? and member_number=?');
        $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        //すでにカートにある商品かの判定
        if(empty($sql->fetchAll())){
            $sql=$pdo->prepare('insert into Cart values (?,?,1)');
            $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
            echo '<p>商品をカートに追加しました</p>';
        }else{
            //在庫より多く入っていないかの判定
            $sql=$pdo->prepare('select *
                                from Cart inner join Stock on Cart.shohin_number = Stock.shohin_number
                                where Cart.member_number=? and Cart.shohin_number=?');
            $sql->execute([$_SESSION['Member']['member_number'],$_POST['shohin_number']]);
            foreach( $sql as $row ) {
                $cartnum = $row['cart_kazu'];
                $stocknum = $row['stock_kazu'];
            }
            if($cartnum >= $stocknum){
                if($row['stock_kazu'] === 0){
                    $sql=$pdo->prepare('delete from Cart where shohin_number=? and member_number=?');
                    $sql->execute([$row['shohin_number'],$_SESSION['Member']['member_number']]);
                    echo '<p>商品番号',$row['shohin_number'],'の在庫がなくなったためカートから削除しました</p>';
                }else{
                    $sql=$pdo->prepare('update Cart set cart_kazu=? where shohin_number=? and member_number=?');
                    $sql->execute([$stocknum,$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
                    echo '<p>在庫の上限に達しました</p>';
                }
            }else{
                $sql=$pdo->prepare('update Cart set cart_kazu=cart_kazu+1 where shohin_number=? and member_number=?');
                $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
                echo '<p>数量を増やしました</p>';
            }
        }
    }
    require 'cart.php';
?>
</body>
</html>

<?php require 'footer.php'; ?>