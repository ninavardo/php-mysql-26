<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="GET">
        <label>quantity:</label><br>
        <input type="text" name="quantity">
        <input type="submit" value="total">
    </form>
</body>
</html>
<?php
    $item = "pizza";
    $price = 5.99;
    $quantity = $_GET["quantity"];
    $total = null;

    $total = $quantity * $price;

    echo"you have ordered {$quantity} x {$item}/s<br>";
    echo "total is \${$total}";
?>





<!---
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="index.php" method="post">
    <lable>username:</lable><br>
    <input type="text" name="username"><br>
    <lable>password:</lable><br>
    <input type="password" name="password"><br>
    <input type="submit" value="log in">
    </form>
</body>
</html>


  ES PHP-IS KODIA

    echo "{$_POST["username"]} <br>";
    echo "{$_POST["password"]} <br>";
-->


