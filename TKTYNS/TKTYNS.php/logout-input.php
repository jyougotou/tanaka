<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logout-input.css">
    <title>Document</title>
</head>
<body>
    <?php require 'header.php'; ?>
    <!--商品画面に遷移する-->
    <form action = "product.php" method = "post">
        <input type = "submit" class="back" value = "戻る">
    </form>
    <!--ログアウト完了画面に遷移する-->
    <form action = "logout-output.php" methods = "post">
        <h1>ログアウトしますか？</h1>
        <input type = "submit" class="out" value = "ログアウト">
    <?php require 'footer.php'; ?> 
</body>
</html>
