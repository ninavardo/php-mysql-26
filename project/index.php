<?php
session_start();
require_once __DIR__ . "/config.php";

$users_query = "SELECT * FROM users WHERE deleted_at IS NULL";
$users_result = mysqli_query($connect, $users_query);
$users_data = mysqli_fetch_all($users_result, MYSQLI_ASSOC);

$categories_query = "SELECT * FROM categories WHERE deleted_at IS NULL";
$categories_result = mysqli_query($connect, $categories_query);
$categories_data = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);

$ingredients_query = "SELECT * FROM ingredients WHERE deleted_at IS NULL";
$ingredients_result = mysqli_query($connect, $ingredients_query);
$ingredients_data = mysqli_fetch_all($ingredients_result, MYSQLI_ASSOC);

$recipes_query = "SELECT recipes.*, users.name AS user_name, categories.name AS category_name 
    FROM recipes 
    LEFT JOIN users ON recipes.user_id = users.id 
    LEFT JOIN categories ON recipes.category_id = categories.id 
    WHERE recipes.deleted_at IS NULL";
$recipes_result = mysqli_query($connect, $recipes_query);
$recipes_data = mysqli_fetch_all($recipes_result, MYSQLI_ASSOC);

$recipe_ingredients_query = "SELECT recipe_ingredients.*, recipes.title AS recipe_title, ingredients.name AS ingredient_name 
    FROM recipe_ingredients 
    LEFT JOIN recipes ON recipe_ingredients.recipe_id = recipes.id 
    LEFT JOIN ingredients ON recipe_ingredients.ingredient_id = ingredients.id 
    WHERE recipe_ingredients.deleted_at IS NULL";
$recipe_ingredients_result = mysqli_query($connect, $recipe_ingredients_query);
$recipe_ingredients_data = mysqli_fetch_all($recipe_ingredients_result, MYSQLI_ASSOC);

$comments_query = "SELECT comments.*, users.name AS user_name, recipes.title AS recipe_title 
    FROM comments 
    LEFT JOIN users ON comments.user_id = users.id 
    LEFT JOIN recipes ON comments.recipe_id = recipes.id 
    WHERE comments.deleted_at IS NULL";
$comments_result = mysqli_query($connect, $comments_query);
$comments_data = mysqli_fetch_all($comments_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Culinary Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="recipes.php">Recipes</a>
        <?php if (isset($_SESSION['user_id'])) { ?>
            <span style="color:white;">Hello, <?= $_SESSION['user_name'] ?></span>
            <a href="logout.php">Logout</a>
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <a href="admin/index.php">Admin Panel</a>
            <?php } ?>
        <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } ?>
    </nav>

    <h1>Culinary Portal</h1>
    <p>Welcome to our recipe sharing website. All database tables are shown below.</p>

    <div class="section-box">
        <h2>Users Table</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created_at</th>
            </tr>
            <?php foreach ($users_data as $row) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['role'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="section-box">
        <h2>Categories Table</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created_at</th>
            </tr>
            <?php foreach ($categories_data as $row) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="section-box">
        <h2>Ingredients Table</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created_at</th>
            </tr>
            <?php foreach ($ingredients_data as $row) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="section-box">
        <h2>Recipes Table</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>User</th>
                <th>Category</th>
                <th>Description</th>
                <th>Cooking Time</th>
                <th>Difficulty</th>
                <th>Image</th>
            </tr>
            <?php foreach ($recipes_data as $row) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><a href="recipe_detail.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></td>
                <td><?= $row['user_name'] ?></td>
                <td><?= $row['category_name'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['cooking_time'] ?> min</td>
                <td><?= $row['difficulty'] ?></td>
                <td>
                    <?php if ($row['image'] != null && $row['image'] != "") { ?>
                        <img src="<?= $row['image'] ?>" width="80">
                    <?php } else { ?>
                        no image
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="section-box">
        <h2>Recipe Ingredients Table</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Recipe</th>
                <th>Ingredient</th>
                <th>Amount</th>
            </tr>
            <?php foreach ($recipe_ingredients_data as $row) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['recipe_title'] ?></td>
                <td><?= $row['ingredient_name'] ?></td>
                <td><?= $row['amount'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="section-box">
        <h2>Comments Table</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Recipe</th>
                <th>Comment</th>
                <th>Rating</th>
                <th>Created_at</th>
            </tr>
            <?php foreach ($comments_data as $row) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['user_name'] ?></td>
                <td><?= $row['recipe_title'] ?></td>
                <td><?= $row['comment'] ?></td>
                <td><?= $row['rating'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
