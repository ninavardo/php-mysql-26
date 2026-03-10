<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Salary Form</title>
</head>
<body>

<h2>Salary Calculation Form</h2>

<form method="get" action="">
    First Name: <input type="text" name="first_name"><br><br>
    Last Name: <input type="text" name="last_name"><br><br>
    Position: <input type="text" name="position"><br><br>
    Salary: <input type="number" name="salary"><br><br>
    Tax Percentage: <input type="number" name="tax_percent" value="20"><br><br>
    <input type="submit" value="Calculate">
</form>

<?php
$firstName = $_GET['first_name'];
$lastName = $_GET['last_name'];
$position = $_GET['position'];
$salary = (float)$_GET['salary'];
$taxPercent = (float)$_GET['tax_percent'];

$tax = $salary * ($taxPercent / 100);
$netSalary = $salary - $tax;
?>

<h3>Results</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Position</th>
        <th>Salary</th>
        <th>Tax</th>
        <th>Net Salary</th>
    </tr>
    <tr>
        <td><?php echo $firstName; ?></td>
        <td><?php echo $lastName; ?></td>
        <td><?php echo $position; ?></td>
        <td><?php echo $salary; ?></td>
        <td><?php echo $tax; ?></td>
        <td><?php echo $netSalary; ?></td>
    </tr>
</table>

</body>
</html>