<?php
// login.php
<<<<<<< HEAD
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
=======
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Login - Warung ABC</title></head>
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
<body>
    <h2>Login Warung ABC</h2>

    <?php
    if (isset($_SESSION['pesan_error'])) {
        echo "<p style='color:red;'>" . $_SESSION['pesan_error'] . "</p>";
        unset($_SESSION['pesan_error']);
    }
    ?>

    <form action="proses_login.php" method="POST">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Login"></td>
            </tr>
        </table>
    </form>
</body>
</html>