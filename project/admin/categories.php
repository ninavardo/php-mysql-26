<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
require_once __DIR__ . "/../config.php";

if (isset($_GET['drop'])) {
    $id = (int) $_GET['drop'];
    $delete_query = "UPDATE categories SET deleted_at = NOW() WHERE id = $id";
    mysqli_query($connect, $delete_query);
    header("Location: categories.php");
    exit;
}

if (isset($_POST['insert_button'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $insert_query = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    mysqli_query($connect, $insert_query);
    header("Location: categories.php");
    exit;
}

if (isset($_POST['update_button']) && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $date = date("Y-m-d H:i:s");
    $update_query = "UPDATE categories SET name = '$name', description = '$description', updated_at = '$date' WHERE id = $id";
    mysqli_query($connect, $update_query);
    header("Location: categories.php");
    exit;
}

$select_query = "SELECT * FROM categories WHERE deleted_at IS NULL";
$result = mysqli_query($connect, $select_query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$edit_row = null;
if (isset($_GET['id']) && !isset($_POST['update_button'])) {
    $id = (int) $_GET['id'];
    $edit_query = "SELECT * FROM categories WHERE id = $id";
    $edit_result = mysqli_query($connect, $edit_query);
    $edit_row = mysqli_fetch_assoc($edit_result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Categories</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <a href="index.php">Admin Home</a>
        <a href="categories.php">Categories</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <h1>Manage Categories</h1>

    <?php if ($edit_row) { ?>
        <form method="post">
            <h3>Edit Category</h3>
            <input type="hidden" name="id" value="<?= $edit_row['id'] ?>">
            <label>Name</label>
            <input type="text" name="name" value="<?= $edit_row['name'] ?>" required>
            <label>Description</label>
            <textarea name="description" rows="3"><?= $edit_row['description'] ?></textarea>
            <button type="submit" name="update_button">Update</button>
            <a href="categories.php">Cancel</a>
        </form>
    <?php } else { ?>
        <form method="post">
            <h3>Add Category</h3>
            <label>Name</label>
            <input type="text" name="name" required>
            <label>Description</label>
            <textarea name="description" rows="3"></textarea>
            <button type="submit" name="insert_button">Insert</button>
        </form>
    <?php } ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created_at</th>
            <th>Edit</th>
            <th>Drop</th>
        </tr>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><a href="?id=<?= $row['id'] ?>">EDIT</a></td>
            <td><a href="?drop=<?= $row['id'] ?>">DROP</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
