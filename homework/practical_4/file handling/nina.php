<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="nina.php" method ="post">
    Enter number:<input type="text" name="number">
    <input type="submit" value="submit" name="submit">
    </form>
    <?php

    if(isset($_POST['submit']))
        {
            $number = $_POST['number'];

            $myfile = fopen("nina.txt", "w");
            fwrite($myfile, $number);
            echo "done";
            fclose($myfile);
        }

    ?>
</body>
</html>