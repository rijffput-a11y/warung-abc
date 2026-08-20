<?php

include 'includes/cek_session.php';

$id_barang = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;

if (
    $id_barang > 0 &&
    isset($_SESSION['keranjang'][$id_barang])
) {

    unset(
        $_SESSION['keranjang'][$id_barang]
    );
}

header("Location: transaksi.php");
exit;
?>