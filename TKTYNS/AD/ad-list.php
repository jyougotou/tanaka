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
    <title>Document</title>                                 
</head>
<body>
    <table>
        <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
            <th>価格</th>
            <th>商品画像</th>
        </tr>
<?php
$pdo = new PDO($connect, USER, PASS);
foreach ($pdo->query('SELECT * FROM Shohin') as $row) {
    echo '<tr>';
    echo '<td>', $row['shohin_number'], '</td>';
    echo '<td>', $row['shohin_mei'], '</td>';
    echo '<td>', $row['shohin_setu'], '</td>';
    echo '<td>', $row['shohin_price'], '</td>';
    echo '<td>', $row['shohin_gazo'], '</td>';
    echo '<td>';
    echo '<a href="ad-Deletion Completed.php?id=', $row['shohin_number'], '">削除</a>';
    echo '<a href="ad-update.php?id=', $row['shohin_number'], '">更新</a>';
    echo '</td>';
    echo '</tr>';
    echo "\n";
}
echo '<a href="ad-Registration.php?id=', $row['shohin_number'], '">商品登録</a>';
?>
    </table>
</body>
</html>