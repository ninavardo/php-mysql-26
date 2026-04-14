<?php
    if(isset($_POST['send_button'])){
        echo "<h3>Test</h3>";
        echo "<pre>";
        print_r($_FILES['file']);
        echo "</pre>";
        echo "<pre>";
        print_r(pathinfo($_FILES['file']['name']));
        echo "</pre>";
        $size = 1024 * 1024 * 10;
        $extension = pathinfo($_FILES['file']['name'])['extension'];
        if( ($extension == 'pptx' || $extension == 'txt') && $size <= $_FILES['size']){
            move_uploaded_file($_FILES['file']['tmp_name'], "files/".$_FILES['file']['name']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            border: solid 1px black;
            width: 500px;
            padding: 20px;
            margin: 10px auto;
            background-color: antiquewhite;
        }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data"> 
        <input type="file" name="file" accept=".txt, .pptx">
        <br><br>
        <button name="send_button">Send File</button>
    </form>
</body>
</html>