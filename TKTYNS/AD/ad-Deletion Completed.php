<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <?php
        unset($_SESSION['Shohin'][$_GET['shohin_number']]);
        echo '削除が完了しました。';
    ?>
<button onclick="location.href='ad-list.php'">商品一覧へ</button>
</body>
</html>