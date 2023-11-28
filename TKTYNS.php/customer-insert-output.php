<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/customer-insert-output.css">
    <title>detail</title>
</head>
<body>
<?php
$pdo=new PDO($connect,USER,PASS);

if(isset($_SESSION['Member'])){
    $member_number=$_SESSION['Member']['member_number'];
    $sql=$pdo->prepare('select * from Member where member_number!=? and member_mei=?');
    $sql->execute([$member_number, $_POST['member_mei']]);
}else{
    $sql=$pdo->prepare('select * from Member where member_mei=?');
    $sql->execute([$_POST['member_mei']]);
}
if(empty($sql->fetchAll())){
        $sql=$pdo->prepare('insert into Member values(null,?,?,?,?)');
        $sql->execute([
            $_POST['member_mei'],$_POST['member_stay'],
            $_POST['member_fon'],$_POST['member_pass']]);
        echo '<p>会員登録が完了しました。</p>';
        //ログイン画面に遷移する
        echo '<form action = "login-input.php" method = "post">';
        echo '<input type= "submit" class = "form-btn" value = "ログイン画面">';
        echo '</form>';
} else {
    //入力内容に誤りや、すでに使われている場合の処理
    echo '<p>入力内容に誤りがあります。</p>';
    echo '<form action = "customer-insert-input.php" methods = "post">';
    echo '<input type= "submit" class = "form-back" value = "戻る">';
    echo '</form>';
}
?>
</body>
</html>

<?php require 'footer.php'; ?>