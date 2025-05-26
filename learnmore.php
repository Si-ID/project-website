<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Thrifture</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="CSS/learnmore.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>

    <header style="display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background-color: #fff9f3; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
      <!-- Logo -->
    <div style="font-weight: bold; font-size: 28px; color: #333;">Thrifture<span style="color: brown;">.</span>
    </div>

     <!-- Tombol Kembali Modern -->
    <a href="index.php" style="
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      background-color: #fff9f3;
      border: 2px solid #5c4033;
      color: brown;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    "
    onmouseover="this.style.backgroundColor='#5c4033'; this.style.color='white';"
    onmouseout="this.style.backgroundColor='white'; this.style.color='#5c4033';">
    <i class="fas fa-arrow-right"></i> Kembali </a>
    </header>


  <header class="hero d-flex flex-column justify-content-center align-items-center text-center text-white"
          style="height: 80vh; background: url('assets/bglm.jpg') center/cover no-repeat; padding: 0 20px;">
    <h1 class="display-4 fw-bold">Apa itu Thrifture?</h1>
    <p class="lead mt-2">Platform thrifting modern — hemat, keren, dan peduli lingkungan 🌿</p>
    <a href="register.php" class="btn btn-light mt-3 fw-semibold px-4 py-2 rounded-pill shadow-sm">Gabung Sekarang</a>
  </header>

  <section class="container my-5">
    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <h2 class="fw-bold text-danger">Misi Kami</h2>
        <p class="text-muted">Kami ingin menciptakan ekosistem fashion berkelanjutan yang tetap stylish dan terjangkau. Dengan membeli preloved, kamu membantu mengurangi limbah tekstil dan memulai gaya hidup ramah lingkungan.</p>
      </div>
      <div class="col-md-6">
        <img src="assets/trift.jpg" alt="Thrift Fashion" class="img-fluid rounded-4 shadow-sm">
      </div>
    </div>

    <div class="row align-items-center flex-md-row-reverse mb-5">
      <div class="col-md-6">
        <h2 class="fw-bold text-danger">Kenapa Pilih Kami?</h2>
        <ul class="text-muted">
          <li>Koleksi unik dan berkualitas</li>
          <li>Harga ramah dompet</li>
          <li>Transaksi aman dan cepat</li>
          <li>Komunitas peduli bumi 🌎</li>
        </ul>
      </div>
      <div class="col-md-6">
        <img src="assets/ture.jpeg" alt="Sustainable Fashion" class="img-fluid rounded-4 shadow-sm">
      </div>
    </div>

    <div class="row text-center my-5">
      <h2 class="fw-bold text-danger mb-4">Galeri Thrifture</h2>
      <?php
        $images = [
          "assets/ayaya.jpg",
          "assets/oyoyo.jpg",
          "assets/uyuyu.jpg",
          "assets/eyeye.jpg"
        ];
        foreach ($images as $img) {
          echo "<div class='col-6 col-md-3 mb-4'><img src='$img' class='img-fluid rounded shadow-sm' alt='Galeri Item'></div>";
        }
      ?>
    </div>

    <div class="row my-5">
      <h2 class="fw-bold text-danger text-center mb-4">Apa Kata Mereka?</h2>
      <div class="col-md-4 mb-4">
        <div class="testimonial shadow-sm p-4 rounded">
          <p>"Aku nemu jaket vintage keren banget cuma 50 ribu! Bakal langganan nih."</p>
          <strong>- Rina, Mahasiswa</strong>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="testimonial shadow-sm p-4 rounded">
          <p>"Barangnya bagus dan pengirimannya cepat. Thrifture emang beda!"</p>
          <strong>- Andi, Content Creator</strong>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="testimonial shadow-sm p-4 rounded">
          <p>"Senang bisa beli barang bekas tapi masih cakep dan bantu lingkungan juga!"</p>
          <strong>- Dita, Pegiat Lingkungan</strong>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <a href="register.php" class="btn btn-danger btn-lg px-5 py-3 rounded-pill shadow-lg animate__animated animate__pulse animate__infinite">Gabung Sekarang</a>
    </div>
  </section>

  <footer class="text-center py-4 bg-light text-muted mt-5">
    &copy; <?= date("Y") ?> thrifture. All rights reserved.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</body>
</html>
