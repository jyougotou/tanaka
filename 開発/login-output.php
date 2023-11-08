<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
unset($_POST['customer']);
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from customer where login=? and password=?');
$sql->execute([$_POST['login'],$_POST['password']]);
foreach ($sql as $row){
    $_POST['customer']=[
        'id'=>$row['id'],'name'=>$row['name'],
        'address'=>$row['address'],'login'=>$row['login'],
        'password'=>$row['password']
    ];
}
if(isset($_POST['customer'])){
    echo 'いらっしゃいませ、',$_POST['customer']['name'],'さん。';
    echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" value = "商品画面へ">';
    echo '</form>';
}else{
    echo 'ユーザー名、パスワードが一致しません。';
    echo '<form action = "login-input.php" method = "post">';
    echo '<input type = "submit" value = "ログインへ">';
    echo '</form>';
}
?>
    <?php require 'footer.php'; ?>
