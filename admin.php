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
        
        // Handle file upload
        $gambar = 'assets/placeholder.jpg';
        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "assets/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            // Check if image file is a actual image
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                // Generate unique filename
                $new_filename = uniqid() . '.' . $imageFileType;
                $target_file = $target_dir . $new_filename;
                
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
    } elseif (isset($_POST['update_produk'])) {
        // Handle update produk
        $id_baju = (int)$_POST['id_baju'];
        $nama_baju = mysqli_real_escape_string($koneksi, $_POST['nama_baju']);
        $harga = (int)$_POST['harga'];
        $stok = (int)$_POST['stok'];
        
        $query = "UPDATE baju SET nama_baju='$nama_baju', harga=$harga, stok=$stok WHERE id_baju=$id_baju";
        mysqli_query($koneksi, $query);
        
        // Handle gambar update jika ada
        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "assets/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                $new_filename = uniqid() . '.' . $imageFileType;
                $target_file = $target_dir . $new_filename;
                
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    mysqli_query($koneksi, "UPDATE baju SET gambar='$target_file' WHERE id_baju=$id_baju");
                }
            }
        }
    }
}

// Ambil semua produk
$products = mysqli_query($koneksi, "SELECT * FROM baju");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Thrifture</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        img { max-width: 100px; height: auto; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; }
        .btn { padding: 8px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .btn-danger { background-color: #f44336; }
    </style>
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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama Baju</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($product = mysqli_fetch_assoc($products)): ?>
                <tr>
                    <td><?php echo $product['id_baju']; ?></td>
                    <td><img src="<?php echo $product['gambar']; ?>" alt="<?php echo htmlspecialchars($product['nama_baju']); ?>"></td>
                    <td><?php echo htmlspecialchars($product['nama_baju']); ?></td>
                    <td>Rp<?php echo number_format($product['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $product['stok']; ?></td>
                    <td>
                        <form method="post" style="display:inline;" enctype="multipart/form-data">
                            <input type="hidden" name="id_baju" value="<?php echo $product['id_baju']; ?>">
                            <input type="text" name="nama_baju" value="<?php echo htmlspecialchars($product['nama_baju']); ?>" required>
                            <input type="number" name="harga" value="<?php echo $product['harga']; ?>" required>
                            <input type="number" name="stok" value="<?php echo $product['stok']; ?>" required>
                            <input type="file" name="gambar">
                            <button type="submit" name="update_produk" class="btn">Update</button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id_baju" value="<?php echo $product['id_baju']; ?>">
                            <button type="submit" name="hapus_produk" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <p><a href="index.php">Kembali ke home</a></p>
    </div>
</body>
</html>