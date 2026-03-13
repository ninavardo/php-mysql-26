<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task_2</title>
</head>
<body>
<form method="post">
Enter X:
<input type="number" name="x">
<input type="submit" value="Submit">
</form>

<?php

$matrix = [];
$sum = 0;
$product = 1;
$max = 0;
$min = 100;

for($i=0;$i<4;$i++){
    for($j=0;$j<4;$j++){
        $matrix[$i][$j] = rand(10,100);
    }
}

echo "<h3>Matrix</h3>";
echo "<table border=1>";

for($i=0;$i<4;$i++){
    echo "<tr>";
    for($j=0;$j<4;$j++){

        $num = $matrix[$i][$j];
        echo "<td>$num</td>";

        $sum += $num;
        $product *= $num;

        if($num > $max) $max = $num;
        if($num < $min) $min = $num;
    }
    echo "</tr>";
}
echo "</table>";

echo "<h3>diagonalis zemot</h3>";
echo "<table border=1>";

for($i=0;$i<4;$i++){
    echo "<tr>";
    for($j=0;$j<4;$j++){

        if($j > $i)
            echo "<td>".$matrix[$i][$j]."</td>";
        else
            echo "<td></td>";

    }
    echo "</tr>";
}

echo "</table>";

if(isset($_POST['x'])){

$x = $_POST['x'];

}

$avg = $sum / 16;
$range = $max - $min;

echo "<h3>matematikuri</h3>";
echo "Sum = $sum <br>";
echo "Product = $product <br>";
echo "Average = $avg <br>";
echo "Range = $range <br>";

echo "<h3>ricxvebis jami</h3>";
echo "<table border=1>";

for($i=0;$i<4;$i++){
    echo "<tr>";
    for($j=0;$j<4;$j++){

        $num = $matrix[$i][$j];
        $digitSum = array_sum(str_split($num));

        echo "<td>$digitSum</td>";

    }
    echo "</tr>";
}

echo "</table>";

?>

</body>
</html>