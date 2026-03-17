<!-- შექმენით ფორმა, სადაც მომხმარებელი შეიყვანს N რიცხვს.

დაწერეთ ფუნქცია, რომელიც:
შექმნის მასივს
მასივში შეინახავს N შემთხვევით რიცხვს [1;100] შუალედიდან
გამოიტანს მასივის ელემენტებს
გამოიტანს მაქსიმალურ მნიშვნელობას

აუცილებელია:

გამოიყენოთ ფუნქცია
გამოიყენოთ მასივი
გამოიყენოთ ვალიდაცია -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        enter number:
        <input type="number" name="number">
        <input type="submit" name="submit" value="click">
    </form>

<?php

if (isset($_POST["submit"])) {

    $number = $_POST["number"];

    if ($number > 0) {

        $arr = [];

        for ($i = 0; $i < $number; $i++) {
            $arr[$i] = rand(1, 100);
        }

        echo "Array elements:<br>";

        foreach ($arr as $value) {
            echo $value . " ";
        }

        $max = max($arr);

        echo "<br>Max = " . $max;
    } else {
        echo "Enter positive number";
    }
}

?>
</body>

</html>