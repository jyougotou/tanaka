<?php session_start(); ?>
<?php require 'header.php'; ?>
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
?>
<?php require 'footer.php'; ?>