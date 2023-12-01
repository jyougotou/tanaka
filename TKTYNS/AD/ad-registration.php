<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ad-registration</title>
</head>
<body>
    <form action = "ad-Registration Completed.php" method = "post">
    <table>
        <tr><th>商品名</th><th>商品説明</th><th>値段</th><th>画像</th><th>スポーツ</th><th>ブランド名</th><th>カテゴリー</th><th>購入</th><th>在庫</th></tr>
    </tr>
    <tr>
        <td><input type = "text" name = "shohin_mei" required></td>
        <td><input type = "text" name = "shohin_setu" required></td>
        <td><input type = "text" name = "shohin_price" required></td>
        <td><input type = "text" name = "shohin_gazo" required></td>
        <td><input type = "text" name = "shohin_sport" required></td>
        <td><input type = "text" name = "shohin_burnd" required></td>
        <td><input type = "text" name = "shohin_kate" required></td>
        <td><input type = "text" name = "konyu_kazu" required></td>
        <td><input type = "text" name = "stock_kazu" required></td>
    </tr>
    </table>
            <button type = "submit">登録</button>
    </form>
    <form action = "ad-list.php" method = "post">
        <button type = "submit">戻る</button>
    </form>
</body>
</html>