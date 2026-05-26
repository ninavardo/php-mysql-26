<?php
session_start();
require_once __DIR__ . "/config.php";

$login_error = "";

if (isset($_POST['login_button'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $select_user = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND deleted_at IS NULL";
    $result = mysqli_query($connect, $select_user);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];

        if ($user['role'] == 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $login_error = "Wrong email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Culinary Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="recipes.php">Recipes</a>
        <a href="register.php">Register</a>
    </nav>

    <h1>Login</h1>

    <?php if ($login_error != "") { ?>
        <div class="message error"><?= $login_error ?></div>
    <?php } ?>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login_button">Login</button>
    </form>

    <p>No account? <a href="register.php">Register here</a></p>
    <p>Admin test: admin@gmail.ge / 12345678</p>
</body>
</html>
