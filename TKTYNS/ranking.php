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
        echo '<input type="submit" value="🔎">';
    echo '</form>';
    $sql=$pdo->prepare('select * from Shohin inner join Stock on Shohin.shohin_number = Stock.shohin_number where Detail.shohin_sport=? and Detail.shohin_burnd=? and Detail.shohin_kate=? and Shohin.shohin_price between ? and ?');
    $sql->execute(['%'.$_POST['keyword'].'%',$_POST['sport'],$_POST['burnd'],$_POST['category'],$price_1,$price_2]);
?>

<?php require 'footer.php'; ?>