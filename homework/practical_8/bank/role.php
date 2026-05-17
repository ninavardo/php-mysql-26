<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>role</title>
</head>
<body>
    <form method="POST">
    <label>sheiyvane role : </label>
    <input type="text" name="role">
    <br>
    <input type="submit" value="SUBMIT" name="submit">
    </form>
    <br><br><br>
    <form method="GET">
        <input type="submit" value="GET" name="get">
    </form>
</body>
<?php
if(isset($_POST["submit"]))
    {
        $connection = mysqli_connect("localhost", "root", "", "bank_system");
        $role = trim($_POST["role"]);

        if($role == "")
            {
                echo "sheiyvane role";
            }
        else
            {
                $insert = "INSERT INTO role(role_name) VALUES('$role')";
                mysqli_query($connection,$insert);
                header("Location: bank_system_role.php");
            }
    }
if(isset($_GET["get"]))
    {
        $connection = mysqli_connect("localhost", "root", "", "bank_system");
        $result = mysqli_query($connection, "SELECT * FROM role");
        $rows = mysqli_fetch_all($result);

        echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
        echo "<tr>
                <th style='border: 1px solid black; padding: 5px;'>ID</th>
                <th style='border: 1px solid black; padding: 5px;'>Role</th>
              </tr>";

        foreach($rows as $r)
        {
            echo "<tr>";
            echo "<td style='border: 1px solid black; padding: 5px;'>".$r[0]."</td>";
            echo "<td style='border: 1px solid black; padding: 5px;'>".$r[1]."</td>";
            echo "</tr>";
        }
        echo "</table>";
}
?>
</html>