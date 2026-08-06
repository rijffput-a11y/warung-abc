<?php
session_start();
include 'includes/cek_session.php';

$id = $_GET['id'];
unset($_SESSION['keranjang'][$id]);

header('Location: transaksi.php');
exit;
?>