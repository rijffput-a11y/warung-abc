<?php
// proses_login.php
session_start();
include 'config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

$sql   = "SELECT * FROM tbl_user WHERE username = '$username'";
$hasil = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($hasil) === 1) {
    $user = mysqli_fetch_assoc($hasil);
    
    if (password_verify($password, $user['password'])) {
        $_SESSION['login']        = true;
        $_SESSION['id_user']      = $user['id_user'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role']         = $user['role'];

        $id_user   = $user['id_user'];
        $waktu     = date('Y-m-d H:i:s');
        $aktivitas = "Login";
        $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', '$aktivitas', '$waktu')";
        mysqli_query($koneksi, $log);

        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['pesan_error'] = "Password salah!";
        header('Location: login.php');
        exit;
    }
} else {
    $_SESSION['pesan_error'] = "Username tidak ditemukan!";
    header('Location: login.php');
    exit;
}
?>