<!DOCTYPE html>
<html>
<body>

<?php
$a = rand(10,99);
$b = rand(10,99);

$op = rand(0,1);

if($op == 0){
    $symbol = "+";
    $result = $a + $b;
}
else{
    $symbol = "-";
    $result = $a - $b;
}

echo "$a $symbol $b = ?";
?>

<form method="post">

<input type="number" name="answer"><br>

<input type="hidden" name="real" value="<?php echo $result; ?>">

<input type="submit" name="check" value="Check">

</form>

<?php

if(isset($_POST["check"])){

$user = $_POST["answer"];
$real = $_POST["real"];

if($user == $real){
echo "Correct!";
}
else{
echo "Wrong answer";
}

}

?>

</body>
</html>