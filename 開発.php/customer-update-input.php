<?php session_start(); ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customer-update-input.css">
    <title>Document</title>
</head>
<body>
<?php
$member_mei=$member_stay=$member_fon=$member_pass='';

if(isset($_SESSION['Member'])){
    $member_mei=$_SESSION['Member']['member_mei'];
    $member_stay=$_SESSION['Member']['member_stay'];
    $member_fon=$_SESSION['Member']['member_fon'];
    $member_pass=$_SESSION['Member']['member_pass'];
}
//商品画面に遷移する
echo '<h1>情報更新会員登録</h1>'
echo '<form action = "product.php" method = "post">';
echo '<input type = "submit" value = "戻る">';
echo '</form>';
//会員情報更新画面に遷移する
echo '<form action = "customer-update-output.php" method = "post">';
echo '<table>';
//requiredで未入力項目の摘出,ユーザー情報の更新
echo '<tr><td>ユーザー名</td><td>';
echo '<input type="text" required name="member_mei" value="', $member_mei, '">';
echo '</td></tr>';
echo '<tr><td>住所</td><td>';
echo '<input type="text" required name="member_stay" value="', $member_stay, '">';
echo '</td></tr>';
echo '<tr><td>電話番号</td><td>';
echo '<input type="text" required name="member_fon" value="', $member_fon, '">';
echo '</td></tr>';
echo '<tr><td>パスワード</td><td>';
echo '<input type="password" required name="member_pass" value="', $member_pass, '">';
echo '</td></tr>';
echo '</table>';
echo '<input type = "submit" value = "更新">';
echo '</form>';
?>
</body>
</html>

<?php require 'footer.php'; ?>