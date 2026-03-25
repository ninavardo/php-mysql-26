<?php

    echo "<pre>";
    print_r($_GET);
    echo "</pre>";

    $file = $_GET['filename'];
    $content = $_GET['content'];

    $file = $file . ".txt";
    $file = "files/" . $file;
    echo $file;

    $open = fopen($file, "w");
    fwrite($open, $content);
    fclose($open);


    
    echo "<h2>Done. Here is what is in the file:</h2>";
    echo "<pre>";
    echo file_get_contents($file);
    echo "</pre>";
    echo '<p><a href="index.php">Back to form</a></p>';
?>
