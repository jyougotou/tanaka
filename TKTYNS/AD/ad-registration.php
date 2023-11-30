<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ad-registration</title>
</head>
<body>
    <form action = "ad-Registration Completed.php" method = "post">
    <table>
        <tr><th>商品名</th><th>商品説明</th><th>値段</th><th>画像</th><th>ブランド名</th><th>カテゴリー</th><th>在庫</th></tr>
    </tr>
    <tr>
        <td><input type = "text" name = "shohin_mei"></td>
        <td><input type = "text" name = "shohin_setu"></td>
        <td><input type = "text" name = "shohin_price"></td>
        <td><input type = "text" name = "shohin_gazo"></td>
        <td><input type = "text" name = "shohin_burand"></td>
        <td><input type = "text" name = "shohin_kate"></td>
        <td><input type = "text" name = "stock_kazu"></td>
    </tr>
    </table>
            <button type = "submit">登録</button>
    </form>
    <form action = "ad-list.php" method = "post">
        <button type = "submit">戻る</button>
    </form>
</body>
</html>