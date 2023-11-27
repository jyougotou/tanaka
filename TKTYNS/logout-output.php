<?php session_start(); ?>
    <?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logout-output.css">
    <title>Document</title>
</head>
<body>

            <?php
            //ログアウト処理の実行
            unset($_SESSION['customer']);
                echo '<h1> ログアウトしました。</h1>';
                echo '<p> またのご利用お待ちしております。</p>';
                //ログイン画面に遷移する
                echo '<form action = "login-input.php" methods = "post">';
                echo '<input type = "submit" class="login" value = "ログイン画面へ">';
                echo '</form>';
            ?>
            <?php require 'footer.php'; ?>
        </body>
    </html>
