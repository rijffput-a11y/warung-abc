<?php
// config/koneksi.php
<<<<<<< HEAD
=======

>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
$host     = "localhost";
$user     = "root";
$password = "";
$database = "db_warung_abc";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
<<<<<<< HEAD
}
=======
}
?>
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
