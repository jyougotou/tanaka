<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart-reduce.css">
    <title>カート</title>
</head>
<body>
<?php
    echo '<h1>カートに入っている商品</h1>';
    if(!empty($_POST['shohin_number']) and !empty($_SESSION['Member']['member_number'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from Cart where shohin_number=? and member_number=?');
        $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        foreach( $sql as $row ){
            if( $row['cart_kazu'] > 1 ){
                $sql=$pdo->prepare('update Cart set cart_kazu=cart_kazu-1 where shohin_number=? and member_number=?');
                $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
                echo '<p>数量を減らしました</p>';
            }else{
                echo '<p>商品を削除する場合は削除ボタンを押下してください</p>';
            }
        }
    }
    require 'cart.php';
?>
</body>
</html>

<?php require 'footer.php'; ?>