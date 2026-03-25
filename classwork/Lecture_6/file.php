<?php
    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>"; 

    $file = $_GET['f-name'];
    $file = $file.".txt";
    $file = "files/".$file;
    echo $file;

    fopen($file, "w");
?>