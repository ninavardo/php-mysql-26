<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task_1</title>
</head>
<body></body>
<?php


for($i = 0; $i < 10; $i++){
    $arr[$i] = rand(10,100);
}

echo "<table border='1'>";

for($i = 0; $i < 10; $i++){
    echo "<tr>";

    for($j = 0; $j < 10; $j++){
        echo "<td>". rand(10,100) ."</td>";
    }

    echo "</tr>";
}

echo "</table>";

?>

</body>
</html>