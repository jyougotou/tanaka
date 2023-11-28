<<<<<<< HEAD
<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
=======
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login-input.css">
    <style>
        /* Add this style to increase the size of the text boxes */
        input[type="text"], input[type="password"] {
            width: 300px; /* Adjust the width as needed */
            padding: 8px; /* Adjust the padding as needed */
        }
    </style>
<<<<<<< HEAD
    <title>ログイン画面</title>
=======
    <title>Document</title>
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
</head>
<body>
    <?php require 'header.php';?>
    <h1>ASOスポーツ用品サイト</h1>
<<<<<<< HEAD
    <!-- ログイン画面に遷移するフォームなど... -->
<<<<<<< HEAD
    <form action="login-input.php" method="post">
=======
    <form action="login-output.php" method="post">
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
=======
    
    <!-- ログイン画面に遷移するフォームなど... -->
    <form action="login-output.php" method="post">
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
        <div class="form-group">
            <label for="member_mei" class="loginname">ログイン名</label>
            <input type="text" id="member_mei" name="member_mei" required><br>
        </div>
<<<<<<< HEAD
=======
        
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
        <div class="form-group">
            <label for="member_pass" class="passname">パスワード</label>
            <input type="password" id="member_pass" name="member_pass" required><br>
        </div>
<<<<<<< HEAD
        <input type="submit" class="login" value="ログイン">
    </form>
=======
        
        <input type="submit" class="login" value="ログイン">
    </form>

>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
    <form action="customer-insert-input.php" method="post">
        <p class="hajimete">初めての方はこちらから</p>
        <input type="submit" class="newmember" value="新規会員登録">
    </form>
<<<<<<< HEAD
<<<<<<< HEAD

    <?php
        if(!empty($_POST['member_mei'])){
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from Member where member_mei=?');
            $sql->execute([$_POST['member_mei']]);
            foreach($sql as $row){
                if(password_verify($_POST['member_pass'],$row['member_pass']) == true){
                    $_SESSION['Member']=[
                        'member_number'=>$row['member_number'],
                        'member_mei'=>$row['member_mei'],
                        'member_stay'=>$row['member_stay'],
                        'member_fon'=>$row['member_fon'],
                        'member_pass'=>$_POST['member_pass']
                    ];
                    
                    echo <<<EOF
                    <script>
                        location.href='product.php';
                    </script>
                    EOF;

                }else{
                    echo 'ログイン名またはパスワードが違います。';
                }
            }
        }
    ?>

<?php require 'footer.php'; ?>
=======
=======
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
    
    <?php require 'footer.php'; ?>
</body>
</html>
<<<<<<< HEAD
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
=======
>>>>>>> d6631cb854ab352f60bca56715af9e0198929d5d
