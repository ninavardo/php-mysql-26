<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="submit" name="stop" value="stop">
    </form>
</body>
</html><?php

    $seconds = 0;
    $running = true;

    while ($running) {

        if(isset($_POST["stop"])){
            $running = false;
        }
        else{

        $seconds++;
        echo  $seconds ."<br>";
        }
    }


    // $counter = 0;

    // while($counter < 10){
    //     $counter++;
    //     echo $counter ."<br>";
    // }

?>