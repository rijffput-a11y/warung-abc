<?php
session_start();
include 'config/koneksi.php';

if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        $error = "Username dan password wajib diisi!";
    } else {

        $username = mysqli_real_escape_string($koneksi, $username);

        $sql = "SELECT * FROM tbl_user 
                WHERE username = '$username' 
                LIMIT 1";

        $query = mysqli_query($koneksi, $sql);

        if ($query && mysqli_num_rows($query) > 0) {

            $user = mysqli_fetch_assoc($query);

            if (password_verify($password, $user['password']) || $password === $user['password']) {

                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

                // Mencegah Undefined array key "level"
                $_SESSION['level'] = $user['level'] ?? 'admin';

                header("Location: dashboard.php");
                exit;

            } else {
                $error = "Password salah!";
            }

        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warung ABC</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="login-page">

<div class="login-box">

    <h1>Warung ABC</h1>
    <p>Silakan login untuk melanjutkan</p>

    <?php if ($error != ""): ?>
        <div class="alert error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Username</label>
        <input 
            type="text" 
            name="username" 
            placeholder="Masukkan username"
            required
        >

        <label>Password</label>
        <input 
            type="password" 
            name="password" 
            placeholder="Masukkan password"
            required
        >

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>