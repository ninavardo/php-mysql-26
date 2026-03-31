<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get">
    1:<input type="number" name="nomerti"><br>
    2:<input type="number" name="nomori"><br>
    3:<input type="number" name="nomsami"><br>
    4:<input type="number" name="nomotxi"><br>
    5:<input type="number" name="nomxuti"><br>
    <input type="submit" name="submit">
    </form>

    
    <?php
    
    if(isset($_GET['submit'])){

    $n1 = $_GET["nomerti"];
    $n2 = $_GET["nomori"];
    $n3 = $_GET["nomsami"];
    $n4 = $_GET["nomotxi"];
    $n5 = $_GET["nomxuti"];

    $arr = array($n1,$n2,$n3,$n4,$n5);

    $maxnum = $arr[0];
    $minnum = $arr[0];
    $sum = 0;

        for($i=0; $i<5; $i++){
            $sum+= $arr[$i];
        
        
        if($arr[$i] > $maxnum){
            $maxnum = $arr[$i]; 
        }
        if($arr[$i] < $minnum){
            $minnum = $arr[$i];
        }
    }
    }
    
        echo "sheyvanili ricxvebi:". $n1 . $n2 .$n3 . $n4. $n5,"<br>";
        echo "maximumi: ". $maxnum. "<br>";
        echo "minimumi: ". $minnum. "<br>";
        echo "jami=".$sum. "<br>";
        
    

    
    ?>
</body>
</html>