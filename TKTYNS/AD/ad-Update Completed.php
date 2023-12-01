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
		<title></title>
	</head>
	<body>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update product set name=?,price=? where id=?');
    if (empty($_POST['name'])) {
        echo '商品名を入力してください。';
    } else
    if (!preg_match('/[0-9]+/', $_POST['price'])) {
        echo '商品価格を整数で入力してください。';
    } else

    if($sql->execute([htmlspecialchars($_POST['name']),$_POST['price'],$_POST['id']])){
        // var_dump($sql);
        echo '更新に成功しました。';
    }else{
        echo '更新に失敗しました。';
    }
    
?>
        <hr>
        <table>
        <tr><th>商品名</th><th>商品説明</th><th>在庫</th><th>値段</th><th>ブランド名</th><th>カテゴリー</th><th>画像</th></tr>
    </tr>
    <?php
     $sql=$pdo->prepare('select * from Shohin where shohin_number=?');
     $sql->execute([$_GET['id']]);
     foreach($sql as $row){
        echo '<tr>';
        echo '<td><input type = "text" name = "shohin_mei" value = "', $row['shohin_mei'], '"></td>';
        echo '<td><input type = "text" name = "shohin_setu" value = "', $row['shohin_setu'], '"></td>';
        echo '<td><input type = "text" name = "shohin_kazu" value = "', $row['shohin_kazu'], '"></td>';
        echo '<td><input type = "text" name = "shohin_price" value = "', $row['shohin_price'], '"></td>';
        echo '<td><input type = "text" name = "shohin_burnd" value = "', $row['shohin_burnd'], '"></td>';
        echo '<td><input type = "text" name = "shohin_kate" value = "', $row['shohin_kate'], '"></td>';
        echo '<td><input type = "text" name = "shohin_gazo" value = "', $row['shohin_gazo'], '"></td>';
        echo '</tr>';
     }
    ?>


        </table>
        <button onclick="location.href='ren6-6-input.php'">更新画面へ戻る</button>
    </body>
</html>