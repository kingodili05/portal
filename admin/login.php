<?php
session_start();
$config = include('admin_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $config['admin_username'] && password_verify($password, $config['admin_password'])) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login-style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />

</head>

<body>
    <div class="login-box">
        <h1>Admin Login</h1>
        <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input id="login" type="submit" value="Login">
        </form>

    </div>
</body>