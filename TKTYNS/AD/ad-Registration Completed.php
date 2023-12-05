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
    <link rel="stylesheet" href="../css/ad(css)/ad-Registration Completed.css">
    <title>ASOスポーツ用品サイト(管理者側)</title>
</head>
<body>
    <?php
    //insertで追加
                    $pdo = new PDO($connect, USER, PASS);
                    $sql = $pdo->prepare('insert into Shohin(shohin_mei, shohin_setu, shohin_price, shohin_gazo) values (?, ?, ?, ?)');
                    $sql->execute([$_POST['shohin_mei'], $_POST['shohin_setu'], $_POST['shohin_price'], $_POST['shohin_gazo']]);
                    $last = $pdo->lastInsertId();
                    $detailSql = $pdo->prepare('insert into Detail(shohin_number,shohin_sport,shohin_burnd,shohin_kate) values (?,?,?,?)');
                    $detailSql->execute([(int)$last, $_POST['shohin_sport'], $_POST['shohin_burnd'], $_POST['shohin_kate']]);
                    $stockSql = $pdo->prepare('insert into Stock(shohin_number,konyu_kazu,stock_kazu) values (?,?,?)');
                    $stockSql->execute([(int)$last,$_POST['konyu_kazu'],$_POST['stock_kazu']]);

        if(empty($_POST['shohin_mei'])){
            echo '商品名を入力してください。';
        } else if(empty($_POST['shohin_setu'])){
            echo '商品説明を入力してください。';
        } else if(!preg_match('/^[0-9]+$/',$_POST['shohin_price'])){
            echo '商品価格を整数で入力してください。';
        } else if(empty($_POST['shohin_gazo'])) {
            echo '商品画像を選択してください。';
        } else if(empty($_POST['shohin_sport'])) {
            echo 'スポーツ名を入力してください。';
        } else if(empty($_POST['shohin_burnd'])){
            echo 'ブランド名を入力してください。';
        } else if(empty($_POST['shohin_kate'])) {
            echo 'カテゴリーを入力してください。';
        } else if(!preg_match('/^[0-9]+$/',$_POST['konyu_kazu'])) {
            echo '購入数を入力してください。';
        } else if(!preg_match('/^[0-9]+$/',$_POST['stock_kazu'])) {
            echo '在庫数を入力してください。';
        } else {
            
            echo '<h1>登録が完了しました。</h1>';
        }
    ?>
    <form action="ad-registration.php" method="post">
        <input type="submit" value="商品登録へ" class="to">
    </form>
    <form action="ad-list.php" method="post">
        <input type="submit" value="商品一覧へ" class="i">
    </form>
</body>
</html>
