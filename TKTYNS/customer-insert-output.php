<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/customer-insert-output.css">
    <title>会員登録</title>
</head>
<body>
<?php
$pdo=new PDO($connect,USER,PASS);
//ユーザー名の確認
$sql=$pdo->prepare('select * from Member where member_mei=?');
$sql->execute([$_POST['member_mei']]);
if(empty($sql->fetchAll())){
    //電話番号の確認1
    if(preg_match( '/^0[0-9]{9,10}\z/', $_POST['member_fon'] )){
        //電話番号の確認2
        $sql=$pdo->prepare('select * from Member where member_fon=?');
        $sql->execute([$_POST['member_fon']]);
        if(empty($sql->fetchAll())){
            $sql=$pdo->prepare('insert into Member values(null,?,?,?,?)');
            $sql->execute([
                $_POST['member_mei'],$_POST['member_stay'],
                $_POST['member_fon'],password_hash($_POST['member_pass'],PASSWORD_DEFAULT)]);
            echo '<p>会員登録が完了しました。</p>';
            //ログイン画面に遷移する
            echo '<form action = "login-input.php" method = "post">';
            echo '<input type= "submit" class = "form-btn" value = "ログイン画面">';
            echo '</form>';
        }else{
            //エラー処理
            echo '<p>この電話番号は既に登録されてあります。</p>';
            echo '<form action = "customer-insert-input.php" methods = "post">';
            echo '<input type= "submit" class = "form-back" value = "戻る">';
            echo '</form>';
        }
    }else{
        //エラー処理
        echo '<p>電話番号を正しく入力してください。</p>';
        echo '<form action = "customer-insert-input.php" methods = "post">';
        echo '<input type= "submit" class = "form-back" value = "戻る">';
        echo '</form>';
    }
}else{
    //エラー処理
    echo '<p>このユーザー名は既に登録されてあります。</p>';
    echo '<form action = "customer-insert-input.php" methods = "post">';
    echo '<input type= "submit" class = "form-back" value = "戻る">';
    echo '</form>';
}
?>
</body>
</html>

<?php require 'footer.php'; ?>