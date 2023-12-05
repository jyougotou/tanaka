<?php session_start(); ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customer-update-output.css">
    <title>ユーザー更新</title>
</head>
<body>
    <h1>ユーザー更新画面</h1>
    ユーザー更新が完了しました。
    <form action = "product.php" method = "post">
        <input type = "submit" class = "back-btn" value = "商品検索画面へ">
    </form>
<?php require 'footer.php'; ?>