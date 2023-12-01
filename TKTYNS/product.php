<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/product.css">
    <title>Document</title>
</head>
<body>
    <!--商品画面に遷移する-->
<form action="product.php" method="post">
    <input type="text" name="keyword" placeholder="キーワードを検索" class = "searchBox" value="<?php echo $_POST['keyword']; ?>">
<?php
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query('select distinct shohin_sport from Detail');
    echo '<select name="sport"  class = "select-btn" >',"\n";
        echo '<option hidden value="">スポーツ</option>';
        echo '<option value="">選択しない</option>';
        foreach($sql as $row){
            if($row['shohin_sport']==$_POST['sport']){
                echo '<option value="',$row['shohin_sport'],'" selected>',$row['shohin_sport'],'</option>',"\n";
            }else{
                echo '<option value="',$row['shohin_sport'],'">',$row['shohin_sport'],'</option>',"\n";
            }
        }
    echo '</select>',"\n";
    $sql=$pdo->query('select distinct shohin_burnd from Detail');
    echo '<select name="burnd" class = "select-br">',"\n";
        echo '<option hidden value="">ブランド</option>';
        echo '<option value="">選択しない</option>';
        foreach($sql as $row){
            if($row['shohin_burnd']==$_POST['burnd']){
                echo '<option value="',$row['shohin_burnd'],'" selected>',$row['shohin_burnd'],'</option>',"\n";
            }else{
                echo '<option value="',$row['shohin_burnd'],'">',$row['shohin_burnd'],'</option>',"\n";
            }
        }
    echo '</select>',"\n";
    $sql=$pdo->query('select distinct shohin_kate from Detail');
    echo '<select name="category" class = "select-bs">',"\n";
        echo '<option hidden value="">カテゴリ</option>';
        echo '<option value="">選択しない</option>';
        foreach($sql as $row){
            if($row['shohin_kate']==$_POST['category']){
                echo '<option value="',$row['shohin_kate'],'" selected>',$row['shohin_kate'],'</option>',"\n";
            }else{
                echo '<option value="',$row['shohin_kate'],'">',$row['shohin_kate'],'</option>',"\n";
            }
        }
    echo '</select>',"\n";
    echo '<select name="price" class = "select-pr">',"\n";
        echo '<option hidden value="">価格帯</option>';
        echo '<option value="">選択しない</option>';
        if(1==$_POST['price']){
            echo '<option value="1" selected>～1000円</option>',"\n";
        }else{
            echo '<option value="1">～1000円</option>',"\n";
        }
        if(2==$_POST['price']){
            echo '<option value="2" selected>1000円～3000円</option>',"\n";
        }else{
            echo '<option value="2">1000円～3000円</option>',"\n";
        }
        if(3==$_POST['price']){
            echo '<option value="3" selected>3000円～9000円</option>',"\n";
        }else{
            echo '<option value="3">3000円～9000円</option>',"\n";
        }
        if(4==$_POST['price']){
            echo '<option value="4" selected>9000円～30000円</option>',"\n";
        }else{
            echo '<option value="4">9000円～30000円</option>',"\n";
        }
    echo '</select>',"\n";
    switch($_POST['price']){
        case 1:
            $price_1 = 0;
            $price_2 = 1000;
            break;
        case 2:
            $price_1 = 1000;
            $price_2 = 3000;
            break;
        case 3:
            $price_1 = 3000;
            $price_2 = 9000;
            break;
        case 4:
            $price_1 = 9000;
            $price_2 = 30000;
            break;
        default:
            $price_1 = 0;
            $price_2 = 0;
    }
    echo '<input type="submit" value="🔎">';
?>
</form>
<!--ログイン画面に遷移する-->
<form action="login-input.php" method="post">
    <input type="submit" class = "login" value="ログイン">
</form>
<!--会員情報更新画面に遷移する-->
<form action="customer-update-input.php" method="post">
    <input type="submit" class = "yuza" value="ユーザー情報の更新">
</form>
<!--カート画面に遷移する-->
<form action="cart.php" method="post">
    <input type="submit" class = "cart" value="🛒">
</form>
<!--ランキング画面に遷移する-->
<form action="ranking.php" method="post">
    <input type="submit" class = "ranking" value="ランキング">
</form>
<!--ログアウト画面に遷移する-->
<form action = "logout-input.php" method = "post">
    <input type = "submit" class = "log" value = "ログアウト">
</form>

<hr>

<?php

