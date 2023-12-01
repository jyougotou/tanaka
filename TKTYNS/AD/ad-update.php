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
		<link rel="stylesheet" href="style.css">
		<title>練習6-6-input</title>
	</head>
	<body>
    <table>
        <tr><th>商品名</th><th>商品説明</th><th>在庫</th><th>値段</th><th>ブランド名</th><th>カテゴリー</th><th>画像</th></tr>
    </tr>
    <tr>
        <td><input type = "text" name = "shohin_mei"></td>
        <td><input type = "text" name = "shohin_setu"></td>
        <td><input type = "text" name = "stock_kazu"></td>
        <td><input type = "text" name = "shohin_price"></td>
        <td><input type = "text" name = "shohin_burand"></td>
        <td><input type = "text" name = "shohin_kate"></td>
        <td><input type = "text" name = "shohin_gazo"></td>
    </tr>
    </table>
<?php
    $pdo=new PDO($connect, USER, PASS);

	foreach ($pdo->query('select * from Shohin') as $row) {
	
		//var_dump($row);

		echo '<form action="ad-Update Completed.php" method="post">';
        echo '<input type="hidden" name="shohin_number" value="',$row['shohin_number'],'">';
        echo '<div class="td0">',$row['shohin_number'],'</div>';

		echo '<div class="td1">';
        echo '<input type="text" name="shohin_mei" value="',$row['shohin_mei'],'">';

		echo '</div> ';
		echo '<div class="td1">';
        echo '<input type="text" name="shohin_setu" value="',$row['shohin_setu'],'">';
		echo '</div> ';

        
		echo '</div> ';
		echo '<div class="td1">';
        echo '<input type="text" name="shohin_price" value="',$row['shohin_price'],'">';
		echo '</div> ';

        echo '</div> ';
		echo '<div class="td1">';
        echo '<input type="text" name="shohin_gazo" value="',$row['shohin_gazo'],'">';
		echo '</div> ';

        echo '<div class="td2"><input type="submit" value="更新"></div>';
		echo '</form>';
		echo "\n";
	}
?>

    </body>
</html>