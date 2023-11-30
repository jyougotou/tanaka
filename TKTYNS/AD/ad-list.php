<?php

// 必要なライブラリを読み込む
require_once 'dbconnect.php';

// セッションを開始する
session_start();

// 更新対象のレコードのIDを取得する
$id = $_SESSION['id'];

// 更新対象のレコードを取得する
$sql = "SELECT * FROM products WHERE id = {$id}";
$result = $conn->query($sql);

// 更新対象のレコードのデータを取得する
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_name = $row['product_name'];
    $stock = $row['stock'];
    $price = $row['price'];
    $brand_name = $row['brand_name'];
    $genre = $row['genre'];
    $image = $row['image'];
} else {
    // 更新対象のレコードが存在しない場合
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新画面</title>
</head>
<body>

  <h1>更新画面</h1>

  <form action="update.php" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <th>商品名</th>
        <td><input type="text" name="product_name" value="<?php echo $product_name; ?>"></td>
      </tr>
      <tr>
        <th>在庫</th>
        <td><input type="number" name="stock" value="<?php echo $stock; ?>"></td>
      </tr>
      <tr>
        <th>値段</th>
        <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
      </tr>
      <tr>
        <th>ブランド名</th>
        <td><input type="text" name="brand_name" value="<?php echo $brand_name; ?>"></td>
      </tr>
      <tr>
        <th>ジャンル</th>
        <td><input type="text" name="genre" value="<?php echo $genre; ?>"></td>
      </tr>
      <tr>
        <th>画像</th>
        <td>
          <input type="file" name="image">
          <?php if ($image) { ?>
            <img src="<?php echo $image; ?>" width="100px">
          <?php } ?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" value="更新"></td>
      </tr>
        <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
            <th>価格</th>
        </tr>
<?php
$pdo = new PDO($connect, USER, PASS);
foreach ($pdo->query('SELECT * FROM Shohin') as $row) {
    echo '<tr>';
    echo '<td>', $row['shohin_number'], '</td>';
    echo '<td>', $row['shohin_mei'], '</td>';
    echo '<td>', $row['shohin_setu'], '</td>';
    echo '<td>', $row['shohin_price'], '</td>';
    echo '<td>';
    echo '<a href="ad-Deletion Completed.php?id=', $row['shohin_number'], '">削除</a>';
    echo '<a href="ad-update.php?id=', $row['shohin_number'], '">更新</a>';
    echo '</td>';
    echo '</tr>';
    echo "\n";
}
echo '<a href="ad-registration.php">商品登録</a>';
?>
    </table>

    <?php if (empty($product_name) || empty($stock) || empty($price) || empty($brand_name) || empty($genre)) { ?>
      <p class="error">未入力項目があります。</p>
    <?php } ?>

    <p><a href="index.php">戻る</a></p>

  </form>
  </body>
</html>