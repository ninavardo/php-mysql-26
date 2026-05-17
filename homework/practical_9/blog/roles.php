<link rel="stylesheet" href="style.css">
<?php
$connect = mysqli_connect("localhost", "root", "", "blog_db");
$select_roles_query = "SELECT * FROM roles WHERE deleted_at is NULL";
$roles_res = mysqli_query($connect, $select_roles_query);
$data_of_roles_res = mysqli_fetch_all($roles_res);
?>

<?php
if (isset($_GET['drop'])) {
    $id = $_GET['drop'];

    $drop_query = "UPDATE roles SET deleted_at=NOW() WHERE id=$id";
    mysqli_query($connect, $drop_query);
}
?>
<?php
if (isset($_POST["role"])) {
    $id = (int) $_POST['id'];
    $name = trim($_POST['role']);

    $update_query = "UPDATE roles SET role='$name',updated_at=NOW() WHERE id=$id";
    mysqli_query($connect, $update_query);

    header("Location: roles_update_drop.php");
}
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $select = "SELECT * FROM roles WHERE id=$id";
    $res = mysqli_query($connect, $select);
    $row_role_by_id = mysqli_fetch_assoc($res);
?>

    <form method="POST">
        <h2>UPDATE FORM</h2>

        <input type="hidden" name="id" value='<?= $row_role_by_id['id'] ?>'>

        <label>ROLE : </label>
        <input type="text" name="role" value='<?= $row_role_by_id['role'] ?>'><br><br>

        <button type="submit" name="submit">SUBMIT</button>
    </form>
<?php
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>Role</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>EDIT</th>
        <th>DROP</th>
    </tr>

    <?php
    foreach ($data_of_roles_res as $row) {
    ?>
        <tr>
            <td><?= $row[0] ?></td>
            <td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><a href="?id=<?= $row[0] ?>">EDIT</a></td>
            <td><a href="?drop=<?= $row[0] ?>">DROP</a></td>
        </tr>
    <?php
    }
    ?>
</table>