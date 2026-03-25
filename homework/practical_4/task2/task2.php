<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="task2.php" method="post">
        Enter text: <input type="text" name="text"><br>
        <input type="submit" value="submit" name="submit"><br>
    </form>

    <?php
    if (isset($_POST['submit'])) {

        $txt = $_POST['text'];

        if ($txt === '') {
            echo "input cannot be empty";
        } else {
            $myfile = fopen('user.txt', 'w');
            $txt = fwrite($myfile, $txt);
            fclose($myfile);
            echo $_POST['text'];
        }
    }
    ?>
</body>

</html>