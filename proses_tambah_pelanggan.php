<?php
// proses_tambah_pelanggan.php
session_start();

include 'includes/cek_session.php';
include 'config/koneksi.php';

<?php

$id_kasir = $_SESSION['id_user'];

$id_pelanggan = !empty($_POST['id_pelanggan'])
    ? (int) $_POST['id_pelanggan']
    : null;

$id_pelanggan_sql = $id_pelanggan !== null
    ? "'$id_pelanggan'"
    : "NULL";

$no_transaksi = "TRX-" . date('YmdHis');
$tanggal = date('Y-m-d H:i:s');

$total = 0;

foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}

$sql = "INSERT INTO tbl_transaksi
        (no_transaksi, tanggal, id_kasir, id_pelanggan, total_bayar)";

$sql .= " VALUES
          ('$no_transaksi', '$tanggal', '$id_kasir',
           $id_pelanggan_sql, '$total')";

mysqli_query($koneksi, $sql);

$id_transaksi = mysqli_insert_id($koneksi);

$nama = mysqli_real_escape_string(
    $koneksi,
    $_POST['nama_pelanggan']
);

$hp = mysqli_real_escape_string(
    $koneksi,
    $_POST['no_hp']
);

$alamat = mysqli_real_escape_string(
    $koneksi,
    $_POST['alamat']
);

$sql = "INSERT INTO tbl_pelanggan (nama_pelanggan, no_hp, alamat)";
$sql .= " VALUES ('$nama', '$hp', '$alamat')";

if (mysqli_query($koneksi, $sql)) {

    $id_user = $_SESSION['id_user'];
    $waktu = date('Y-m-d H:i:s');
    $aktivitas = "tambah pelanggan: $nama";

    $log = "INSERT INTO tbl_log (id_user, aktivitas, waktu)";
    $log .= " VALUES ('$id_user', '$aktivitas', '$waktu')";

    mysqli_query($koneksi, $log);

    header('Location: data_pelanggan.php');
    exit;

} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>