<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * 
                    from Shohin inner join Stock on Shohin.shohin_number = Stock.shohin_number inner join Detail on Stock.shohin_number = Detail.shohin_number
                    where Shohin.shohin_number = ?');
$sql->execute([$_GET['id']]);
foreach($sql as $row){
    //商品の表示
    echo '<img src="image/',$row['shohin_gazo'],'" alt="商品画像" width="100" height="100">';
    echo '<form action="cart-insert.php" method="post">';
    echo '<p>価格:',$row['shohin_price'],'</p>';
    echo '<p>商品名:',$row['shohin_mei'],'</p>';
    echo '<p>商品説明:',$row['shohin_setu'],'</p>';
    echo '<p>在庫数:',$row['stock_kazu'],'<p>';
    echo '<p><input type="submit" value="カートに入れる🛒">';
    echo '</form>';
    echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" value = "戻る">';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>