<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);

if(isset($_SESSION['Member'])){
    $member_number=$_SESSION['Member']['member_number'];
    $sql=$pdo->prepare('select * from Member where member_number!=? and member_mei=?');
    $sql->execute([$id, $_POST['member_mei']]);
}else{
    $sql=$pdo->prepare('select * from Member where member_mei=?');
    $sql->execute([$_POST['member_mei']]);
}
if(empty($sql->fetchAll())){
        $sql=$pdo->prepare('insert into Member values(null,?,?,?,?)');
        $sql->execute([
            $_POST['member_mei'],$_POST['member_stay'],
            $_POST['member_fon'],$_POST['member_pass']]);
        echo '会員登録が完了しまいした。';
        //ログイン画面に遷移する
        echo '<form action = "login-input.php" method = "post">';
        echo '<input type= "submit" value = "ログイン画面へ">';
        echo '</form>';
} else {
    //入力内容に誤りがある場合の処理
    echo '入力内容に誤りがあります。';
    echo '<form action = "customer-insert-input.php" methods = "post">';
    echo '<input type= "submit" value = "戻る">';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>