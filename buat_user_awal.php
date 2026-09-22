<?php
include 'config/koneksi.php';
$nama = "Administrator";
$user = "admin";
$pass = password_hash('admin123', PASSWORD_DEFAULT);
$role = "admin";

$sql = "INSERT INTO tbl_user (nama_lengkap, username, password, role) VALUES ('$nama', '$user', '$pass', '$role')";
if (mysqli_query($koneksi, $sql)) {
    echo "User admin berhasil dibuat (admin / admin123). Silakan login.";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
?>