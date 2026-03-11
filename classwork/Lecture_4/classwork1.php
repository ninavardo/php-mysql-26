<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lecture 4</title>
</head>
<body>
    <form action="classwork1.php" method="post">

    <h1>PHP Form Validation Example</h1>

    Name:<input type="text" name="name" value="<?php if(isset($_POST["name"])) echo $_POST["name"]; else echo ""; ?>">-*<br><br>

    <!-- es aris terneruli -->

    E-mail:<input type="email" name="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"] ?>">-*<br><br>

    Website:<input type="text" name="website" value="<?php if(isset($_POST["website"])) echo $_POST["website"] ?>"><br><br>

    Comment:<textarea name="comment"></textarea><br><br>

    Gender:
    <input type="radio" name="Gender" value="Male">Male
    <input type="radio" name="Gender" value="Female">Female
    <input type="radio" name="Gender" value="Other">Other
    <br><br>
    <input type="submit" value="Submit" name="submit-form">
    <br><br>

    <h2>Your Input:</h2>

    </form>

    <div class="result">
        <?php
        echo "<pre>";
        print_r($_POST);
        echo"</pre>";

        if(isset($_POST["submit-form"])){
            echo "<h3>Clicked</h3>";
            if(empty($_POST["name"])){
                echo "<p>name is empty!!<p>";
            }
            if(empty($_POST["email"])){
                echo "<p>email is empty!!<p>";
            }
            if(empty($_POST["website"])){
                echo "<p>website is empty!!<p>";
            }
        }
        ?>
    </div>

</body>
</html>