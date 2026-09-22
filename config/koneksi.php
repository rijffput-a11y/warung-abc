<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_warung_abc");
if (!$koneksi) { 
    die("Koneksi database gagal: " . mysqli_connect_error()); 
}
?>