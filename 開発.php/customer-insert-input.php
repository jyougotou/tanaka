<?php session_start(); ?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<link rel="stylesheet" href="css/customer-insert-input.css">
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
//ログイン画面に遷移する
echo '<h1>会員登録画面</h1>';

//ユーザー登録に遷移する
echo '<form action = "customer-insert-output.php" method = "post">';
echo '<table>';
//requiredで未入力項目の摘出,ユーザー情報の登録
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
echo '<input type = "submit" class = "submit-btn" value = "登録">';
echo '</form>';
echo '<form action = "login-input.php" method = "post">';
echo '<input type = "submit" class = "back-btn" value = "戻る">';
echo '</form>';
?>
</body>
</html>

<?php require 'footer.php'; ?>