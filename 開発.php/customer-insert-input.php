<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php
$member_mei=$member_stay=$member_fon=$member_pass='';

if(isset($_SESSION['Member'])){
    $member_mei=$_SESSION['Member']['member_mei'];
    $member_stay=$_SESSION['Member']['member_stay'];
    $member_fon=$_SESSION['Member']['member_fon'];
    $member_pass=$_SESSION['Member']['member_pass'];
}
//ログイン画面に遷移する
echo '<form action = "login-input.php" method = "post">';
echo '<input type = "submit" value = "戻る">';
echo '</form>';
//ユーザー登録に遷移する
echo '<form action = "customer-insert-output.php" method = "post">';
echo '<table>';
//requiredで未入力項目の摘出,ユーザー情報の登録
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
echo '<input type = "submit" value = "登録">';
echo '</form>';
?>
<?php require 'footer.php'; ?>