<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php
$name=$address=$login=$password='';

if(isset($_SESSION['customer'])){
    $name=$_SESSION['customer']['name'];
    $address=$_SESSION['customer']['address'];
    $login=$_SESSION['customer']['login'];
    $password=$_SESSION['customer']['password'];
}
//ログイン画面に遷移する
echo '<form action = "login-input.php methods = "post">';
echo '<input type = "submit" value = "戻る">';
echo '</form>';
//ユーザー登録画面、
echo '<form action = "customer-insert-output.php" method = "post">';
echo '<table>';
echo '<tr><td><h3>ユーザー名</h3></td><td>';
echo '<input type="text" name="name" value="', $name, ', required">';
echo '</td></tr>';
echo '<tr><td><h3>住所</h3></td><td>';
echo '<input type="text" name="address" value="', $address, ', required">';
echo '</td></tr>';
echo '<tr><td><h3>電話番号</h3></td><td>';
echo '<input type="text" name="login" value="', $login, ', required">';
echo '</td></tr>';
echo '<tr><td><h3>パスワード</h3></td><td>';
echo '<input type="password" name="password" value="', $password, ', required">';
echo '</td></tr>';
echo '</table>';
echo '<input type = "submit" value = "登録">';
echo '</form>';
?>
<?php require 'footer.php'; ?>