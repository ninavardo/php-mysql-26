<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <a href="../index.php">Home</a>
        <a href="index.php">Admin Home</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <h1>Admin Panel</h1>
    <p>Hello admin <?= $_SESSION['user_name'] ?></p>

    <div class="admin-menu">
        <a href="users.php">Manage Users</a>
        <a href="categories.php">Manage Categories</a>
        <a href="ingredients.php">Manage Ingredients</a>
        <a href="recipes.php">Manage Recipes</a>
        <a href="recipe_ingredients.php">Manage Recipe Ingredients</a>
        <a href="comments.php">Manage Comments</a>
    </div>
</body>
</html>
