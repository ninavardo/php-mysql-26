<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>presentation</title>
</head>
<body>

<h2>input deteails</h2>

<form method="post">
    mail: <input type="text" name="email"><br><br>
    number: <input type="text" name="phone"><br><br>
    <input type="submit" value="შემოწმება">
</form>

<?php

if (isset($_POST['email']) && isset($_POST['phone'])) {

    $email = $_POST['email'];
    $phone = $_POST['phone'];

    echo "<h3>result:</h3>";

    if (preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/", $email)) {
        echo " mail is correct: $email <br>";
    } else {
        echo " mail is wrong!!<br>";
    }

    $clean_phone = preg_replace("/[^0-9+]/", "", $phone);
    echo "cleaned from extra characters: $clean_phone <br>";

    if (preg_match("/^\+9955\d{8}$/", $clean_phone)) {
        echo "number is correct";
    } else {
        echo " number is wrong!!";
    }
}

?>

</body>
</html>