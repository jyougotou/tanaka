<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>商品を追加します</P>
    <from action="ren6-8-output.php" method="post">
        商品id<input type="text" name="id"><br>
        商品名<input type="text" name="name"><br>
        価格<input type="text" name="price"><br>
        <p style="text-align: right">
        <input type="submit"onclick="location.href='ren6-8-output.php'"name="back"value="追加"></p>;
</from>
</body>
</html>