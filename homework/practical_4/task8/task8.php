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
            $name = $_POST["name"];
            $folder = scandir($name);
            foreach ($folder as $file) {
                if (str_ends_with($file, ".txt")) {
                    echo $file."<br>";
                    $filesize= filesize($name . "/" . $file);
                    $time = date("Y-m-d H:i:s",fileatime($name . "/" . $file));
                    echo $filesize."<br>". $time;
                } 
            }
        }

        ?>


        <form method="post">
            enter name:<input type="text" name="name">
            <input type="submit" name="submit">

        </form>
    </body>

    </html>