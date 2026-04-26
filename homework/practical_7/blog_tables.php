<?php
$connect = mysqli_connect("localhost", "root", "", "blog_2026_1(2)");

$tables = ["categorys", "commetns", "posts", "roles", "users"];

$current_table = $_GET['table'] ?? "roles";

if (!in_array($current_table, $tables)) {
    $current_table = "roles";
}

$columns_result = mysqli_query($connect, "DESCRIBE $current_table");

$columns = [];
while ($col = mysqli_fetch_assoc($columns_result)) {
    $columns[] = $col;
}

$message = "";

if (isset($_POST['insert'])) {
    $insert_columns = [];
    $insert_values = [];
    $check_conditions = [];
    $empty = false;

    foreach ($columns as $col) {
        $field = $col['Field'];

        if ($field != "id" && $field != "created_at" && $field != "updated_at" && $field != "deleted_at") {
            if (!isset($_POST[$field]) || trim($_POST[$field]) == "") {
                $empty = true;
                break;
            }

            $value = mysqli_real_escape_string($connect, trim($_POST[$field]));

            $insert_columns[] = $field;
            $insert_values[] = "'$value'";
            $check_conditions[] = "$field = '$value'";
        }
    }

    if ($empty) {
        $message = "<p style='color:red;'>Fields cannot be empty!</p>";
    } else {
        $check_query = "SELECT * FROM $current_table WHERE " . implode(" AND ", $check_conditions);
        $check_result = mysqli_query($connect, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message = "<p style='color:red;'>Same data already exists!</p>";
        } else {
            $columns_string = implode(", ", $insert_columns);
            $values_string = implode(", ", $insert_values);

            $insert_query = "INSERT INTO $current_table ($columns_string) VALUES ($values_string)";
            mysqli_query($connect, $insert_query);

            header("Location: blog_tables.php?table=$current_table");
            exit();
        }
    }
}

$select_query = "SELECT * FROM $current_table";
$result = mysqli_query($connect, $select_query);
?>

<style>
    body {
        font-family: Arial;
    }

    table {
        border: 1px solid black;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
    }

    form {
        width: 350px;
        border: 1px solid black;
        padding: 15px;
        margin-top: 20px;
    }

    input, select {
        width: 100%;
        padding: 7px;
        margin-bottom: 10px;
    }

    a {
        margin-right: 15px;
    }
</style>

<h2>Blog Database Tables</h2>

<?php foreach ($tables as $table) { ?>
    <a href="blog_tables.php?table=<?= $table ?>"><?= $table ?></a>
<?php } ?>

<hr>

<h3>Insert into <?= $current_table ?></h3>

<?= $message ?>

<form method="post">
    <?php foreach ($columns as $col) {
        $field = $col['Field'];

        if ($field != "id" && $field != "created_at" && $field != "updated_at" && $field != "deleted_at") {
    ?>
            <?= $field ?>:
            <input type="text" name="<?= $field ?>" required>
    <?php
        }
    } ?>

    <button type="submit" name="insert">Insert</button>
</form>

<h3>Select from <?= $current_table ?></h3>

<table>
    <tr>
        <?php foreach ($columns as $col) { ?>
            <th><?= $col['Field'] ?></th>
        <?php } ?>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <?php foreach ($columns as $col) { ?>
                <td><?= $row[$col['Field']] ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>