<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $folder = "files";
    $file1 = $folder . "/file1.txt";
    $file2 = $folder . "/file2.txt";
    $file3 = $folder . "/file3.txt";

    if (isset($_POST['submit'])) {
        if (!file_exists($folder)) {
            mkdir($folder);
            echo "file created" . "<br>";
        }
        $f1 = fopen($file1, "w");
        fwrite($f1, "Hello Ninaaa!!!!");
        fclose($f1);

        $f2 = fopen($file2, "w");
        fwrite($f2, "can we study PHP?!");
        fclose($f2);

        $f3 = fopen($file3, "w");
        fwrite($f3, "I need energy:(");
        fclose($f3);
    }
    echo "you created: " . $file1 . "<br>" . $file2 . "<br>" . $file3;

    ?>
    <form method="post">
        <input type="submit" name="submit">
    </form>
</body>

</html>