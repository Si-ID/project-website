<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php?pesan=login_dulu");
    exit;
}

// Cek role user (tambahkan pengecekan admin)
$email = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_user, role FROM users WHERE email='$email'"));

if (!$user) {
    die("User tidak ditemukan");
}

// Validasi data cart
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['cart_data'])) {
    header("Location: cart.php?error=invalid_data");
    exit;
}

$cart = json_decode($_POST['cart_data'], true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($cart)) {
    header("Location: cart.php?error=invalid_cart");
    exit;
}

// Mulai transaksi database
mysqli_begin_transaction($koneksi);

try {
    $total_harga = 0;
    foreach ($cart as $item) {
        $total_harga += $item['price'] * $item['quantity'];
    }

    // Simpan transaksi utama
    $insertTransaksi = mysqli_query($koneksi, 
        "INSERT INTO transaksi (id_user, total_harga) 
         VALUES ('".$user['id_user']."', '$total_harga')");

    if (!$insertTransaksi) {
        throw new Exception("Gagal menyimpan transaksi: " . mysqli_error($koneksi));
    }

    $id_transaksi = mysqli_insert_id($koneksi);

    // Simpan detail transaksi dan UPDATE stok
    foreach ($cart as $item) {
        $id_baju = (int)$item['id'];
        $jumlah = (int)$item['quantity'];
        $harga_satuan = (int)$item['price'];
        $subtotal = $jumlah * $harga_satuan;

        // Simpan detail
        $insertDetail = mysqli_query($koneksi,
            "INSERT INTO detail_transaksi 
             (id_transaksi, id_baju, jumlah, harga_satuan, subtotal) 
             VALUES ('$id_transaksi', '$id_baju', '$jumlah', '$harga_satuan', '$subtotal')");

        if (!$insertDetail) {
            throw new Exception("Gagal menyimpan detail transaksi: " . mysqli_error($koneksi));
        }

        // Update stok
        $updateStok = mysqli_query($koneksi,
            "UPDATE baju SET stok = stok - $jumlah WHERE id_baju = '$id_baju'");

        if (!$updateStok) {
            throw new Exception("Gagal update stok: " . mysqli_error($koneksi));
        }
    }

    mysqli_commit($koneksi);
    $_SESSION['last_transaksi'] = $id_transaksi;
    header("Location: struk.php");
    exit;

} catch (Exception $e) {
    mysqli_rollback($koneksi);
    header("Location: cart.php?error=checkout_failed");
    exit;
}