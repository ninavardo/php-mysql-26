<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=#, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
    name:<input type="text" name="name"><br>
    lastname:<input type="text" name="surname"><br>
    age:<input type="number" name="age"><br>
    mail:<input type="mail" name="mail"><br>
    <input type="submit" name="submit"><br>
    </form>

    <?php

    

    if(isset($_POST["submit"])){
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $age = $_POST["age"];
        $mail = $_POST["mail"];

        if(empty($name)){
            echo "saxeli carielia <br>";
        }
        elseif(empty($surname)){
            echo "gvari carielia <br>";
        }
        elseif(empty($age)){
            echo "carielia <br>";
        }
        elseif($age <18){
            echo "daushvebeli asaki";
        }
        elseif(empty($mail)){
            echo "meilis veli carielia";
        }
        elseif(str_contains($mail, "@") !==true ){
            echo "meilis veli arasworia";
        }
    }
        $arr = array($name, $surname, $age, $mail);
            for($i=0; $i<4; $i++){
                echo $arr[$i];
            };
        echo "dasrulda registracia";
    
    ?>
</body>
</html>