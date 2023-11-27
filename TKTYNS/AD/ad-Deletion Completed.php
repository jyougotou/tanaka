<?php
const SERVER = 'mysql218.phy.lolipop.lan';
const DBNAME = 'LAA1516810-shop';
const USER = 'LAA1516810';
const PASS = 'Pass0305';

$connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
   $pdo=new PDO($connect, USER, PASS);
   if(isset($_GET['id'])) {
       $sql=$pdo->prepare('delete from product where id=?');
       if($sql->execute([$_GET['id']])){
        echo '削除に成功しました。';
       } else {
        echo '削除に失敗しました。';
       } 
   }
   ?> 
   <br><hr><br>
   <table>
   <tr><th>商品番号</th><th>商品名</th><th>商品説明</th><th>価格</th></tr>
   <?php
    $pdo=new PDO($connect, USER, PASS);
	foreach ($pdo->query('select * from product') as $row) {
      echo '<tr>';
      echo '<td>',$row['shohin_number'] ,'</td>';
      echo '<td>',$row['shohin_mei'] ,'</td>';
      echo '<td>',$row['shphin_setu'] ,'</td>';
      echo '<td>',$row['shphin_price'] ,'</td>';
      echo '<td>',$row['shphin_gazo'] ,'</td>';

      echo '<td>';
      echo '<form method="GET" action="ad-list-output.php">';
      echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
      echo '<button type="submit">削除</button>';
      echo '</form>';
      echo '</td>';
      echo '</tr>';
      echo "\n";
    }
?>
</table>
<button onclick="location.href='ad-list.php'">削除画面へ戻る</button>
</body>
</html>