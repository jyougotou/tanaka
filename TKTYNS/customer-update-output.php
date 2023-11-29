<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
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
        echo '更新が完了しました。';
        //商品検索画面に遷移する
        echo '<form action = "product.php" method = "post">';
        echo '<input type= "submit" value = "検索画面へ">';
        echo '</form>';
    } else {
        //入力内容に誤りがある場合の処理
        echo '入力内容に誤りがあります。または、すでに使われています。';
        echo '<form action = "customer-update-input.php methods = "post">';
        echo '<input type= "submit" value = "戻る">';
        echo '</form>';
    }
}
?>
<?php require 'footer.php'; ?>