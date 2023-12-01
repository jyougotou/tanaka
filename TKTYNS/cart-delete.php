<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
    echo '<h1>購入情報</h1>';
    if(!empty($_POST['shohin_number']) and !empty($_SESSION['Member']['member_number'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('delete from Cart where shohin_number=? and member_number=?');
        $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        echo '商品をカートから削除しました<br>';
    }
    require 'cart.php';
?>
<?php require 'footer.php'; ?>