if(!empty($_POST['keyword'])){
    if(!empty($_POST['sport'])){
        if(!empty($_POST['burnd'])){
            if(!empty($_POST['category'])){
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_sport=? and Detail.shohin_burnd=? and Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport'],$_POST['burnd'],$_POST['category'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_sport=? and Detail.shohin_burnd=? and Detail.shohin_kate=?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport'],$_POST['burnd'],$_POST['category']]);
                }
            }else{
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_sport=? and Detail.shohin_burnd=? and Shohin.shohin_price between ? and ?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport'],$_POST['burnd'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_sport=? and Detail.shohin_burnd=?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport'],$_POST['burnd']]);
                }
            }
        }else{
            if(!empty($_POST['category'])){
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_sport=? and Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport'],$_POST['category'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_sport=? and Detail.shohin_kate=?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport'],$_POST['category']]);
                }
            }else{
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_sport=? and Shohin.shohin_price between ? and ?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_sport=?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport']]);
                }
            }
        }
    }else{
        if(!empty($_POST['burnd'])){
            if(!empty($_POST['category'])){
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_burnd=? and Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['burnd'],$_POST['category'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_burnd=? and Detail.shohin_kate=?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['burnd'],$_POST['category']]);
                }
            }else{
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_burnd=? and Shohin.shohin_price between ? and ?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['burnd'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_burnd=?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['burnd']]);
                }
            }
        }else{
            if(!empty($_POST['category'])){
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['category'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Detail.shohin_kate=?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['category']]);
                }
            }else{
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ? and Shohin.shohin_price between ? and ?');
                    $sql->execute(['%'.$_POST['keyword'].'%',$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_mei like ?');
                    $sql->execute(['%'.$_POST['keyword'].'%']);
                }
            }
        }
    }
}else{
    if(!empty($_POST['sport'])){
        if(!empty($_POST['burnd'])){
            if(!empty($_POST['category'])){
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_sport=? and Detail.shohin_burnd=? and Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
                    $sql->execute([$_POST['sport'],$_POST['burnd'],$_POST['category'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_sport=? and Detail.shohin_burnd=? and Detail.shohin_kate=?');
                    $sql->execute([$_POST['sport'],$_POST['burnd'],$_POST['category']]);
                }
            }else{
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_sport=? and Detail.shohin_burnd=? and Shohin.shohin_price between ? and ?');
                    $sql->execute([$_POST['sport'],$_POST['burnd'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_sport=? and Detail.shohin_burnd=?');
                    $sql->execute([$_POST['sport'],$_POST['burnd']]);
                }
            }
        }else{
            if(!empty($_POST['category'])){
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_sport=? and Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
                    $sql->execute([$_POST['sport'],$_POST['category'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_sport=? and Detail.shohin_kate=?');
                    $sql->execute([$_POST['sport'],$_POST['category']]);
                }
            }else{
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_sport=? and Shohin.shohin_price between ? and ?');
                    $sql->execute([$_POST['sport'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_sport=?');
                    $sql->execute([$_POST['sport']]);
                }
            }
        }
    }else{
        if(!empty($_POST['burnd'])){
            if(!empty($_POST['category'])){
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_burnd=? and Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
                    $sql->execute([$_POST['burnd'],$_POST['category'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_burnd=? and Detail.shohin_kate=?');
                    $sql->execute([$_POST['burnd'],$_POST['category']]);
                }
            }else{
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_burnd=? and Shohin.shohin_price between ? and ?');
                    $sql->execute([$_POST['burnd'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_burnd=?');
                    $sql->execute([$_POST['burnd']]);
                }
            }
        }else{
            if(!empty($_POST['category'])){
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
                    $sql->execute([$_POST['category'],$price_1,$price_2]);
                }else{
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Detail.shohin_kate=?');
                    $sql->execute([$_POST['category']]);
                }
            }else{
                if(!empty($_POST['price'])){
                    $sql=$pdo->prepare('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number where Shohin.shohin_price between ? and ?');
                    $sql->execute([$price_1,$price_2]);
                }else{
                    $sql=$pdo->query('select * from Shohin inner join Detail on Shohin.shohin_number = Detail.shohin_number');
                }
            }
        }
    }
}
echo '検索結果：全',$sql -> rowCount(),'件';
echo '<div class = "sports">';
foreach($sql as $row){
    $id=$row['shohin_number'];
    echo '<a href="detail.php?id=',$id,'">','<img src="image/',$row['shohin_gazo'],'" alt="商品画像" width="100" height="100">','</a>';

}
echo '</div>';

?>
</body>
</html>



<?php require 'footer.php'; ?>