<!DOCTYPE html>
<html>

<head>
    <title>Registrasi</title>
</head>

<body>
    <h2>Registrasi</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit" name="register">Register</button>
    </form>
</body>

</html>

<?php

if (isset($_POST['register'])) {
    // Memeriksa apakah data registrasi sudah dikirimkan melalui metode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Memeriksa apakah data yang dibutuhkan (username dan password) sudah diisi
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Menggunakan mekanisme penyimpanan data sederhana (misalnya, file)
            $directory = 'database/users/';
            $filename = $directory . 'users.db';

            // Memeriksa apakah direktori dan file sudah ada
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }

            if (file_exists($filename)) {
                // Memeriksa apakah username sudah terdaftar
                $users = file($filename, FILE_IGNORE_NEW_LINES);
                if (in_array($username, $users)) {
                    echo "Username sudah terdaftar. Silakan gunakan username lain.";
                    exit;
                }
            }

            // Menambahkan username baru ke file users.db
            file_put_contents($filename, $username . PHP_EOL, FILE_APPEND);

            // Menyimpan password dalam file terpisah dengan nama file yang sama dengan username
            $passwordFile = $directory . 'password/' . $username . '.db';
            file_put_contents($passwordFile, $password);

            echo "Registrasi berhasil. Silakan login dengan username dan password Anda.";
        }
    }
}
?>