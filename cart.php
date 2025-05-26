<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php?pesan=login_dulu");
    exit;
}

include("connect.php");
$email = $_SESSION['email'];
$query = mysqli_query($koneksi, "SELECT nama, role FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

// Get products from database
$products = mysqli_query($koneksi, "SELECT * FROM baju WHERE stok > 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Thrifture</title>
    <link rel="stylesheet" href="CSS/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="">

    <header style="display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background-color: #f8f9fa; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
      <!-- Logo -->
    <div style="font-weight: bold; font-size: 28px; color: #333;">Thrifture<span style="color: brown;">.</span>
    </div>

     <!-- Tombol Kembali Modern -->
    <a href="index.php" style="
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      background-color: white;
      border: 2px solid #c0392b;
      color: brown;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    "
    onmouseover="this.style.backgroundColor='brown'; this.style.color='white';"
    onmouseout="this.style.backgroundColor='white'; this.style.color='brown';">
    <i class="fas fa-arrow-right"></i> Kembali </a>
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
            <img src="<?php echo $product['gambar']; ?>" 
                 alt="<?php echo htmlspecialchars($product['nama_baju']); ?>">
            <h2><?php echo htmlspecialchars($product['nama_baju']); ?></h2>
            <div class="price">Rp<?php echo number_format($product['harga'], 0, ',', '.'); ?></div>
            <button class="addCart" 
                    data-id="<?php echo $product['id_baju']; ?>"
                    data-name="<?php echo htmlspecialchars($product['nama_baju']); ?>"
                    data-price="<?php echo $product['harga']; ?>"
                    data-stock="<?php echo $product['stok']; ?>"
                    data-image="<?php echo $product['gambar']; ?>">
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
document.querySelector('form').addEventListener('submit', function(e) {
    document.getElementById('cartDataInput').value = JSON.stringify(cart);
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
<script src="main.js"></script>
</body>
</html>