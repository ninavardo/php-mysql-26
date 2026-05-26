<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
require_once __DIR__ . "/../config.php";

if (isset($_GET['drop'])) {
    $id = (int) $_GET['drop'];
    $delete_query = "UPDATE recipe_ingredients SET deleted_at = NOW() WHERE id = $id";
    mysqli_query($connect, $delete_query);
    header("Location: recipe_ingredients.php");
    exit;
}

if (isset($_POST['insert_button'])) {
    $recipe_id = (int) $_POST['recipe_id'];
    $ingredient_id = (int) $_POST['ingredient_id'];
    $amount = trim($_POST['amount']);
    $insert_query = "INSERT INTO recipe_ingredients (recipe_id, ingredient_id, amount) VALUES ($recipe_id, $ingredient_id, '$amount')";
    mysqli_query($connect, $insert_query);
    header("Location: recipe_ingredients.php");
    exit;
}

if (isset($_POST['update_button']) && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $recipe_id = (int) $_POST['recipe_id'];
    $ingredient_id = (int) $_POST['ingredient_id'];
    $amount = trim($_POST['amount']);
    $date = date("Y-m-d H:i:s");
    $update_query = "UPDATE recipe_ingredients SET recipe_id = $recipe_id, ingredient_id = $ingredient_id, amount = '$amount', updated_at = '$date' WHERE id = $id";
    mysqli_query($connect, $update_query);
    header("Location: recipe_ingredients.php");
    exit;
}

$recipes_list = mysqli_fetch_all(mysqli_query($connect, "SELECT id, title FROM recipes WHERE deleted_at IS NULL"), MYSQLI_ASSOC);
$ingredients_list = mysqli_fetch_all(mysqli_query($connect, "SELECT id, name FROM ingredients WHERE deleted_at IS NULL"), MYSQLI_ASSOC);

$select_query = "SELECT recipe_ingredients.*, recipes.title AS recipe_title, ingredients.name AS ingredient_name 
    FROM recipe_ingredients 
    LEFT JOIN recipes ON recipe_ingredients.recipe_id = recipes.id 
    LEFT JOIN ingredients ON recipe_ingredients.ingredient_id = ingredients.id 
    WHERE recipe_ingredients.deleted_at IS NULL";
$result = mysqli_query($connect, $select_query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$edit_row = null;
if (isset($_GET['id']) && !isset($_POST['update_button'])) {
    $id = (int) $_GET['id'];
    $edit_query = "SELECT * FROM recipe_ingredients WHERE id = $id";
    $edit_result = mysqli_query($connect, $edit_query);
    $edit_row = mysqli_fetch_assoc($edit_result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Recipe Ingredients</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <a href="index.php">Admin Home</a>
        <a href="recipe_ingredients.php">Recipe Ingredients</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <h1>Manage Recipe Ingredients</h1>

    <?php if ($edit_row) { ?>
        <form method="post">
            <h3>Edit Recipe Ingredient</h3>
            <input type="hidden" name="id" value="<?= $edit_row['id'] ?>">
            <label>Recipe</label>
            <select name="recipe_id" required>
                <?php foreach ($recipes_list as $r) { ?>
                    <option value="<?= $r['id'] ?>" <?php if ($edit_row['recipe_id'] == $r['id']) echo 'selected'; ?>><?= $r['title'] ?></option>
                <?php } ?>
            </select>
            <label>Ingredient</label>
            <select name="ingredient_id" required>
                <?php foreach ($ingredients_list as $i) { ?>
                    <option value="<?= $i['id'] ?>" <?php if ($edit_row['ingredient_id'] == $i['id']) echo 'selected'; ?>><?= $i['name'] ?></option>
                <?php } ?>
            </select>
            <label>Amount</label>
            <input type="text" name="amount" value="<?= $edit_row['amount'] ?>" required>
            <button type="submit" name="update_button">Update</button>
            <a href="recipe_ingredients.php">Cancel</a>
        </form>
    <?php } else { ?>
        <form method="post">
            <h3>Add Recipe Ingredient</h3>
            <label>Recipe</label>
            <select name="recipe_id" required>
                <?php foreach ($recipes_list as $r) { ?>
                    <option value="<?= $r['id'] ?>"><?= $r['title'] ?></option>
                <?php } ?>
            </select>
            <label>Ingredient</label>
            <select name="ingredient_id" required>
                <?php foreach ($ingredients_list as $i) { ?>
                    <option value="<?= $i['id'] ?>"><?= $i['name'] ?></option>
                <?php } ?>
            </select>
            <label>Amount</label>
            <input type="text" name="amount" required>
            <button type="submit" name="insert_button">Insert</button>
        </form>
    <?php } ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Recipe</th>
            <th>Ingredient</th>
            <th>Amount</th>
            <th>Created_at</th>
            <th>Edit</th>
            <th>Drop</th>
        </tr>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['recipe_title'] ?></td>
            <td><?= $row['ingredient_name'] ?></td>
            <td><?= $row['amount'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><a href="?id=<?= $row['id'] ?>">EDIT</a></td>
            <td><a href="?drop=<?= $row['id'] ?>">DROP</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
