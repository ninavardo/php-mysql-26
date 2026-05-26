<?php
session_start();
require_once __DIR__ . "/config.php";

$search_text = "";
$category_filter = "";

if (isset($_GET['search'])) {
    $search_text = trim($_GET['search']);
}

if (isset($_GET['category_id']) && $_GET['category_id'] != "") {
    $category_filter = (int) $_GET['category_id'];
}

$recipes_query = "SELECT recipes.*, users.name AS user_name, categories.name AS category_name 
    FROM recipes 
    LEFT JOIN users ON recipes.user_id = users.id 
    LEFT JOIN categories ON recipes.category_id = categories.id 
    WHERE recipes.deleted_at IS NULL";

if ($search_text != "") {
    $recipes_query .= " AND recipes.title LIKE '%$search_text%'";
}

if ($category_filter != "") {
    $recipes_query .= " AND recipes.category_id = $category_filter";
}

$recipes_result = mysqli_query($connect, $recipes_query);
$recipes_data = mysqli_fetch_all($recipes_result, MYSQLI_ASSOC);

$categories_query = "SELECT * FROM categories WHERE deleted_at IS NULL";
$categories_result = mysqli_query($connect, $categories_query);
$categories_data = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipes - Culinary Portal</title>
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

    <h1>Recipes</h1>

    <form method="get" style="width:100%; max-width:600px;">
        <label>Search by title</label>
        <input type="text" name="search" value="<?= $search_text ?>">

        <label>Filter by category</label>
        <select name="category_id">
            <option value="">All categories</option>
            <?php foreach ($categories_data as $cat) { ?>
                <option value="<?= $cat['id'] ?>" <?php if ($category_filter == $cat['id']) echo "selected"; ?>>
                    <?= $cat['name'] ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Search</button>
        <a href="recipes.php">Clear</a>
    </form>

    <hr>

    <?php if (count($recipes_data) == 0) { ?>
        <p>No recipes found.</p>
    <?php } ?>

    <?php foreach ($recipes_data as $recipe) { ?>
        <div class="recipe-card">
            <?php if ($recipe['image'] != null && $recipe['image'] != "") { ?>
                <img src="<?= $recipe['image'] ?>" alt="<?= $recipe['title'] ?>">
            <?php } else { ?>
                <p>No image</p>
            <?php } ?>
            <h3><?= $recipe['title'] ?></h3>
            <p><strong>Category:</strong> <?= $recipe['category_name'] ?></p>
            <p><strong>By:</strong> <?= $recipe['user_name'] ?></p>
            <p><strong>Time:</strong> <?= $recipe['cooking_time'] ?> min</p>
            <p><strong>Difficulty:</strong> <?= $recipe['difficulty'] ?></p>
            <a href="recipe_detail.php?id=<?= $recipe['id'] ?>">View details</a>
        </div>
    <?php } ?>
</body>
</html>
