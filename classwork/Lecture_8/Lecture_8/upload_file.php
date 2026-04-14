<?php
    if(isset($_POST['send_button'])){
        echo "<h3>Test</h3>";
        echo "<pre>";
        print_r($_FILES['file']);
        echo "</pre>";
        for($i=0; $i<count($_FILES['file']['name']); $i++){
            move_uploaded_file($_FILES['file']['tmp_name'][$i], "storage/".$_FILES['file']['name'][$i]);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data"> 
        <input type="file" name="file[]" multiple>
        <br><br>
        <button name="send_button">Send File</button>
    </form>
</body>
</html>