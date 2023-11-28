<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from Detail where shohin_number=?');
$sql->execute([$_GET['shohin_number']]);
foreach($sql as $row){
    //商品の表示
    echo '<p><img alt="image" src="image/', $row['shohin_number'], '.png"></p>';
    echo '<form action="cart-insert.php" method="post">';
    echo '<p>価格:',$row['shohin_price'],'</p>';
    echo '<p>商品名:',$row['shohin_mei'],'</p>';
    echo '<p>商品説明:',$row['shohin_setu'],'</p>';
    //入力途中
    echo '<p>在庫数<p>';

    
    echo '</select></p>';
    echo '<input type="hidden" name="shohin_number" value="', $row['shohin_number'], '">';
    echo '<input type="hidden" name="shohin_mei" value="', $row['shohin_mei'], '">';
    echo '<input type="hidden" name="shohin_price" value="', $row['shohin_price'], '">';
    echo '<p><input type="submit" value="カートに追加🛒"></p>';
    echo '</form>';
    echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" value = "戻る">';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>