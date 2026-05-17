<?php
$connect = mysqli_connect("localhost", "root", "", "blog_db");
$select_query = "SELECT * FROM commetns WHERE deleted_at is NULL";
$roles_res = mysqli_query($connect, $select_query);
$data_of_roles_res = mysqli_fetch_all($roles_res);
?>
<?php
if (isset($_GET['drop'])) {
    $id = (int)$_GET['drop'];

    $delete_query = "UPDATE categorys SET deleted_at=NOW() WHERE id=$id";
    mysqli_query($connect, $delete_query);
}
?>
<?php
if (isset($_POST['name'], $_POST['id'])) {
    $name = trim($_POST['name']);
    $id = $_POST['id'];

    $update_query = "UPDATE categorys SET name='$name' WHERE id=$id";
    mysqli_query($connect, $update_query);

    header("Location: categorys_update_drop.php");
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $select_role = "SELECT * FROM categorys WHERE id=$id";
    $result = mysqli_query($connect, $select_role);
    $row_role_by_id = mysqli_fetch_assoc($result);
?>

    <form method="post">
        <h3>Update Form</h3>
        Role:
        <input type="text" name="name" value="<?= $row_role_by_id['name'] ?>">
        <input type="hidden" name="id" value="<?= $row_role_by_id['id'] ?>">
        <br><br>
        <button type="submit" name="update">Edit Role</button>
    </form>
<?php
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>POST_ID</th>
        <th>USER_ID</th>
        <th>COMMENT</th>
        <th>CREATED_AT</th>
        <th>UPDATED_AT</th>
    </tr>

    <?php
    foreach ($data_of_roles_res as $row) {
    ?>
        <tr>
            <th><?= $row[0] ?></th>
            <th><?= $row[1] ?></th>
            <th><?= $row[2] ?></th>
            <th><?= $row[3] ?></th>
            <th><?= $row[4] ?></th>
            <th><?= $row[5] ?></th>
            <th><?= $row[6] ?></th>
            <th><?= $row[8] ?></th>
        </tr>
    <?php
    }
    ?>
</table>