<?php
session_start();
require_once __DIR__ . "/config.php";

if (!isset($_GET['id'])) {
    header("Location: recipes.php");
    exit;
}

$recipe_id = (int) $_GET['id'];
$comment_message = "";

if (isset($_POST['add_comment']) && isset($_SESSION['user_id'])) {
    $comment_text = trim($_POST['comment']);
    $rating = (int) $_POST['rating'];
    $user_id = $_SESSION['user_id'];

    $insert_comment = "INSERT INTO comments (user_id, recipe_id, comment, rating) 
        VALUES ($user_id, $recipe_id, '$comment_text', $rating)";
    mysqli_query($connect, $insert_comment);
    $comment_message = "Comment added successfully";
}

$recipe_query = "SELECT recipes.*, users.name AS user_name, categories.name AS category_name 
    FROM recipes 
    LEFT JOIN users ON recipes.user_id = users.id 
    LEFT JOIN categories ON recipes.category_id = categories.id 
    WHERE recipes.id = $recipe_id AND recipes.deleted_at IS NULL";
$recipe_result = mysqli_query($connect, $recipe_query);
$recipe = mysqli_fetch_assoc($recipe_result);

if (!$recipe) {
    header("Location: recipes.php");
    exit;
}

$ingredients_query = "SELECT recipe_ingredients.amount, ingredients.name 
    FROM recipe_ingredients 
    LEFT JOIN ingredients ON recipe_ingredients.ingredient_id = ingredients.id 
    WHERE recipe_ingredients.recipe_id = $recipe_id AND recipe_ingredients.deleted_at IS NULL";
$ingredients_result = mysqli_query($connect, $ingredients_query);
$ingredients_data = mysqli_fetch_all($ingredients_result, MYSQLI_ASSOC);

$comments_query = "SELECT comments.*, users.name AS user_name 
    FROM comments 
    LEFT JOIN users ON comments.user_id = users.id 
    WHERE comments.recipe_id = $recipe_id AND comments.deleted_at IS NULL 
    ORDER BY comments.created_at DESC";
$comments_result = mysqli_query($connect, $comments_query);
$comments_data = mysqli_fetch_all($comments_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $recipe['title'] ?> - Culinary Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="recipes.php">Recipes</a>
        <?php if (isset($_SESSION['user_id'])) { ?>
            <span style="color:white;">Hello, <?= $_SESSION['user_name'] ?></span>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
        <?php } ?>
    </nav>

    <h1><?= $recipe['title'] ?></h1>

    <?php if ($recipe['image'] != null && $recipe['image'] != "") { ?>
        <img src="<?= $recipe['image'] ?>" style="max-width:400px;">
    <?php } ?>

    <p><strong>Category:</strong> <?= $recipe['category_name'] ?></p>
    <p><strong>Author:</strong> <?= $recipe['user_name'] ?></p>
    <p><strong>Cooking time:</strong> <?= $recipe['cooking_time'] ?> minutes</p>
    <p><strong>Difficulty:</strong> <?= $recipe['difficulty'] ?></p>
    <p><strong>Description:</strong> <?= $recipe['description'] ?></p>
    <p><strong>Instructions:</strong> <?= $recipe['instructions'] ?></p>

    <h2>Ingredients</h2>
    <table>
        <tr>
            <th>Ingredient</th>
            <th>Amount</th>
        </tr>
        <?php foreach ($ingredients_data as $ing) { ?>
        <tr>
            <td><?= $ing['name'] ?></td>
            <td><?= $ing['amount'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Comments</h2>

    <?php if ($comment_message != "") { ?>
        <div class="message"><?= $comment_message ?></div>
    <?php } ?>

    <?php if (isset($_SESSION['user_id'])) { ?>
        <form method="post">
            <label>Your comment</label>
            <textarea name="comment" rows="4" required></textarea>

            <label>Rating (1-5)</label>
            <select name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5" selected>5</option>
            </select>

            <button type="submit" name="add_comment">Add Comment</button>
        </form>
    <?php } else { ?>
        <p><a href="login.php">Login</a> to add a comment.</p>
    <?php } ?>

    <table>
        <tr>
            <th>User</th>
            <th>Comment</th>
            <th>Rating</th>
            <th>Date</th>
        </tr>
        <?php foreach ($comments_data as $c) { ?>
        <tr>
            <td><?= $c['user_name'] ?></td>
            <td><?= $c['comment'] ?></td>
            <td><?= $c['rating'] ?> / 5</td>
            <td><?= $c['created_at'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="recipes.php">Back to recipes</a>
</body>
</html>
