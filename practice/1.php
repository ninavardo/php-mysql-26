<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 
    if(isset($_GET['f-submit'])) {
        $name = $_GET['name'];
        $lastname = $_GET['lastname'];
        $position = $_GET['position'];
        $salary = $_GET['salary'];
        $tax = $_GET['tax'];

        $saxelmwifo = $salary - ($salary * 0.2);
        $daricxuli = $salary - ($salary * $tax / 100);
        echo "daricxuli: ". $daricxuli . ". erovnuli taxi: " . $saxelmwifo;

        $rows = ['name', 'lastname', 'positoin', 'salary', 'tax', 'erovnuli tax'];
        $cols = [$name, $lastname, $position, $salary, $tax, $daricxuli, $saxelmwifo];

        echo "<table border='1'>";

        echo "<tr>";
        for ($i=0; $i < count($rows); $i++) { 
            echo "<th>{$rows[$i]}</th>";
        }
        echo "</tr>";

        echo "<tr>";
        for ($i=0; $i < count($cols); $i++) { 
            echo "<th>{$cols[$i]}</th>";
        }
        echo "</tr>";

        echo "</table>";
    }
?>
<body>
    <form aciton="employees.php" method="get">
        name: <input type="text" name="name">
        <br><br>
        lastname: <input type="text" name="lastname">
        <br><br>
        position: <input type="text" name="position">
        <br><br>
        salary: <input type="number" name="salary">
        <br><br>
        tax: <input type="number" name="tax" value="20">
        <br><br>
        <button type="submit" name="f-submit">submit</button>
    </form>
</body>
<style>
    form {
        width: 50%;
        height: 500px;
        margin: auto;
        border: 1px solid black;
    }
</style>
</html>