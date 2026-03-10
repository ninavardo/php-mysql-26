<?php

    $name ="Nina vardo";
    $food ="pizza";
    $email = "fake@gmail.com";

    $age = 19;
    $users = 2;
    $quantity = 4;

    $gpa = 3.5;
    $price = 4.99;
    $tax_rate = 5.1;

    $employed = true;
    $online = false;
    $for_sale = true;

    $total =null;

    echo "hello {$name}<br>";
    echo "you like {$food}<br>";
    echo "you email is {$email}<br>";

    echo "you are {$age} years old<br>";
    echo "there are {$users} online<br>";
    echo "you would like to buy {$quantity}<br>";

    echo "your gpa is {$gpa}<br>";
    echo "your pizza is \${$price}<br>";
    echo "the saes tax rate is {$tax_rate}<br>";

    echo "online status: {$online}<br>";

    echo "you have ordered {$quantity} x {$food}s <br>";
    $total = $quantity * $price;
    echo "your tottal is: \${$total}";

?>