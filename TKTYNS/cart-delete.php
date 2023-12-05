<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart-delete.css">
    <title>カート</title>
</head>
<body>
<?php
    echo '<h1>カートに入っている商品</h1>';
    if(!empty($_POST['shohin_number']) and !empty($_SESSION['Member']['member_number'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('delete from Cart where shohin_number=? and member_number=?');
        $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        echo '<p>商品をカートから削除しました</p>';
    }
    require 'cart.php';
?>
</body>
</html>

<?php require 'footer.php'; ?>