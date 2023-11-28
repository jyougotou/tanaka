<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ranking.css">
    <title>Document</title>
</head>
<body>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>

<h1>ジャンル別人気ランキング</h1>

<?php
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query('select distinct shohin_sport from Detail');
    echo '<form action="ranking.php" method="post">';
        echo '<select name="sport">',"\n";
            echo '<option hidden value="">スポーツ</option>';
            foreach($sql as $row){
                if($row['shohin_sport']==$_POST['sport']){
                    echo '<option value="',$row['shohin_sport'],'" selected>',$row['shohin_sport'],'</option>',"\n";
                }else{
                    echo '<option value="',$row['shohin_sport'],'">',$row['shohin_sport'],'</option>',"\n";
                }
            }
        echo '</select>',"\n";
        echo '<input type="submit" class="glass" value="🔎">';
    echo '</form>';
    $sql=$pdo->prepare('select * 
                        from Shohin inner join Stock on Shohin.shohin_number = Stock.shohin_number inner join Detail on Stock.shohin_number = Detail.shohin_number
                        where Detail.shohin_sport=?
                        order by konyu_kazu desc limit 5');
    $sql->execute([$_POST['sport']]);
    echo '<table>',"\n";
    echo  '<tr><th>順位</th><th>商品名</th><th>価格</th></tr>',"\n";
    $num=1;
    foreach($sql as $row){
        echo '<tr>';
        echo '<td>',$num,'</td>';
        echo '<td>';
        echo '<a href="detail.php?id=',$row['shohin_number'],'">','<img src="image/',$row['shohin_gazo'],'" alt="商品画像" width="100" height="100">','</a>';
        echo '</td>';
        echo '<td>',$row['shohin_price'],'円','</td>';
        echo '</tr>';
        $num++;
    }
    echo '</table>';

?>
<form action = "product.php" methods = "post">
    <input type = "submit" class="back" value = "検索画面に戻る">
<?php require 'footer.php'; ?>
</body>
</html>