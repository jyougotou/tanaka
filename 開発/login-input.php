    <?php require 'header.php';?>
    <h1>ASOスポーツ用品サイト</h1>
    <form action = "customer-input.php" method = "post">
        <p>初めての方はこちらから</p>
            <input type = "submit" value = "新規会員登録">
    </form>
    <form action = "login-output.php" method = "post">
        ログイン名<input type = "text" name = "login"><br>
        パスワード<input type = "password" name = "password"><br>    
    <input type = "submit" value = "ログイン">
    </form>
<?php require 'footer.php'; ?>