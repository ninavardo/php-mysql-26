<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Grades Form</title>
</head>

<body>

    <h2>Student Grade Form</h2>

    <form method="post" action="">
        Student First Name: <input type="text" name="first_name"><br><br>
        Student Last Name: <input type="text" name="last_name"><br><br>
        Course: <input type="text" name="course"><br><br>
        Semester: <input type="text" name="semester"><br><br>
        Subject: <input type="text" name="subject"><br><br>
        Grade (0-100): <input type="number" name="score"><br><br>
        Lecturer First Name: <input type="text" name="lecturer_first"><br><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];
    $score = (int) $_POST['score'];
    $lecturerFirst = $_POST['lecturer_first'];
    
    if ($score >= 91) {
        $grade = "A — Excellent";
    } elseif ($score >= 81) {
        $grade = "B — Very Good";
    } elseif ($score >= 71) {
        $grade = "C — Good";
    } elseif ($score >= 61) {
        $grade = "D — Satisfactory";
    } elseif ($score >= 51) {
        $grade = "E — Sufficient";
    } elseif ($score >= 41) {
        $grade = "FX — Fail (Retake)";
    } else {
        $grade = "F — Fail";
    }
    ?>

    <h3>Results</h3>

    <table border="1">
        <tr>
            <th>Student</th>
            <th>Course</th>
            <th>Semester</th>
            <th>Subject</th>
            <th>Score</th>
            <th>Grade</th>
            <th>Lecturer</th>
        </tr>

        <tr>
            <td><?php echo $firstName . " " . $lastName; ?></td>
            <td><?php echo $course; ?></td>
            <td><?php echo $semester; ?></td>
            <td><?php echo $subject; ?></td>
            <td><?php echo $score; ?></td>
            <td><?php echo $grade; ?></td>
            <td><?php echo $lecturerFirst ?></td>
        </tr>
    </table>

</body>

</html>