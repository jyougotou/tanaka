<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
//$pdo=new PDO('mysql:host=mysql215.phy.lolipop.lan;dbname=LAA1516820-shop;charset=utf8',
//'LAA1516820', 'Pass0830');
$pdo=new PDO($connect,USER,PASS);

if(isset($_SESSION['customer'])){
    $id=$_SESSION['customer']['id'];
    $sql=$pdo->prepare('select * from customer where id!=? and login=?');
    $sql->execute([$id, $_POST['login']]);
}else{
    $sql=$pdo->prepare('select * from customer where login=?');
    $sql->execute([$_POST['login']]);
}
if(empty($sql->fetchAll())){
    isset($_SESSION['customer'])
        $sql=$pdo->prepare('update customer set name=?, address=?,'.
                            'login=?, password=? where id=?');
        $sql->execute([
            $_POST['name'], $_POST['address'],
            $_POST['login'], $_POST['password'], $id]);
        $_SESSION['customer']=[
            'id'=>$id, 'name'=>$_POST['name'],
            'address'=>$_POST[ 'address'],'login'=>$_POST['login'],
            'password'=>$_POST['password']];
        echo '更新が完了しました。';
        echo '<form action = "customer-insert-output.php methods = "post">';
        echo '<input type= "submit" value = "検索画面へ">';
        echo '</form>';
} else {
    echo '入力内容に誤りがあります';
    echo '<form action = "customer-update-input.php methods = "post">';
    echo '<input type= "submit" value = "戻る">';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>