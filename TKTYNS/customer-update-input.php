<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customer-update-input.css">
    <title>ユーザー更新</title>
</head>
<body>
    <?php
        if(isset($_SESSION['Member'])){
            $member_number=$_SESSION['Member']['member_number'];
            $member_mei=$_SESSION['Member']['member_mei'];
            $member_stay=$_SESSION['Member']['member_stay'];
            $member_fon=$_SESSION['Member']['member_fon'];
            $member_pass=$_SESSION['Member']['member_pass'];
            //商品画面に遷移する
            echo '<h1>情報更新会員登録</h1>';
            echo '<form action = "product.php" method = "post">';
                echo '<input type = "submit" class = "back-btn" value = "戻る">';
            echo '</form>';
            //会員情報更新画面に遷移する
            echo '<form action = "customer-update-input.php" method = "post">';
                echo '<table>';
                    //requiredで未入力項目の摘出,ユーザー情報の更新
                    echo '<tr><td class = "form-label">ユーザー名</td><td>';
                    echo '<input type="text" required name="member_mei" class = "form-input" value="', $member_mei, '">';
                    echo '</td></tr>';
                    echo '<tr><td class = "form-label">住所</td><td>';
                    echo '<input type="text" required name="member_stay" class = "form-input" value="', $member_stay, '">';
                    echo '</td></tr>';
                    echo '<tr><td class = "form-label">電話番号</td><td>';
                    echo '<input type="text" required name="member_fon" class = "form-input" value="', $member_fon, '">';
                    echo '</td></tr>';
                    echo '<tr><td class = "form-label">パスワード</td><td>';
                    echo '<input type="password" required name="member_pass" class = "form-input" value="', $member_pass, '">';
                    echo '</td></tr>';
                echo '</table>';
                echo '<input type = "submit" class = "submit-btn" value = "更新">';
            echo '</form>';

            //form受け取り後処理
            if(!empty($_POST['member_mei'])){
                $pdo=new PDO($connect,USER,PASS);
                //ユーザー名の確認
                $sql=$pdo->prepare('select * from Member where member_number!=? and member_mei=?');
                $sql->execute([$member_number,$_POST['member_mei']]);
                if(empty($sql->fetchAll())){
                    //電話番号の確認1
                    if(preg_match( '/^0[0-9]{9,10}\z/', $_POST['member_fon'] )){
                        //電話番号の確認2
                        $sql=$pdo->prepare('select * from Member where member_number!=? and member_fon=?');
                        $sql->execute([$member_number,$_POST['member_fon']]);
                        if(empty($sql->fetchAll())){
                            $sql=$pdo->prepare('update Member set member_mei=?, member_stay=?,'.
                                        'member_fon=?, member_pass=? where member_number=?');
                            $sql->execute([
                                $_POST['member_mei'], $_POST['member_stay'],
                                $_POST['member_fon'], password_hash($_POST['member_pass'],PASSWORD_DEFAULT), $member_number]);
                            $_SESSION['Member']=[
                                'member_number'=>$member_number, 'member_mei'=>$_POST['member_mei'],
                                'member_stay'=>$_POST['member_stay'],'member_fon'=>$_POST['member_fon'],
                                'member_pass'=>$_POST['member_pass']];
                            echo <<<EOF
                            <script>
                                location.href='customer-update-output.php';
                            </script>
                            EOF;
                        }else{
                            //エラー処理
                            echo '<p>この電話番号は既に登録されてあります。</p>';
                        }
                    }else{
                        //エラー処理
                        echo '<p>電話番号を正しく入力してください。</p>';
                    }
                }else{
                    //エラー処理
                    echo '<p>このユーザー名は既に登録されてあります。</p>';
                }
            }
        }else{
            echo '<p>ユーザー更新を行うにはログインが必要です';
        }
    ?>
<?php require 'footer.php'; ?>