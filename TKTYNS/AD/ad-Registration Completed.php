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
    <title>ad-Registration Completed</title>
</head>
<body>
    <?php
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo->prepare('insert into Shohin(shohin_mei, shohin_setu, shohin_price, shohin_gazo) values (?, ?, ?, ?)');
        
        if(empty($_POST['shohin_mei'])){
            echo '商品名を入力してください。';
        } else if(empty($_POST['shohin_setu'])){
            echo '商品説明を入力してください';
        } else if(!preg_match('/^[0-9]+$/',$_POST['shohin_price'])){
            echo '商品価格を整数で入力してください。';
        } else if(empty($_POST['shohin_gazo'])) {
            echo '商品画像を選択してください。';
        } else if(empty($_POST['shohin_burnd'])){
            echo 'ブランド名を入力してください';
        } else if(empty($_POST['shohin_kate'])) {
            echo 'カテゴリーを入力してください。';
        } else if(!preg_match('/^[0-9]+$/',$_POST['stock_kazu'])) {
            echo '在庫数を入力してください。';
        } else {
            // ここでDetailテーブルにデータを挿入するSQLを準備
            $detailSql = $pdo->prepare('insert into Detail(shohin_burnd, shohin_kate) values (?, ?)');
            $detailSql->execute([$_POST['shohin_burnd'], $_POST['shohin_kate']]);

            // ここでStockテーブルにデータを挿入するSQLを準備
            $stockSql = $pdo->prepare('insert into Stock(stock_kazu) values (?)');
            $stockSql->execute([$_POST['stock_kazu']]);

            // 商品情報をShohinテーブルに挿入
            $sql->execute([$_POST['shohin_mei'], $_POST['shohin_setu'], $_POST['shohin_price'], $_POST['shohin_gazo']]);
            
            echo '<font color = "red">追加に成功しました。</font>';
        }
    ?>
    <br><hr><br>
    <table border="1">
        <tr>
            <th>商品名</th>
            <th>商品説明</th>
            <th>値段</th>
            <th>画像</th>
            <th>ブランド名</th>
            <th>カテゴリー</th>
            <th>在庫</th>
        </tr>
    <?php
        // Shohin, Detail, Stock テーブルを結合してデータを取得
        $result = $pdo->query('select * from Shohin, Detail, Stock');
        
        foreach ($result as $row){
            echo '<tr>';
            echo '<td>', $row['shohin_mei'], '</td>';
            echo '<td>', $row['shohin_setu'], '</td>';
            echo '<td>', $row['shohin_price'], '</td>';
            echo '<td>', $row['shohin_gazo'], '</td>';
            echo '<td>', $row['shohin_burnd'], '</td>';
            echo '<td>', $row['shohin_kate'], '</td>';
            echo '<td>', $row['stock_kazu'], '</td>';
            echo '</tr>';
            echo "\n";        
        }
    ?>
    </table>
    <form action="ad-list.php" method="post">
        <button type="submit">戻る</button>
    </form>
</body>
</html>
