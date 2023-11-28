<?php session_start(); ?>
<?php require 'header.php'; ?>
<<<<<<< HEAD
<<<<<<< HEAD
<?php require 'db-connect.php'; ?>
<?php
    if(!empty($_POST['shohin_number']) and !empty($_SESSION['Member']['member_number'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from Cart where shohin_number=? and member_number=?');
        $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        //レコードがない場合
        if(empty($sql->fetchAll())){
            $sql=$pdo->prepare('insert into Cart values (?,?,1)');
            $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        //レコードがある場合
        }else{
            $sql=$pdo->prepare('update Cart set cart_kazu=cart_kazu+1 where shohin_number=? and member_number=?');
            $sql->execute([$_POST['shohin_number'],$_SESSION['Member']['member_number']]);
        }
    }

    require 'cart.php';

=======
=======
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
<?php
$id = $_POST['shohin_number'];
if(!isset($_SESSION['Detail'])){
    $_SESSION['Detail'] = [];
}
$count = 0;
if(isset($_SESSION['Detail'][$id])){
    $count = $_SESSION['Detail'][$id]['count'];
}
$_SESSION['Detail'][$id] = [
    'shohin_number' => $_POST['shohin_number'],
    'shohin_price' => $_POST['shohin_price'],
    'count' => $count + $_POST['count']
];
echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
require 'cart.php';
<<<<<<< HEAD
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
=======
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
?>
<?php require 'footer.php'; ?>