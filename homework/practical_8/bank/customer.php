<?php
$connection = mysqli_connect("localhost", "root", "", "bank_system");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = "";
$success = "";

if (isset($_POST["submit"])) {
    $Fname   = trim($_POST["Fname"]);
    $Lname   = trim($_POST["Lname"]);
    $number  = trim($_POST["number"]);
    $mail    = trim($_POST["mail"]);
    $address = trim($_POST["address"]);

    if ($Fname == "" || $Lname == "" || $number == "" || $mail == "" || $address == "") {
        $error = "sheiyvane sheni monacemebi sworad";
    } else {
        $stmt = mysqli_prepare(
            $connection,
            "INSERT INTO customer (F_name, L_name, phone, emile, address) VALUES (?, ?, ?, ?, ?)"
        );

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $Fname, $Lname, $number, $mail, $address);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header("Location: bank_system_db.php");
            exit();
        } else {
            $error = "Database error: " . mysqli_error($connection);
        }
    }
}

$result = mysqli_query($connection, "SELECT * FROM customer");
$rows   = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank System</title>
    <link rel="stylesheet" href="./bank_system.css">
</head>

<body>

    <form method="POST">
        <label>sheiyvane momxmareblis saxeli:</label>
        <input type="text" name="Fname">
        <br>
        <label>sheiyvane momxmareblis gvari:</label>
        <input type="text" name="Lname">
        <br>
        <label>sheiyvane momxmareblis nomeri:</label>
        <input type="text" name="number">
        <br>
        <label>sheiyvane momxmareblis meili:</label>
        <input type="email" name="mail">
        <br>
        <label>sheiyvane momxmareblis misamarti:</label>
        <input type="text" name="address">
        <br>
        <input type="submit" name="submit" value="Submit">
        <br><br>
    </form>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <table style="border: 1px solid black; border-collapse: collapse; margin-top: 20px;">
        <tr>
            <th style="border: 1px solid black; padding: 5px;">F_name</th>
            <th style="border: 1px solid black; padding: 5px;">L_name</th>
            <th style="border: 1px solid black; padding: 5px;">Phone</th>
            <th style="border: 1px solid black; padding: 5px;">Mail</th>
            <th style="border: 1px solid black; padding: 5px;">Address</th>
        </tr>
        <?php foreach ($rows as $r): ?>
        <tr>
            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($r['F_name']);   ?></td>
            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($r['L_name']);   ?></td>
            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($r['phone']);    ?></td>
            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($r['emile']);    ?></td>
            <td style="border: 1px solid black; padding: 5px;"><?php echo htmlspecialchars($r['address']);  ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>