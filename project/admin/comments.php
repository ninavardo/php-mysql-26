<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
require_once __DIR__ . "/../config.php";

if (isset($_GET['drop'])) {
    $id = (int) $_GET['drop'];
    $delete_query = "UPDATE comments SET deleted_at = NOW() WHERE id = $id";
    mysqli_query($connect, $delete_query);
    header("Location: comments.php");
    exit;
}

if (isset($_POST['insert_button'])) {
    $user_id = (int) $_POST['user_id'];
    $recipe_id = (int) $_POST['recipe_id'];
    $comment = trim($_POST['comment']);
    $rating = (int) $_POST['rating'];
    $insert_query = "INSERT INTO comments (user_id, recipe_id, comment, rating) VALUES ($user_id, $recipe_id, '$comment', $rating)";
    mysqli_query($connect, $insert_query);
    header("Location: comments.php");
    exit;
}

if (isset($_POST['update_button']) && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $user_id = (int) $_POST['user_id'];
    $recipe_id = (int) $_POST['recipe_id'];
    $comment = trim($_POST['comment']);
    $rating = (int) $_POST['rating'];
    $date = date("Y-m-d H:i:s");
    $update_query = "UPDATE comments SET user_id = $user_id, recipe_id = $recipe_id, comment = '$comment', rating = $rating, updated_at = '$date' WHERE id = $id";
    mysqli_query($connect, $update_query);
    header("Location: comments.php");
    exit;
}

$users_list = mysqli_fetch_all(mysqli_query($connect, "SELECT id, name FROM users WHERE deleted_at IS NULL"), MYSQLI_ASSOC);
$recipes_list = mysqli_fetch_all(mysqli_query($connect, "SELECT id, title FROM recipes WHERE deleted_at IS NULL"), MYSQLI_ASSOC);

$select_query = "SELECT comments.*, users.name AS user_name, recipes.title AS recipe_title 
    FROM comments 
    LEFT JOIN users ON comments.user_id = users.id 
    LEFT JOIN recipes ON comments.recipe_id = recipes.id 
    WHERE comments.deleted_at IS NULL";
$result = mysqli_query($connect, $select_query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$edit_row = null;
if (isset($_GET['id']) && !isset($_POST['update_button'])) {
    $id = (int) $_GET['id'];
    $edit_query = "SELECT * FROM comments WHERE id = $id";
    $edit_result = mysqli_query($connect, $edit_query);
    $edit_row = mysqli_fetch_assoc($edit_result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Comments</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <a href="index.php">Admin Home</a>
        <a href="comments.php">Comments</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <h1>Manage Comments</h1>

    <?php if ($edit_row) { ?>
        <form method="post">
            <h3>Edit Comment</h3>
            <input type="hidden" name="id" value="<?= $edit_row['id'] ?>">
            <label>User</label>
            <select name="user_id" required>
                <?php foreach ($users_list as $u) { ?>
                    <option value="<?= $u['id'] ?>" <?php if ($edit_row['user_id'] == $u['id']) echo 'selected'; ?>><?= $u['name'] ?></option>
                <?php } ?>
            </select>
            <label>Recipe</label>
            <select name="recipe_id" required>
                <?php foreach ($recipes_list as $r) { ?>
                    <option value="<?= $r['id'] ?>" <?php if ($edit_row['recipe_id'] == $r['id']) echo 'selected'; ?>><?= $r['title'] ?></option>
                <?php } ?>
            </select>
            <label>Comment</label>
            <textarea name="comment" rows="3" required><?= $edit_row['comment'] ?></textarea>
            <label>Rating</label>
            <input type="number" name="rating" min="1" max="5" value="<?= $edit_row['rating'] ?>" required>
            <button type="submit" name="update_button">Update</button>
            <a href="comments.php">Cancel</a>
        </form>
    <?php } else { ?>
        <form method="post">
            <h3>Add Comment</h3>
            <label>User</label>
            <select name="user_id" required>
                <?php foreach ($users_list as $u) { ?>
                    <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>
                <?php } ?>
            </select>
            <label>Recipe</label>
            <select name="recipe_id" required>
                <?php foreach ($recipes_list as $r) { ?>
                    <option value="<?= $r['id'] ?>"><?= $r['title'] ?></option>
                <?php } ?>
            </select>
            <label>Comment</label>
            <textarea name="comment" rows="3" required></textarea>
            <label>Rating</label>
            <input type="number" name="rating" min="1" max="5" value="5" required>
            <button type="submit" name="insert_button">Insert</button>
        </form>
    <?php } ?>

    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Recipe</th>
            <th>Comment</th>
            <th>Rating</th>
            <th>Created_at</th>
            <th>Edit</th>
            <th>Drop</th>
        </tr>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['user_name'] ?></td>
            <td><?= $row['recipe_title'] ?></td>
            <td><?= $row['comment'] ?></td>
            <td><?= $row['rating'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><a href="?id=<?= $row['id'] ?>">EDIT</a></td>
            <td><a href="?drop=<?= $row['id'] ?>">DROP</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
