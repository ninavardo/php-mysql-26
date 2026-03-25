<!DOCTYPE html>
<br lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lecture6</title>
</head>
<br>
<form action="file.php" method="get">
    File name - <input type="text" name="f-name">
    <br>
    <br>
    <button>Create File</button>
</form>
<hr>
<form action="file1.php" method="get">
    File name - <input type="text" name="f-name">
    <br><br>
    File Content - <textarea name="f-content"></textarea>
    <br><br>
    <button>Write to File</button>
</form>
<hr>
    <div class="content">
        <h1>List of Files1</h1>
        <?php 
            $d = scandir("files1");
            // echo "<pre>";
            // print_r($d);
            // echo "</pre>";

            for($i=2; $i<count($d); $i++){
                echo "<p>$d[$i]</p>";
            }
        ?>
    </div>
</body>
</html