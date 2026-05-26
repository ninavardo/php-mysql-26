<?php
session_start();
require_once __DIR__ . "/config.php";

$register_message = "";
$register_error = "";

if (isset($_POST['register_button'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    if ($password != $password2) {
        $register_error = "Passwords do not match";
    } else {
        $check_email = "SELECT id FROM users WHERE email = '$email'";
        $check_result = mysqli_query($connect, $check_email);

        if (mysqli_num_rows($check_result) > 0) {
            $register_error = "This email is already registered";
        } else {
            $insert_user = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'user')";
            mysqli_query($connect, $insert_user);
            $register_message = "Registration successful. You can login now.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Culinary Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="recipes.php">Recipes</a>
        <a href="login.php">Login</a>
    </nav>

    <h1>Register</h1>

    <?php if ($register_message != "") { ?>
        <div class="message"><?= $register_message ?></div>
    <?php } ?>

    <?php if ($register_error != "") { ?>
        <div class="message error"><?= $register_error ?></div>
    <?php } ?>

    <form method="post">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password2" required>

        <button type="submit" name="register_button">Register</button>
    </form>
</body>
</html>
