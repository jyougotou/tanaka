<?php
    const SERVER = 'mysql218.phy.lolipop.lan';
    const DBNAME = 'LAA1516810-aso2201157';
    const USER = 'LAA1516810';
    const PASS = 'Pass0305';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<?php
unset($_SESSION['Ad']);
if(isset($_POST['admin_id'])){
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from Ad where ad_mei=?');
    $sql->execute([$_POST['admin_id']]);
    foreach ($sql as $row){
        if($_POST['password'] == $row['ad_pass']){
            $_SESSION['Ad']=[
                'ad_mei'=>$row['ad_mei'],'ad_pass'=>$row['ad_pass'],
                
            ];
        }
    }
    if(isset($_SESSION['Ad'])){
        header('Location:ad-list.php');
        exit;
    }else{
        echo 'ユーザー名、パスワードが一致しません。';   
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ad(css)/ad-login.css">
    <title>ASOスポーツ用品サイト(管理者側)</title>
</head>
<body>
  <div class="login-container">
    <h1>管理者ログイン画面</h1>
    <hr>
    <form action="ad-login-error.php" method="post">
      <div class="input-field">
        <p>
            <h2>管理者ID：
                <input type="text" id="admin-id" name="admin_id" required>
            </h2>
        </p>
      </div>
      <div class="input-field">
        <p>
            <h2>パスワード：
                <input type="password" id="password" name="password" required>
            </h2>
        </p>
      </div>
      <button type="submit">ログイン</button>
    </form>
  </div>
</body>
</html>
