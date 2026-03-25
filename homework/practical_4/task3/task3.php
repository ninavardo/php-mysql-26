<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task3</title>
</head>

<body>
    <form action="task3.php" method="post">
        enter file name:<input type="text" name="name"> <br>
        <input type="submit" value="submit" name="submit"><br>
    </form>

    <?php
    if (isset($_POST['submit'])) {

        if (file_exists("data.txt")) {
            echo "File already exists";
        } else {
            $myfile = fopen("data.txt", "w");
            fwrite($myfile, "New File Created");
            fclose($myfile);
            echo "File created successfully";
        }
    }
    ?>

</body>

</html>