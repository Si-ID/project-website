<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['last_transaksi'])) {
    header("Location: cart.php?error=no_transaction");
    exit;
}

$id_transaksi = $_SESSION['last_transaksi'];

// READ - Ambil data transaksi
$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT t.*, u.nama 
     FROM transaksi t
     JOIN users u ON t.id_user = u.id_user
     WHERE t.id_transaksi = '$id_transaksi'"));

if (!$transaksi) {
    die("Transaksi tidak ditemukan");
}

// READ - Ambil detail transaksi
$detail = mysqli_query($koneksi, 
    "SELECT dt.*, b.nama_baju 
     FROM detail_transaksi dt
     JOIN baju b ON dt.id_baju = b.id_baju
     WHERE dt.id_transaksi = '$id_transaksi'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembelian</title>
    <link rel="stylesheet" href="CSS/struk.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>

    <div class="receipt">
        <h1>Struk Pembelian</h1><br>
        <p><strong>No. Transaksi:</strong> <?= $transaksi['id_transaksi'] ?></p>
        <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'] ?? 'now')) ?></p>
        <p><strong>Pelanggan:</strong> <?= htmlspecialchars($transaksi['nama']) ?></p>
        
        <table>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($detail)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['nama_baju']) ?></td>
                <td>Rp<?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td>Rp<?= number_format($row['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="3" class="total">Total</td>
                <td>Rp<?= number_format($transaksi['total_harga'], 0, ',', '.') ?></td>
            </tr>
        </table>
        
        <p style="text-align: center; margin-top: 30px;">
            Terima kasih telah berbelanja di Thrifture!
        </p>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php" class="btn">Kembali ke Beranda</a>
            <button onclick="window.print()" class="btn">Cetak Struk</button>
        </div>
    </div>

</body>
</html>