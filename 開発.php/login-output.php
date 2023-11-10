<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
unset($_SESSION['customer']);
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from customer where login=? and password=?');
$sql->execute([$_POST['login'],$_POST['password']]);
foreach ($sql as $row){
    $_SESSION['customer']=[
        'id'=>$row['id'],'name'=>$row['name'],
        'address'=>$row['address'],'login'=>$row['login'],
        'password'=>$row['password']
    ];
}
if(isset($_SESSION['customer'])){
    // ログイン処理、成功の場合
    echo 'いらっしゃいませ、',$_SESSION['customer']['name'],'さん。';
    echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" value = "商品画面へ">';
    echo '</form>';
}else{
    // ログイン処理、失敗の場合
    echo 'ユーザー名、パスワードが一致しません。';
    echo '<form action = "login-input.php" method = "post">';
    echo '<input type = "submit" value = "ログインへ">';
    echo '</form>';
}
?>
    <?php require 'footer.php'; ?>
