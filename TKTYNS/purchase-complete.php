<?php 
    session_start();
    require 'db-connect.php';
    require 'header.php';
    echo '注文が完了しました。<br>';
    echo 'またのご利用をお待ちしております!';
    echo '<form action = "product.php" method = "post">';
        echo '<input type = "submit" value = "商品検索画面へ">';
    echo '</form>';
    require 'footer.php';
?>