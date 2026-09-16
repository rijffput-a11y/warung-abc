<?php
// login.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Login Warung ABC</h2>

    <?php
    if (isset($_SESSION['pesan_error'])) {
        echo "<p style='color:red;'>" . $_SESSION['pesan_error'] . "</p>";
        unset($_SESSION['pesan_error']);
    }
    ?>

    <form action="proses_login.php" method="POST">
        Username:
        <input type="text" name="username" required>
        Password:
        <input type="password" name="password" required>
        <input type="submit" value="Login">
    </form>
</body>
</html>