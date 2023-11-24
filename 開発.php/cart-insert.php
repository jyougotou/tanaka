<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
echo '<p>カートに入っている商品</p>';
if(!empty($_POST['shohin_number'])){
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('insert into Cart values (?,?,?)');
    $sql->execute([$_POST['shohin_number'],$_POST['']]);
}
?>
<?php require 'footer.php'; ?>