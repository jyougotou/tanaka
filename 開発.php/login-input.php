    <?php require 'header.php';?>
    <h1>ASOスポーツ用品サイト</h1>
    <!--会員登録画面に遷移する-->
    <form action = "customer-insert-input.php" method = "post">
        <p>初めての方はこちらから</p>
            <input type = "submit" value = "新規会員登録">
    </form>
    <!--ログイン画面に遷移する-->
    <form action = "login-output.php" method = "post">
        ログイン名<input type = "text" name = "member_mei" required><br>
        パスワード<input type = "password" name = "member_pass" required><br>    
    <input type = "submit" value = "ログイン">
    </form>
<?php require 'footer.php'; ?>