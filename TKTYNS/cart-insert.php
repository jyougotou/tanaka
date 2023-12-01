<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
    echo '<h1>購入情報</h1>';
    if(!empty($_POST['shohin_number']) and !empty($_SESSION['Member']['member_number'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from Cart where shohin_number=? and member_number=?');
        $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        if(empty($sql->fetchAll())){
            $sql=$pdo->prepare('insert into Cart values (?,?,1)');
            $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        }else{
            $sql=$pdo->prepare('update Cart set cart_kazu=cart_kazu+1 where shohin_number=? and member_number=?');
            $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        }
        echo '数量を増やしました';
    }
    require 'cart.php';
?>
<?php require 'footer.php'; ?>