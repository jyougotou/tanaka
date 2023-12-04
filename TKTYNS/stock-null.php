<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stock-null.css">
    <title>Document</title>
</head>
<body>
<p>申し訳ございません。</p>
    <p>ただいま在庫がございません。</p>
    <form action = "product.php" method = "post">
        <input type = "submit" class = "button" value = "商品検索画面へ">
    </form>
</body>
</html>
    
<?php require 'footer.php'; ?>