<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
require_once __DIR__ . "/../config.php";

$photos_folder = "../photos/";
if (!is_dir($photos_folder)) {
    mkdir($photos_folder, 0777, true);
}

if (isset($_GET['drop'])) {
    $id = (int) $_GET['drop'];
    $delete_query = "UPDATE recipes SET deleted_at = NOW() WHERE id = $id";
    mysqli_query($connect, $delete_query);
    header("Location: recipes.php");
    exit;
}

$users_list = mysqli_fetch_all(mysqli_query($connect, "SELECT id, name FROM users WHERE deleted_at IS NULL"), MYSQLI_ASSOC);
$categories_list = mysqli_fetch_all(mysqli_query($connect, "SELECT id, name FROM categories WHERE deleted_at IS NULL"), MYSQLI_ASSOC);

if (isset($_POST['insert_button'])) {
    $user_id = (int) $_POST['user_id'];
    $category_id = (int) $_POST['category_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $instructions = trim($_POST['instructions']);
    $cooking_time = (int) $_POST['cooking_time'];
    $difficulty = trim($_POST['difficulty']);
    $image_path = "NULL";

    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        $file_name = time() . "_" . $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $upload_path = $photos_folder . $file_name;
        move_uploaded_file($file_tmp, $upload_path);
        $image_path = "'photos/" . $file_name . "'";
    }

    $insert_query = "INSERT INTO recipes (user_id, category_id, title, description, instructions, cooking_time, difficulty, image) 
        VALUES ($user_id, $category_id, '$title', '$description', '$instructions', $cooking_time, '$difficulty', $image_path)";
    mysqli_query($connect, $insert_query);
    header("Location: recipes.php");
    exit;
}

if (isset($_POST['update_button']) && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $user_id = (int) $_POST['user_id'];
    $category_id = (int) $_POST['category_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $instructions = trim($_POST['instructions']);
    $cooking_time = (int) $_POST['cooking_time'];
    $difficulty = trim($_POST['difficulty']);
    $date = date("Y-m-d H:i:s");

    $image_sql = "";
    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        $file_name = time() . "_" . $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $upload_path = $photos_folder . $file_name;
        move_uploaded_file($file_tmp, $upload_path);
        $image_sql = ", image = 'photos/" . $file_name . "'";
    }

    $update_query = "UPDATE recipes SET user_id = $user_id, category_id = $category_id, title = '$title', 
        description = '$description', instructions = '$instructions', cooking_time = $cooking_time, 
        difficulty = '$difficulty', updated_at = '$date' $image_sql WHERE id = $id";
    mysqli_query($connect, $update_query);
    header("Location: recipes.php");
    exit;
}

$select_query = "SELECT recipes.*, users.name AS user_name, categories.name AS category_name 
    FROM recipes 
    LEFT JOIN users ON recipes.user_id = users.id 
    LEFT JOIN categories ON recipes.category_id = categories.id 
    WHERE recipes.deleted_at IS NULL";
$result = mysqli_query($connect, $select_query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$edit_row = null;
if (isset($_GET['id']) && !isset($_POST['update_button'])) {
    $id = (int) $_GET['id'];
    $edit_query = "SELECT * FROM recipes WHERE id = $id";
    $edit_result = mysqli_query($connect, $edit_query);
    $edit_row = mysqli_fetch_assoc($edit_result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Recipes</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <a href="index.php">Admin Home</a>
        <a href="recipes.php">Recipes</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <h1>Manage Recipes</h1>

    <?php if ($edit_row) { ?>
        <form method="post" enctype="multipart/form-data" action="recipes.php?id=<?= $edit_row['id'] ?>">
            <h3>Edit Recipe</h3>
            <input type="hidden" name="id" value="<?= $edit_row['id'] ?>">
            <label>User</label>
            <select name="user_id" required>
                <?php foreach ($users_list as $u) { ?>
                    <option value="<?= $u['id'] ?>" <?php if ($edit_row['user_id'] == $u['id']) echo 'selected'; ?>><?= $u['name'] ?></option>
                <?php } ?>
            </select>
            <label>Category</label>
            <select name="category_id" required>
                <?php foreach ($categories_list as $c) { ?>
                    <option value="<?= $c['id'] ?>" <?php if ($edit_row['category_id'] == $c['id']) echo 'selected'; ?>><?= $c['name'] ?></option>
                <?php } ?>
            </select>
            <label>Title</label>
            <input type="text" name="title" value="<?= $edit_row['title'] ?>" required>
            <label>Description</label>
            <textarea name="description" rows="2"><?= $edit_row['description'] ?></textarea>
            <label>Instructions</label>
            <textarea name="instructions" rows="3"><?= $edit_row['instructions'] ?></textarea>
            <label>Cooking time (minutes)</label>
            <input type="number" name="cooking_time" value="<?= $edit_row['cooking_time'] ?>" required>
            <label>Difficulty</label>
            <input type="text" name="difficulty" value="<?= $edit_row['difficulty'] ?>" required>
            <label>New image (optional)</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif">
            <?php if ($edit_row['image'] != null && $edit_row['image'] != "") { ?>
                <p>Current: <img src="../<?= $edit_row['image'] ?>" width="100"></p>
            <?php } ?>
            <button type="submit" name="update_button">Update</button>
            <a href="recipes.php">Cancel</a>
        </form>
    <?php } else { ?>
        <form method="post" enctype="multipart/form-data">
            <h3>Add Recipe</h3>
            <label>User</label>
            <select name="user_id" required>
                <?php foreach ($users_list as $u) { ?>
                    <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>
                <?php } ?>
            </select>
            <label>Category</label>
            <select name="category_id" required>
                <?php foreach ($categories_list as $c) { ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php } ?>
            </select>
            <label>Title</label>
            <input type="text" name="title" required>
            <label>Description</label>
            <textarea name="description" rows="2"></textarea>
            <label>Instructions</label>
            <textarea name="instructions" rows="3"></textarea>
            <label>Cooking time (minutes)</label>
            <input type="number" name="cooking_time" required>
            <label>Difficulty</label>
            <input type="text" name="difficulty" required>
            <label>Image</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif">
            <button type="submit" name="insert_button">Insert</button>
        </form>
    <?php } ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>User</th>
            <th>Category</th>
            <th>Time</th>
            <th>Difficulty</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Drop</th>
        </tr>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['user_name'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= $row['cooking_time'] ?></td>
            <td><?= $row['difficulty'] ?></td>
            <td>
                <?php if ($row['image'] != null && $row['image'] != "") { ?>
                    <img src="../<?= $row['image'] ?>" width="60">
                <?php } else { ?>
                    no image
                <?php } ?>
            </td>
            <td><a href="?id=<?= $row['id'] ?>">EDIT</a></td>
            <td><a href="?drop=<?= $row['id'] ?>">DROP</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
