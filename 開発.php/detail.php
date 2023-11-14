<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from Detail where shohin_number=?');
$sql->execute([$_GET['shohin_number']]);
foreach($sql as $row){
    echo '<p><img alt="image" src="image/', $row['shohin_number'], '.png"></p>';
    echo '<form action="cart-insert.php" method="post">';
    //商品の表示
    echo '<p>商品番号:',$row['shohin_number'],'</p>';
    echo '<p>商品名:',$row['shohin_mei'],'</p>';
    echo '<p>価格:',$row['shohin_price'],'</p>';
    echo '<p>個数:<select name="count">';
    for($i = 1; $i <= 10; $i++){
        echo '<option value="', $i, '">', $i, '</option>';
    }
    echo '</select></p>';
    echo '<input type="hidden" name="shohin_number" value="', $row['shohin_number'], '">';
    echo '<input type="hidden" name="shohin_mei" value="', $row['shohin_mei'], '">';
    echo '<input type="hidden" name="shohin_price" value="', $row['shohin_price'], '">';
    echo '<p><input type="submit" value="カートに追加"></p>';
    echo '</form>';
    echo '<p><a href = "favorite-insert.php?id=', $row['shohin_number'],'">お気に入りに追加</a></p>';
}
?>
<?php require 'footer.php'; ?>