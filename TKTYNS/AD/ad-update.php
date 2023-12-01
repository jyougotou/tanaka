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
		
	</head>
	<body>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update product set name=?,price=? where id=?');
    if (empty($_POST['shohin_mei'])) {
        echo '商品名を入力してください。';
    } else
    if (!preg_match('/[0-9]+/', $_POST['shohin_price'])) {
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
        <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
            <th>価格</th>
            <th>商品画像</th>
        </tr>

<?php
foreach ($pdo->query('select * from Shohin') as $row) {
    echo '<tr>';
    echo '<tr>';
    echo '<td>', $row['shohin_number'], '</td>';
    echo '<td>', $row['shohin_mei'], '</td>';
    echo '<td>', $row['shohin_setu'], '</td>';
    echo '<td>', $row['shohin_price'], '</td>';
    echo '<td>', $row['shohin_gazo'], '</td>';
    echo '</tr>';
    echo "\n";
}
?>
        </table>
        <button onclick="location.href='ad-update.php'">更新画面へ戻る</button>
    </body>
</html>