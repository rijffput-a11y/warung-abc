<?php
// login.php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Login - Warung ABC</title></head>
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