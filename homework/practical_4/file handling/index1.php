<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index1.php" method="post">
    <input type="submit" value="view file content" name="submit">
    </form>

    <?php
    if(isset($_POST['submit'])){
    $myfile = fopen("nina.txt", "r");
    $txt = fread($myfile, filesize("nina.txt"));
    echo $txt;
    fclose($myfile);
    }
    ?>
</body>
</html>