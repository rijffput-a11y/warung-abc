<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';

if (empty($_SESSION['keranjang'])) {

    $_SESSION['pesan_error'] =
        'Keranjang masih kosong!';

    header('Location: transaksi.php');
    exit;
}

$id_kasir = $_SESSION['id_user'];

$id_pelanggan = isset($_POST['id_pelanggan'])
    ? (int) $_POST['id_pelanggan']
    : 0;

if ($id_pelanggan <= 0) {

    $_SESSION['pesan_error'] =
        'Silakan pilih pelanggan terlebih dahulu.';

    header('Location: transaksi.php');
    exit;
}

$cek_pelanggan = mysqli_query(
    $koneksi,
    "SELECT id_pelanggan
     FROM tbl_pelanggan
     WHERE id_pelanggan='$id_pelanggan'"
);

if (
    !$cek_pelanggan ||
    mysqli_num_rows($cek_pelanggan) == 0
) {

    $_SESSION['pesan_error'] =
        'Pelanggan tidak ditemukan.';

    header('Location: transaksi.php');
    exit;
}

$no_transaksi =
    'TRX-' . date('YmdHis');

$tanggal =
    date('Y-m-d H:i:s');

$total = 0;

foreach (
    $_SESSION['keranjang']
    as $item
) {
    $total += $item['subtotal'];
}

mysqli_begin_transaction($koneksi);

try {

    $sql = "INSERT INTO tbl_transaksi
            (
                no_transaksi,
                tanggal,
                id_kasir,
                id_pelanggan,
                total_bayar
            )
            VALUES
            (
                '$no_transaksi',
                '$tanggal',
                '$id_kasir',
                '$id_pelanggan',
                '$total'
            )";

    if (!mysqli_query($koneksi, $sql)) {
        throw new Exception(
            mysqli_error($koneksi)
        );
    }

    $id_transaksi =
        mysqli_insert_id($koneksi);

    foreach (
        $_SESSION['keranjang']
        as $id_barang => $item
    ) {

        $id_barang = (int) $id_barang;
        $jumlah = (int) $item['jumlah'];
        $subtotal = $item['subtotal'];

        $cek_stok = mysqli_query(
            $koneksi,
            "SELECT stok
             FROM tbl_barang
             WHERE id_barang='$id_barang'
             FOR UPDATE"
        );

        $data_stok =
            mysqli_fetch_assoc($cek_stok);

        if (
            !$data_stok ||
            $data_stok['stok'] < $jumlah
        ) {

            throw new Exception(
                "Stok barang tidak mencukupi."
            );
        }

        $detail =
            "INSERT INTO tbl_detail_transaksi
            (
                id_transaksi,
                id_barang,
                jumlah,
                subtotal
            )
            VALUES
            (
                '$id_transaksi',
                '$id_barang',
                '$jumlah',
                '$subtotal'
            )";

        if (!mysqli_query($koneksi, $detail)) {
            throw new Exception(
                mysqli_error($koneksi)
            );
        }

        $update_stok =
            "UPDATE tbl_barang
             SET stok = stok - $jumlah
             WHERE id_barang='$id_barang'";

        if (!mysqli_query(
            $koneksi,
            $update_stok
        )) {

            throw new Exception(
                mysqli_error($koneksi)
            );
        }
    }

    $waktu =
        date('Y-m-d H:i:s');

    $aktivitas =
        "transaksi: $no_transaksi";

    $log =
        "INSERT INTO tbl_log
        (
            id_user,
            aktivitas,
            waktu
        )
        VALUES
        (
            '$id_kasir',
            '$aktivitas',
            '$waktu'
        )";

    mysqli_query($koneksi, $log);

    mysqli_commit($koneksi);

    unset($_SESSION['keranjang']);

    $_SESSION['pesan_sukses'] =
        "Transaksi berhasil disimpan.";

    header(
        'Location: riwayat_transaksi.php'
    );

    exit;

} catch (Exception $e) {

    mysqli_rollback($koneksi);

    $_SESSION['pesan_error'] =
        "Transaksi gagal: " . $e->getMessage();

    header('Location: transaksi.php');
    exit;
}
?>