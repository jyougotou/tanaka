<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>

<!--商品画面に遷移する-->
<div style="display:inline-flex">
    <form action="product.php" method="post">
        商品検索
        <input type="text" name="keyword" value="<?php echo $_POST['keyword']; ?>">
        <input type="submit" value="🔎">
    </form>
    <!--ログイン画面に遷移する-->
    <form action="login-input.php" method="post">
        <input type="submit" value="ログイン">
    </form>
    <!--会員情報更新画面に遷移する-->
    <form action="customer-update-input.php" method="post">
        <input type="submit" value="ユーザー情報の更新">
    </form>
    <!--カート画面に遷移する-->
    <form action="cart.php" method="post">
        <input type="submit" value="🛒">
    </form>
</div>

<hr>

<?php
//競技
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select distinct shohin_sport from Detail');
$sql->execute();
echo '<select id="sport">';
foreach($sql as $row){
    echo '<option value="',$row['shohin_sport'],'">',$row['shohin_sport'],'</option>';
}
echo "</select>";
//ブランド
$sql=$pdo->prepare('select distinct shohin_burnd from Detail');
$sql->execute();
echo '<select id="burnd">';
foreach($sql as $row){
    echo '<option value="',$row['shohin_burnd'],'">',$row['shohin_burnd'],'</option>';
}
echo "</select>";
//
//ログアウトに遷移
echo '<form action = "logout-input.php" method = "post">';
    echo '<input type = "submit" value = "ログアウト">';
echo '</form>';
echo '<table>';
echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>';
if(isset($_POST['keyword'])){
    $sql=$pdo->prepare('select * from Shohin where shohin_mei like ?');
    $sql->execute(['%'.$_POST['keyword'].'%']);
}else{
    $sql=$pdo->query('select * from Shohin');
}
foreach($sql as $row){
    $id=$row['shohin_number'];
    echo '<tr>';
    echo '<td>',$id,'</td>';
    echo '<td>';
    echo '<a href="detail.php?id=',$id,'">','<img src="',$row['shohin_gazo'],'" alt="商品画像"','</a>';
    echo '</td>';
    echo '<td>',$row[''],'</td>';
    echo '</tr>';
}
echo '</table>';
?>
<?php require 'footer.php'; ?>