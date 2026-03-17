<!-- შექმენით ასოციაციური მასივი, რომელიც შეიცავს სტუდენტის მონაცემებს:

name
age
city

გამოიტანეთ ფორმა, სადაც მომხმარებელი შეიყვანს სახელს.

პროგრამამ უნდა:

1️⃣ შეამოწმოს შეყვანილი მნიშვნელობა (empty)
2️⃣ შეადაროს მასივში არსებულ სახელს
3️⃣ თუ ემთხვევა → გამოიტანოს ყველა ინფორმაცია
4️⃣ თუ არა → გამოიტანოს "Student not found"

აუცილებელია გამოიყენოთ:

ასოციაციური მასივი

$_POST

ვალიდაცია -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <input type="text" name="name">
        <input type="submit" name="submit" value="check">
    </form>

    <?php

    $student = array(
        "name" => "nina",
        "age" => "19",
        "city" => "Tbilisi"
    );

    if (isset($_POST["submit"])) {

        $name = $_POST["name"];

        if (empty($name)) {
            echo "This is empty";
        } else {

            if ($name == $student["name"]) {

                echo "Name: " . $student["name"] . "<br>";
                echo "Age: " . $student["age"] . "<br>";
                echo "City: " . $student["city"];
            } else {
                echo "Student not found";
            }
        }
    }

    ?>
</body>

</html>