<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!--商品画面に遷移する-->
<!--横並びにする-->
<div style="display:inline-flex">
    <form action="product.php" method="post">
        商品検索
        <input type="text" name="keyword">
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
//プルダウン、カテゴリー
echo '<form action = "product.php" method = "post">';
    echo "<select name='kategori'>";
        echo "<option value='ball'>ボール</option>";
        echo "<option value='racket'>ラケット</option>";
        echo "<option value='uniform'>ユニフォーム</option>";
    echo "</select>";
echo "</form>";
//ログアウトに遷移
echo '<form action = "logout-input.php" method = "post">';
    echo '<input type = "submit" value = "ログアウト">';
echo '</form>';
//echo '<table>';
//echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>';
//$pdo=new PDO($connect,USER,PASS);
//if(isset($_POST['keyword'])){
//    $sql=$pdo->prepare('select * from product where name like ?');
//    $sql->execute(['%'.$_POST['keyword'].'%']);
//}else{
//    $sql=$pdo->query('select * from product');
//}
//foreach ($sql as $row){
//    $id=$row['id'];
//    echo '<tr>';
//    echo '<td>', $id, '</td>';
//    echo '<td>';
//    echo '<a href="detail.php?id=', $id, '">', $row['name'], '</a>';
//    echo '</td>';
//    echo '<td>', $row['price'], '</td>';
//    echo '</tr>';
//}
//echo '</table>';
//?>
<?php require 'footer.php'; ?>