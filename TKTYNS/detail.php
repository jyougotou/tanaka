<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/detail.css">
    <title>商品詳細</title>
</head>
<body>

<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * 
                    from Shohin inner join Stock on Shohin.shohin_number = Stock.shohin_number inner join Detail on Stock.shohin_number = Detail.shohin_number
                    where Shohin.shohin_number = ?');
$sql->execute([$_GET['id']]);
foreach($sql as $row){
    //在庫なしの処理
    if($row['stock_kazu'] <= 0) {
        echo <<<EOF
            <script>
                location.href='stock-null.php';
            </script>
            EOF;
    }
    //商品の表示
    echo '<img src="image/',$row['shohin_gazo'],'" alt="商品画像" width="100" height="100">';
    echo '<form action="cart-insert.php" method="post">';
    echo '<p class="price">価格:',$row['shohin_price'],'円</p>';
    echo '<p class="product-name">商品名:',$row['shohin_mei'],'</p>';
    echo '<p class="product-explanation">商品説明:',$row['shohin_setu'],'</p>';
    echo '<p class="stock">在庫数:',$row['stock_kazu'],'</p>';
    echo '<input type="hidden" name="shohin_number" value="', $row['shohin_number'], '">';
    echo '<input type="hidden" name="shohin_mei" value="', $row['shohin_mei'], '">';
    echo '<input type="hidden" name="shohin_price" value="', $row['shohin_price'], '">';
    if(!empty($_SESSION['Member'])){
        echo '<p><input type="submit" class="cart" value="カートに入れる🛒"></p>';
    }
    echo '</form>';
    if(empty($_SESSION['Member'])){
        echo '<form action="login-input.php" method="post">';
            echo '<p><input type="submit" class="cart" value="ログイン"></p>';
        echo '</form>';
    }
    echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" class="back" value = "戻る">';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>
</body>
</html>