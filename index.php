<?php
session_start();
include("connect.php");
$loggedIn = isset($_SESSION['email']);

if($loggedIn) {

    $email = $_SESSION['email'];
    $query = mysqli_query($koneksi, "SELECT id_user, nama, username,role FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);
    $isAdmin = ($user['role'] == 'admin');
}
// Query Untuk mengambil dari db
$productsQuery = mysqli_query($koneksi, "SELECT * FROM baju ORDER BY id_baju DESC");
$products = [];
while($row = mysqli_fetch_assoc($productsQuery)) {
$products[] = $row;
}

  // $queryy = "SELECT * FROM users WHERE id_user = '$user[id_user]'";
  // $sql = mysqli_query($koneksi, $queryy);
  // $resultt = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trifthture</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="CSS/style.css">
  <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
  <header>
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">thrifture<span>.</span></a>
    <nav class="navbar">
      <a href="#home">home</a>
      <a href="#about">about</a>
      <a href="#products">products</a>
      <a href="#founder">founder</a>
    </nav>

    <div class="icons">
    <?php if($loggedIn): ?>
        <?php if($isAdmin): ?>
            <!-- Tampilan untuk Admin -->
            <a href="admin.php" class="fas fa-user-cog"></a>
        <?php else: ?>
            <!-- Tampilan untuk User Biasa -->
            <a href="cart.php" class="fas fa-shopping-cart"></a>
        <?php endif; ?>
        
        <div class="user-welcome">
            <a href="user.php?id_user=<?php echo $user['id_user'] ?>" class="fas fa-user"></a>
            <span><?php echo htmlspecialchars($user['username']); ?></span>
        </div>
        <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i></a>
    <?php else: ?>
        <!-- Tampilan untuk Guest -->
        <a href="login.php?pesan=login_dulu" class="fas fa-shopping-cart"></a>
        <a href="register.php" class="fas fa-user"></a>
    <?php endif; ?>
</div>
  </header>

  <section class="home" id="home" style="background: url('assets/bg.png') no-repeat center center/cover; min-height: 100vh; display: flex; align-items: center;">
    <div class="content">
      <h3>Thrifture</h3>
      <span>sustainable style, affordable price</span>
      <p>Discover unique fashion pieces that are stylish, eco-friendly, and budget-friendly. It's time to stand out—without breaking the bank!</p>
      <a href="cart.php" class="btn">Shop Now</a>
    </div>
  </section>

  <section class="about" id="about">
    <h1 class="heading"><span>about </span>us</h1>
    <div class="row">
      <div class="video-container">
      <video src="assets/vid.mp4" loop autoplay muted></video>
      <h3>best thrifting shop</h3>
    </div>

    <div class="content">
      <h3>why choose us?</h3>
        <p class="text-muted">
          Thrifture bukan hanya sekadar toko thrifting online. Kami adalah tempat di mana pakaian mendapatkan kehidupan kedua, cerita lama menemukan pemilik baru, dan setiap pembelian adalah langkah kecil menuju masa depan yang lebih berkelanjutan. Kami dengan cermat memilih setiap item yang kami tawarkan, memastikan kualitas dan keunikannya sehingga Anda dapat menemukan harta karun fesyen yang benar-benar istimewa.
        </p>
        <p class="text-muted">
          Bergabunglah dengan gerakan thrifting bersama Thrifture. Jelajahi pilihan kami yang terus bertambah, temukan gaya unik Anda, dan mari bersama-sama kita memberikan dampak positif bagi planet ini, satu pakaian pre-loved pada satu waktu.
        </p>
        <a href="learnmore.php" class="btn btn-dark align-self-start px-4 py-2 mt-2">Learn More</a>
    </div>
  </section>

  <section class="icons-container">
    <div class="icons">
      <img src="assets/icon1.png" alt="">
      <div class="info">
        <h3>free deilvery</h3>
        <span>max. 3 orders</span>
      </div>
    </div>

    <div class="icons">
      <img src="assets/icon2.png" alt="">
      <div class="info">
        <h3>3 days return</h3>
        <span>moneyback guarantee</span>
      </div>
    </div>

    <div class="icons">
      <img src="assets/icon3.png" alt="">
      <div class="info">
        <h3>secured payment</h3>
        <span>supported by gepay</span>
      </div>
    </div>

    <div class="icons">
      <img src="assets/icon4.png" alt="">
      <div class="info">
        <h3>discount %</h3>
        <span>every month</span>
      </div>
    </div>
  </section>

  <section class="products" id="products">
    <h1 class="heading">latest <span>products</span> </h1>
    
    <?php if(!$loggedIn): ?>
    <div style="text-align: center; margin-bottom: 20px; color: #ff7800;">
      <p>Please <a href="login.php" style="color: #ff7800; text-decoration: underline;">login</a> to add products to your cart!</p>
    </div>
    <?php endif; ?>
    
 <div class="box-container">
      <?php foreach($products as $product): ?>
        <div class="box">
          <div class="image">
            <img src="<?php echo htmlspecialchars($product['gambar']); ?>" alt="<?php echo htmlspecialchars($product['nama_baju']); ?>">
          </div>
          <div class="content">
            <h3><?php echo htmlspecialchars($product['nama_baju']); ?></h3>
            <div class="price">Rp. <?php echo number_format($product['harga'], 0, ',', '.'); ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <section id="founder" class="founder-section">
      <h1 class="heading"><span>Our </span>Founder</h1><br><br>
 
    
    <div class="founder-grid">
      <!-- Founder 1 -->
      <div class="founder-card">
        <img src="assets/valdo.jpg" alt="Founder 1" class="founder-photo" />
        <div class="founder-info">
          <h3>Novaldo Putra Nugraha</h3>
          <p>Co-Founder & CEO</p>
          <p>
            Dengan semangat untuk menciptakan perubahan dalam dunia fashion, 
            <strong>Novaldo Putra Nugraha</strong> berkomitmen untuk membangun Thrifture sebagai platform thrifting yang terpercaya.
          </p>
        </div>
      </div>

      <!-- Founder 2 -->
      <div class="founder-card">
        <img src="assets/tata.jpg" alt="Founder 2" class="founder-photo" />
        <div class="founder-info">
          <h3>Naftali Margareta Gultom</h3>
          <p>Co-Founder & CTO</p>
          <p>
            <strong>Naftali Margareta Gultom</strong> memadukan teknologi dan kreativitas untuk menghadirkan pengalaman berbelanja thrift yang modern, cepat, dan ramah pengguna.
          </p>
        </div>
       </div>
      </div>
    </section>



    <section class="footer">
        <div class="footer-box">
          <h3>quick links</h3>
          <a href="#home">home</a>
          <a href="#about">about</a>
          <a href="#products">products</a>
          <a href="#contact">contact</a>
        </div>

        <div class="footer-box">
          <h3>extra links</h3>
          <a href="user.php">my account</a>
          <a href="cart.php">my order</a>
        </div>

        <div class="footer-box">
          <h3>locations</h3>
          <a>bekasi</a>
          <a>ciamis</a>
          <a>malang</a>
          <a>cikarang</a>
        </div>

        
        <div class="footer-box">
          <h3>contact info</h3>
          <a href="#">+123-456-789</a>
          <a href="#">example@gmail.com</a>
          <a href="#">seturan, yogyakarta - 50013</a>
          <img src="" alt="">
        </div>

      </div>

    </section>

  </section>
  
  <script>
  function addToCart(productName, price) {
    // This is a simple function to handle adding to cart
    // In a real implementation, you might use AJAX to save to server or localStorage
    alert(productName + " added to your cart!");
    
    // Here you could implement logic to add to cart using AJAX or localStorage
    // For example:
    // let cart = JSON.parse(localStorage.getItem('cart')) || [];
    // cart.push({name: productName, price: price, quantity: 1});
    // localStorage.setItem('cart', JSON.stringify(cart));
  }
  </script>
</body>
</html>