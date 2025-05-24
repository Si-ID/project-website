<?php
session_start();
$loggedIn = isset($_SESSION['email']);

if($loggedIn) {
    include("connect.php");
    $email = $_SESSION['email'];
    $query = mysqli_query($koneksi, "SELECT id_user, nama FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);
}
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
      <a href="#contact">contact</a>
    </nav>

    <div class="icons">
      <a href="<?php echo $loggedIn ? 'cart.php' : 'login.php?pesan=login_dulu'; ?>" class="fas fa-shopping-cart"></a>

      <?php if($loggedIn): ?>
        <div class="user-welcome">
          <a href="profil.php?id=<?php echo $user['id_user'] ?>" class="fas fa-user"></a>
          <span><?php echo htmlspecialchars($user['nama']);?><span>
        </div>
        <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i></a>
      <?php else: ?>
        <a href="register.php" class="fas fa-user"></a>
      <?php endif; ?>
    </div>
  </header>

  <section class="home" id="home" style="background: url('assets/bg.png') no-repeat center center/cover; min-height: 100vh; display: flex; align-items: center;">>
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
      <p>Thrifture bukan hanya sekadar toko thrifting online. Kami adalah tempat di mana pakaian mendapatkan kehidupan kedua, cerita lama menemukan pemilik baru, dan setiap pembelian adalah langkah kecil menuju masa depan yang lebih berkelanjutan. Kami dengan cermat memilih setiap item yang kami tawarkan, memastikan kualitas dan keunikannya sehingga Anda dapat menemukan harta karun fesyen yang benar-benar istimewa.</p>
      <p>Bergabunglah dengan gerakan thrifting bersama Thrifture. Jelajahi pilihan kami yang terus bertambah, temukan gaya unik Anda, dan mari bersama-sama kita memberikan dampak positif bagi planet ini, satu pakaian pre-loved pada satu waktu.</p>
      <a href="#" class="btn">learn more</a>
    </div>
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

      <div class="box">
        <div class="image">
          <img src="assets/baju1.png" alt="">
        </div>
        <div class="content">
          <h3>blue blouse</h3>
          <div class="price">Rp. 50k</div>
        </div>
      </div>

      <div class="box">
        <div class="image">
          <img src="assets/baju2.png" alt="">
        </div>
        <div class="content">
          <h3>brown blouse</h3>
          <div class="price">Rp. 45k</div>
        </div>
      </div>

      <div class="box">
        <div class="image">
          <img src="assets/baju3.png" alt="">
        </div>
        <div class="content">
          <h3>blue coquette blouse</h3>
          <div class="price">Rp. 35k</div>
        </div>
      </div>

      <div class="box">
        <div class="image">
          <img src="assets/baju4.png" alt="">
        </div>
        <div class="content">
          <h3>green blouse</h3>
          <div class="price">Rp. 50k</div>
        </div>
      </div>

      <div class="box">
        <div class="image">
          <img src="assets/baju5.png" alt="">
        </div>
        <div class="content">
          <h3>pinky shirt blouse</h3>
          <div class="price">Rp. 50k</div>
        </div>
      </div>

      <div class="box">
        <div class="image">
          <img src="assets/baju6.png" alt="">
        </div>
        <div class="content">
          <h3>white dress</h3>
          <div class="price">Rp. 25k</div>
        </div>
      </div>
    </div>

    <section class="contact" id="contact">
      <h1 class="heading"><span> contact </span> us </h1>
      <div class="row">
        <form action="">
          <input type="text" placeholder="name" class="box">
          <input type="email" placeholder="email" class="box">
          <input type="number" placeholder="number" class="box">
          <textarea name="" class="box" placeholder="message" id="" cols="30" rows="10"></textarea>
          <input type="submit" value="send message" class="btn">
        </form>

        <div class="image">
          <img src="assets/cnt.png" alt="">
        </div>
      </div>
    </section>


    <section class="footer">
        <div class="footer-box">
          <h3>quick links</h3>
          <a href="#">home</a>
          <a href="#">about</a>
          <a href="#">products</a>
          <a href="#">contact</a>
        </div>

        <div class="footer-box">
          <h3>extra links</h3>
          <a href="#">my account</a>
          <a href="#">my order</a>
          <a href="#">my favorite</a>
        </div>

        <div class="footer-box">
          <h3>locations</h3>
          <a href="#">bekasi</a>
          <a href="#">ciamis</a>
          <a href="#">malang</a>
          <a href="#">cikarang</a>
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