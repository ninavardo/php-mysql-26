<?php
    echo "<pre>";
    print_r($_GET);
    echo "</pre>"; 

    $file = $_GET['f-name'];
    $Content = $_GET['f-content'];

    $file = $_GET['f-name'];
    $file = $file.".txt";
    $file = "files1/".$file;
    echo $file;

    $fid = fopen($file, "w"); 
    fwrite($fid, $Content);
    fclose($fid);
?>