<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customer-update-output.css">
    <title>Document</title>
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
    if(isset($_SESSION['Member'])){
        $sql=$pdo->prepare('update Member set member_mei=?, member_stay=?,'.
                            'member_fon=?, member_pass=? where member_number=?');
        $sql->execute([
            $_POST['member_mei'], $_POST['member_stay'],
            $_POST['member_fon'], password_hash($_POST['member_pass'],PASSWORD_DEFAULT), $member_number]);
        $_SESSION['Member']=[
            'member_number'=>$member_number, 'member_mei'=>$_POST['member_mei'],
            'member_stay'=>$_POST['member_stay'],'member_fon'=>$_POST['member_fon'],
            'member_pass'=>$_POST['member_pass']];
        echo '<p>更新が完了しました。</p>';
        //商品検索画面に遷移する
        echo '<form action = "product.php" method = "post">';
        echo '<input type= "submit" class = "form-btn" value = "検索画面へ">';
        echo '</form>';
    } else {
        //入力内容に誤りがある場合の処理
        echo '<p>入力内容に誤りがあります。または、すでに使われています。</p>';
        echo '<form action = "customer-update-input.php methods = "post">';
        echo '<input type= "submit" class = "form-back" value = "戻る">';
        echo '</form>';
    }
}
?>
</body>
</html>

<?php require 'footer.php'; ?>