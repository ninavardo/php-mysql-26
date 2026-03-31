<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    
        if (isset($_POST["submit"])) {
            $name = $_POST["text"];
         if (!empty($name)) {
            if (file_exists($name)) {
                $d = scandir($name);
                foreach($d as $file);
                echo $file;
            } else {
                mkdir($name);
                scandir($name);
                echo $name;
                echo "folder create";
            }
        }
    }
    ?>


    <form method="post">
        name:<input type="text" name="text">
        <input type="submit" name="submit">
    </form>
</body>

</html>