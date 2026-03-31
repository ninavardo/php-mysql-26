<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

    if(isset($_POST["submit"])){
        $name = $_POST["name"];
        if(file_exists($name)){
            unlink($name);
            echo "file deleted";
        }else{
            echo "file doesn't exist";
        }
    }
    
    ?>

    <form method ="post">
    saxeli<input type = "text" name = "name">
    <input type = "submit" name= "submit">
    </form>
</body> 
</html>