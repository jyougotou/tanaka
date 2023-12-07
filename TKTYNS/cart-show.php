<?php 
      session_start();
      require 'db-connect.php';
      require 'header.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/cart-show.css">
      <title>カート</title>
</head>
<body>

<?php
      echo '<h1>カートに入っている商品</h1>';
      require 'cart.php';
?>

<?php require 'footer.php'; ?>