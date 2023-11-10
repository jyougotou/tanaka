<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php
    //ログアウト処理の実行
    unset($_SESSION['customer']);
        echo '<h1>ログアウトしました。</h1>';
        echo 'またのご利用お待ちしております。';
        //ログイン画面に遷移する
        echo '<form action = "login-input.php" methods = "post">';
            echo '<input type = "submit" value = "ログイン画面へ">';
        echo '</form>';
?>
<?php require 'footer.php'; ?>