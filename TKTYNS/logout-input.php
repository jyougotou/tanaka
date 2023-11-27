<?php require 'header.php'; ?>
<!--商品画面に遷移する-->
<form action = "product.php" method = "post">
    <input type = "submit" value = "戻る">
</form>
<!--ログアウト完了画面に遷移する-->
<form action = "logout-output.php" methods = "post">
    <h1>ログアウトしますか？</h1>
    <input type = "submit" value = "ログアウト">
<?php require 'footer.php'; ?>