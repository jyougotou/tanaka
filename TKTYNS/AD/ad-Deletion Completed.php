<?php session_start(); ?>
<?php
    const SERVER = 'mysql218.phy.lolipop.lan';
    const DBNAME = 'LAA1516810-aso2201157';
    const USER = 'LAA1516810';
    const PASS = 'Pass0305';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>ad-Deletion Completed</title>
	</head>
	<body>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('delete from Shohin where shohin_number=?');
    $sql->execute([$_GET['id']]);
    echo '削除が完了しました。'; 
?>
<button onclick="location.href='ad-list.php'">商品一覧へ</button>
</body>
</html>