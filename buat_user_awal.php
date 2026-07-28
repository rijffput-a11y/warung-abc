<?php
include 'config/koneksi.php';

$nama = 'administrator';
$username = 'admin';
$password = password_hash('admin123',PASSWORD_DEFAULT);
$role = 'admin';

$sql ="INSERT INTO tbl_user (nama_lengkap, username,password, role)";
$sql .= "Values ('$nama', '$username', '$password', '$role')";

if(mysqli_query($koneksi, $sql)) {
    echo 'User admin berhasil dibuat. Silakan hapus file ini.';
} else {
    echo 'Gagal membuat user:' . mysql_error($koneksi);
}
?>