<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-input.css">
    <style>
        /* Add this style to increase the size of the text boxes */
        input[type="text"], input[type="password"] {
            width: 300px; /* Adjust the width as needed */
            padding: 8px; /* Adjust the padding as needed */
        }
    </style>
    <title>Document</title>
</head>
<body>
    <?php require 'header.php';?>
    <h1>ASOスポーツ用品サイト</h1>
    
    <!-- ログイン画面に遷移するフォームなど... -->
    <form action="login-output.php" method="post">
        <div class="form-group">
            <label for="member_mei" class="loginname">ログイン名</label>
            <input type="text" id="member_mei" name="member_mei" required><br>
        </div>
        
        <div class="form-group">
            <label for="member_pass" class="passname">パスワード</label>
            <input type="password" id="member_pass" name="member_pass" required><br>
        </div>
        
        <input type="submit" class="login" value="ログイン">
    </form>

    <form action="customer-insert-input.php" method="post">
        <p class="hajimete">初めての方はこちらから</p>
        <input type="submit" class="newmember" value="新規会員登録">
    </form>
    
    <?php require 'footer.php'; ?>
</body>
</html>
