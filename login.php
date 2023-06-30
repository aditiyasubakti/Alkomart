<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: ./");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);
    $directory = 'database/users/';
    $filename = $directory . 'users.db';
    $passwordFile = $directory . 'password/' . $username . '.db';

    if (file_exists($filename)) {
        $users = file($filename, FILE_IGNORE_NEW_LINES);
        if (in_array($username, $users)) {
            if (file_exists($passwordFile) && file_get_contents($passwordFile) === $password) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                header("Location: ./");
                exit;
            }
        }
    }

    $error = "Username atau password salah.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php if (isset($error)) : ?>
        <p><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Belum memiliki akun? <a href="register.php">Daftar di sini</a></p>
</body>

</html>