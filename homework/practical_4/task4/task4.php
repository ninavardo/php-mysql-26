<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form action="task4.php" method="post">
        create file:<input type="text" name="name"><br>
        <input type="submit" value="create" name="submit"><br>
    </form>

    <?php

    $sum = 0;

    if (isset($_POST['submit'])) {

        $myfile = fopen("numbers.txt", "w");

        for ($i = 0; $i < 10; $i++) {
            $a = rand(1, 100);
            fwrite($myfile, $a . "\n");
        }

        fclose($myfile);

        $myfile = fopen("numbers.txt", "r");

        while (($line = fgets($myfile)) !== false) {
            echo $line . "<br>";
            $sum += (int)$line;
        }

        fclose($myfile);

        echo "sum is: " . $sum;
    }

    ?>

</body>

</html>