<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $students =
        [
            ['name' => 'nina', 'midterm' => 20, 'final' => 40, 'project' => 10],


            ['name' => 'lita', 'midterm' => 18, 'final' => 30, 'project' => 8],

            ['name' => 'babi', 'midterm' => 15, 'final' => 20, 'project' => 6],

            ['name' => 'gio', 'midterm' => 10, 'final' => 15, 'project' => 5]
        ];


    $maxScore = 0;
    $minscore = 100;

    $maxStudent = "";
    $minStudent = "";

    $totalSum = 0;

    foreach ($students as $student) {
        $finalScore = $student['midterm'] + $student['final'] + $student['project'];

        echo  "name:" . $student["name"] . "-midterm-" . $student["midterm"] .
            "-final-" . $student['final'] . "-project-" . $student["project"] .
            "-total:" . $finalScore . "<br>";

        if ($finalScore > $maxScore) {
            $maxScore = $finalScore;
            $maxStudent = $student['name'];
        }

        if ($finalScore < $minscore) {
            $minscore = $finalScore;
            $minStudent = $student['name'];
        }
        $totalSum += $finalScore;
    }
    $average = $totalSum / count($student);

    echo 'max:'. $maxStudent .'<br>';
    echo 'min:'. $minStudent .'<br>';
    echo 'total:'. $totalSum .'<br>';
    echo 'sash:'. $average .'<br>';
    ?>
</body>

</html>