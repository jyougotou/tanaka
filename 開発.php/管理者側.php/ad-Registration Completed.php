<?php
    $pdo = new PDO(
        'mysql:host=mysql215.phy.lolipop.lan;dbname=LAA1516808-shop;charsetutf8',
        'LAA1516808',
        'Pass1007');
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $sql=$pdo->prepare('insert into product(id,name,price) values(?,?,?)');
    //var_dump($row);
    if(('/^\d+$/'$_POST['id'])){
        echo '商品idを入力してください';
    }else if (empty($_POST['name'])){
        echo '商品名を入力してください';
    }else if (!preg_match('/^[0-9]+$/',$_POST['price'])){
        echo '商品価格を入力してください';
    }else if ($sql->execute([$_POST['id'],$_POST['name'],$_POST['price']])){
        echo '<font color="red">追加に成功しました。<fomt>';
    }else {
        echo '<font color="red">追加に失敗しました。<fomt>';
    }
    ?>
    <br><hr><br>
    <table>
    <tr><th>商品名</th><th>カテゴリー</th><th>価格</th><tr>
    <?php
    foreach($pdo->query('select*from product') as $row){
        echo '<tr>';
        echo'<td>',$row['id'],'</td>';
        echo'<td>',$row['name'],'</td>';
        echo'<td>',$row['price'],'</td>';
        echo'</tr>';
        echo"\n";
    }
?>
</table>
<from action="ren6-8-top.php"method="post">
    <button type="submit">TOPへ戻る</button>
</from>
</body>
</html>