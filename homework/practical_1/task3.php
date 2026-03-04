<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Test</title>
</head>

<body>

    <h2>Student Knowledge Test</h2>

    <form method="post" action="">

        <p>1. Which language is used for web development?</p>
        <input type="radio" name="q1" value="a"> Python<br>
        <input type="radio" name="q1" value="b"> PHP<br>
        <input type="radio" name="q1" value="c"> C++<br>
        <input type="radio" name="q1" value="d"> Assembly<br><br>

        <p>2. Which symbol is used for variables in PHP?</p>
        <input type="radio" name="q2" value="a"> #<br>
        <input type="radio" name="q2" value="b"> &<br>
        <input type="radio" name="q2" value="c"> $<br>
        <input type="radio" name="q2" value="d"> %<br><br>

        <p>3. Which method sends data securely?</p>
        <input type="radio" name="q3" value="a"> GET<br>
        <input type="radio" name="q3" value="b"> POST<br>
        <input type="radio" name="q3" value="c"> LINK<br>
        <input type="radio" name="q3" value="d"> URL<br><br>

        <p>4. What does HTML stand for?</p>
        <textarea name="q4" rows="3" cols="40"></textarea><br><br>

        <p>5. What does CSS control in a webpage?</p>
        <textarea name="q5" rows="3" cols="40"></textarea><br><br>

        <input type="submit" value="Submit Test">

    </form>

    <?php

    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $q5 = $_POST['q5'];

    $score = 0;

    if ($q1 == "b") {
        $score++;
    }

    if ($q2 == "c") {
        $score++;
    }

    if ($q3 == "b") {
        $score++;
    }

    if (strtolower($q4) == "hypertext markup language") {
        $score++;
    }

    if (strtolower($q5) == "design") {
        $score++;
    }

    echo "<h3>Correct answers: $score / 5</h3>";

    ?>

</body>

</html>