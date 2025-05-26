<?php
session_start();
include 'connect.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php?pesan=akses_ditolak");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tambah_produk'])) {
        // Handle tambah produk
        $nama_baju = mysqli_real_escape_string($koneksi, $_POST['nama_baju']);
        $harga = (int)$_POST['harga'];
        $stok = (int)$_POST['stok'];
        
        $gambar = 'assets/placeholder.jpg';
        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "assets/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    $gambar = $target_file;
                }
            }
        }
        
        $query = "INSERT INTO baju (nama_baju, harga, stok, gambar) VALUES ('$nama_baju', $harga, $stok, '$gambar')";
        mysqli_query($koneksi, $query);
    } elseif (isset($_POST['hapus_produk'])) {
        // Handle hapus produk
        $id_baju = (int)$_POST['id_baju'];
        mysqli_query($koneksi, "DELETE FROM baju WHERE id_baju = $id_baju");
    } elseif (isset($_POST['update_all'])) {
        // Handle update semua produk sekaligus
        foreach ($_POST['products'] as $id => $product_data) {
            $id_baju = (int)$id;
            $nama_baju = mysqli_real_escape_string($koneksi, $product_data['nama_baju']);
            $harga = (int)$product_data['harga'];
            $stok = (int)$product_data['stok'];
            
            $query = "UPDATE baju SET nama_baju='$nama_baju', harga=$harga, stok=$stok WHERE id_baju=$id_baju";
            mysqli_query($koneksi, $query);
            
            // Handle gambar update jika ada
            if (isset($_FILES['products_gambar']['tmp_name'][$id]) && 
                $_FILES['products_gambar']['error'][$id] === UPLOAD_ERR_OK) {
                
                $target_dir = "assets/";
                $target_file = $target_dir . basename($_FILES['products_gambar']['name'][$id]);
                
                $check = getimagesize($_FILES['products_gambar']['tmp_name'][$id]);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES['products_gambar']['tmp_name'][$id], $target_file)) {
                        mysqli_query($koneksi, "UPDATE baju SET gambar='$target_file' WHERE id_baju=$id_baju");
                    }
                }
            }
        }
    }
}

// Ambil semua produk
$products = mysqli_query($koneksi, "SELECT * FROM baju ORDER BY id_baju");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Thrifture</title>
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>

    <div class="container">
        <h1>Admin Panel - Kelola Produk</h1>
        <h2>Tambah Produk Baru</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_baju">Nama Baju:</label>
                <input type="text" id="nama_baju" name="nama_baju" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" id="gambar" name="gambar" accept="image/*">
            </div>
            <button type="submit" name="tambah_produk" class="btn">Tambah Produk</button>
        </form>
        
        <h2>Daftar Produk</h2>
        <form method="post" enctype="multipart/form-data">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Baju</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $counter = 1;
                    while($product = mysqli_fetch_assoc($products)): 
                    ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td>
                            <img src="<?php echo $product['gambar']; ?>" alt="<?php echo htmlspecialchars($product['nama_baju']); ?>">
                            <input type="file" name="products_gambar[<?php echo $product['id_baju']; ?>]">
                        </td>
                        <td><input type="text" name="products[<?php echo $product['id_baju']; ?>][nama_baju]" value="<?php echo htmlspecialchars($product['nama_baju']); ?>" required></td>
                        <td><input type="number" name="products[<?php echo $product['id_baju']; ?>][harga]" value="<?php echo $product['harga']; ?>" required></td>
                        <td><input type="number" name="products[<?php echo $product['id_baju']; ?>][stok]" value="<?php echo $product['stok']; ?>" required></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id_baju" value="<?php echo $product['id_baju']; ?>">
                                <button type="submit" name="hapus_produk" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="update-all-container">
                <button type="submit" name="update_all" class="btn">Update Semua Produk</button>
            </div>
        </form>
        
        <p><a href="index.php">Kembali ke home</a></p>
    </div>
</body>
</html>