<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task1</title>
</head>
<body>

<form method="post">
    Enter X:
    <input type="number" name="x">
    <input type="submit" value="Check">
</form>

<?php

// shevamowmot carieli rom ar iyos isset it
if(isset($_POST['x'])){

$x = $_POST['x'];

$arr = [];
$less = 0;
$greater = 0;

for($i = 0; $i < 12; $i++){
    $arr[$i] = rand(10,100);
}

echo "numbers:<br>";

for($i = 0; $i < 12; $i++){

    echo $arr[$i] . "<br>";

    if($arr[$i] < $x){
        $less++;
    }

    if($arr[$i] > $x){
        $greater++;
    }

}

echo "<br> < X: " . $less;
echo "<br> > X: " . $greater;

}

?>

</body>
</html>