<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php?pesan=login_dulu");
    exit;
}

include("connect.php");
$email = $_SESSION['email'];
$query = mysqli_query($koneksi, "SELECT nama FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

// Get products from database
$products = mysqli_query($koneksi, "SELECT * FROM baju WHERE stok > 0");

// Image mapping
$product_images = [
    1 => 'assets/baju1.png',
    2 => 'assets/baju2.png',
    3 => 'assets/baju3.png',
    4 => 'assets/baju4.png',
    5 => 'assets/baju5.png',
    6 => 'assets/baju6.png'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Thrifture</title>
    <link rel="stylesheet" href="CSS/cart.css">
</head>
<body class="">

<!-- <nav class="navbar">
    <a href="index.php">&larr; Home</a>
    <div class="brand">thrifture<span>.</span></div>
    <div class="user-info">
        <i class="fas fa-user"></i> <?php echo $user['nama']; ?>
    </div>
</nav> -->

<header style="display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background-color: #f8f9fa; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
  <!-- Logo -->
  <div style="font-weight: bold; font-size: 28px; color: #c0392b;">
    Thrifture<span style="color: #c0392b;">.</span>
  </div>

  <!-- Tombol Kembali -->
  <a href="index.php" style="padding: 8px 16px; border: 2px solid #c0392b; color: #c0392b; border-radius: 6px; text-decoration: none; font-weight: 500;">
    Kembali
  </a>
</header>
    
<div class="container">
    <header>
        <div class="title">PRODUCT LIST</div>
        <div class="icon-cart">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
            </svg>
            <span id="cartCount">0</span>
        </div>
    </header>
    
    <div class="listProduct">
        <?php while($product = mysqli_fetch_assoc($products)): ?>
        <div class="item" data-id="<?php echo $product['id_baju']; ?>">
            <img src="<?php echo $product_images[$product['id_baju']] ?? 'assets/placeholder.jpg'; ?>" 
                 alt="<?php echo htmlspecialchars($product['nama_baju']); ?>">
            <h2><?php echo htmlspecialchars($product['nama_baju']); ?></h2>
            <div class="price">Rp<?php echo number_format($product['harga'], 0, ',', '.'); ?></div>
            <button class="addCart" 
                    data-id="<?php echo $product['id_baju']; ?>"
                    data-name="<?php echo htmlspecialchars($product['nama_baju']); ?>"
                    data-price="<?php echo $product['harga']; ?>"
                    data-stock="<?php echo $product['stok']; ?>"
                    data-image="<?php echo $product_images[$product['id_baju']] ?? 'assets/placeholder.jpg'; ?>">
                Add To Cart
            </button>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="cartTab">
    <h1>Shopping Cart</h1>
    <div class="listCart">
        <!-- Cart items will be loaded by JavaScript -->
    </div>
    <div class="btn">
        <button class="close">CLOSE</button>
        <form method="post" action="checkout_process.php">
            <input type="hidden" name="cart_data" id="cartDataInput">
            <button type="submit" class="checkOut">Check Out</button>
        </form>
    </div>
</div>

<script>
// Fungsi untuk update form sebelum submit
document.querySelector('form').addEventListener('submit', function(e) {
    document.getElementById('cartDataInput').value = JSON.stringify(cart);
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
<script src="main.js"></script>
</body>
</html>