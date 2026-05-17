<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
</head>

<body>
    <form method="POST">
        <label>sheiyvane role_ID</label><br>
        <input type="number" name="role_ID"><br>

        <label>sheiyvane saxeli</label><br>
        <input type="text" name="name"><br>

        <input type="submit" name="submit">
    </form>
</body>
<?php
if (isset($_POST["submit"])) {
    $connection = mysqli_connect("localhost", "root", "", "bank_system");
    $role_ID = trim($_POST["role_ID"]);
    $name = trim($_POST["name"]);

    if ($name == "" || $role_ID == "") {
        echo "sheavse carieli veli";
    } else {
        $insert = "INSERT INTO employee(role_ID,name) VALUES ('$role_ID','$name')";
        mysqli_query($connection, $insert);
        header("Location: bank_system_db.php");
    }
}

$connection = mysqli_connect("localhost", "root", "", "bank_system");

$result = mysqli_query($connection, "SELECT * FROM emoployee");

$rows = mysqli_fetch_all($result);

echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
foreach ($rows as $r) {
    echo "<tr>";
    echo "<td style='border: 1px solid black; padding: 5px;'>F_name : " . $r['role_ID']  . "</td>";
    echo "<td style='border: 1px solid black; padding: 5px;'>L_nmae : " . $r['name']  . "</td>";
    echo "</tr>";
}
echo "</table>"
?>

</html>