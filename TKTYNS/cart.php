<?php
if(!empty($_SESSION['Shohin'])){
    echo '<table>';
    echo '<tr><th>商品番号</th><th>商品名</th>';
    echo '<th>価格</th><th>個数</th><th>小計</th><th></th></tr>';
    $total = 0;
    //カートに商品の表示
    foreach( $_SESSION['Shohin'] as $shohin_number => $Shohin){
        echo '<tr>';
        echo '<td>', $shohin_number , '</td>';
        echo '<td><a href = "detail.php?id=', $shohin_number , '">',
             $Shohin['shohin_mei'], '</a></td>';
        echo '<td>', $Shohin['shohin_price'], '</td>';
        echo '<td>', $Shohin['count'], '</td>';
        $subtotal = $Shohin['shohin_price'] * $Shohin['count'];
        $total += $subtotal;
        echo '<td>', $subtotal , '</td>';
        echo '<td><a href = "cart-delete.php?id=', $shohin_number, '">削除</a></td>';
        echo '</tr>';
    }
    echo '<tr><td>合計</td><td></td><td></td><td></td><td>', $total,
         '</td><td></td></tr>';
    echo '</table>';
    echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" value = "戻る">';
    echo '</form>';
    echo '<form action = ".php" method = "post">';
    echo '<input type = "submit" value = "購入に進む">';
    echo '</form>';
}else{
    //カートに商品がない場合
    echo 'カートに商品がありません。';
    echo '<form action = "product.php" method = "post">';
    echo '<input type = "submit" value = "戻る">';
    echo '</form>';

}

?>