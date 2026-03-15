<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task3</title>
</head>
<body>
   <?php
$code = rand(10000,99999);
echo "Your code: $code";
?>

<form method="post">
Enter code:
<input type="number" name="user_code"><br>

<input type="hidden" name="real_code" value="<?php echo $code; ?>">

<input type="submit" name="check" value="Check">
</form>

<?php

if(isset($_POST["check"])){

$user = $_POST["user_code"];
$real = $_POST["real_code"];

if($user == $real){
echo "Correct code";
}
else{
echo "Code is wrong";
}

}

?>

</body>
</html>