<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tas2</title>
</head>
<body>
  
<form method="post">
    Enter M:
    <input type="number" name="M"><br>

    Enter N:
    <input type="number" name="N"><br>

    Enter a:
    <input type="number" name="a"><br>

    Enter b:
    <input type="number" name="b"><br>

    <input type="submit" value="Generate Table">
</form>

<?php

function table($M, $N, $a, $b){
    echo "<table border='1'>";

    for($i=0; $i<$M; $i++){
        echo "<tr>";

        for($j=0; $j<$N; $j++){
            $num = rand($a,$b);
            echo "<td>$num</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
}

if(isset($_POST["M"]) && isset($_POST["N"]) && isset($_POST["a"]) && isset($_POST["b"])){

    $M = $_POST["M"];
    $N = $_POST["N"];
    $a = $_POST["a"];
    $b = $_POST["b"];

    if($M>0 && $N>0 && $a <= $b){
        table($M,$N,$a,$b);
    } else {
        echo "Invalid input!";
    }
}

?>

</body>
</html