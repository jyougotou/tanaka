<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/ad(css)/ad-registration.css">
    <title>ASOスポーツ用品サイト(管理者側)</title>
</head>
<body>
    <div class="field">
    <form action = "ad-Registration Completed.php" method = "post">
        <table>
        <tr><th>商品名</th><th>商品説明</th><th>値段</th></tr>
            <tr><td><input type = "text" name = "shohin_mei" required></td>
            <td><input type = "text" name = "shohin_setu" required></td>
            <td><input type = "text" name = "shohin_price" required></td></tr>
        </table>

        <table>
        <tr><th>画像</th><th>スポーツ</th><th>ブランド名</th></tr>
            <tr><td><input type = "text" name = "shohin_gazo" required></td>
            <td><input type = "text" name = "shohin_sport" required></td>
            <td><input type = "text" name = "shohin_burnd" required></td></tr>
        </table>
        <table>
        <tr><th>カテゴリー</th><th>購入</th><th>在庫</th></tr>
            <td><input type = "text" name = "shohin_kate" required></td>
            <td><input type = "text" name = "konyu_kazu" required></td>
            <td><input type = "text" name = "stock_kazu" required></td></tr>
        </table>
    <input type="submit" value="登録" class="to">
    </form>
    </div>
    <button onclick="history.back()" class="mo">戻る</button>
</body>
</html>