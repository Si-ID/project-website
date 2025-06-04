<?php
    include ("connect.php");

    $msg = '';
    if (isset($_POST['submit'])) {
      $nama   = $_POST['nama'];
      $email  = $_POST['email'];
      $usn    = $_POST['username'];
      $ttl    = $_POST['ttl'];
      $gender = $_POST['gender'];
      $password = $_POST['password'];
      $cpassword = $_POST['cpassword'];

             // Validasi password cocok
             if ($password !== $cpassword) {
              $msg = "<div class='alert alert-dang er'>Password dan konfirmasi password tidak cocok!</div>";
          } else {
              // Cek apakah email dan username sudah terdaftar
              $check_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
              $check_username = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$usn'");
              
              if (mysqli_num_rows($check_email) > 0) {
                  $msg = "<div class='alert alert-danger'>Email sudah terdaftar!</div>";
              } elseif (mysqli_num_rows($check_username) > 0) {
                  $msg = "<div class='alert alert-danger'>Username sudah digunakan!</div>";
              } else {
                  
                  // Pastikan nama kolom di tabel sesuai dengan struktur database
                  $query = mysqli_query($koneksi, "INSERT INTO users (nama, email, username, tanggal_lahir, gender, password) 
                            VALUES ('$nama', '$email', '$usn', '$ttl', '$gender', '$password')");
                  
                  if ($query) {
                      $msg = "<div class='alert alert-success'>Selamat, Pendaftaran anda berhasil, silahkan <a href='login.php'>login</a>!</div>";
                  } else {
                      $msg = "<div class='alert alert-danger'>Pendaftaran Gagal: " . mysqli_error($koneksi) . "</div>";
                  }
              }
          }
      }
  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Register</title>
    <link rel="stylesheet" href="CSS/form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
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
    onmouseover="this.style.backgroundColor='#5c4033'; this.style.color='#fff9f3';"
    onmouseout="this.style.backgroundColor='#fff9f3'; this.style.color='#5c4033';">
    <i class="fas fa-arrow-right"></i> Kembali </a>
    </header>

    
    <div class="form">
        <form action="" method="post" class="">
            <h2 style="text-align: center;">Register</h2>
            <p class="msg"><?= $msg ?></p>
            <div class="form-group">
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
            </div>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Masukan Username" required>
            </div>
            <div class="form-group">
                <input type="date" name="ttl" class="form-control" required>
            </div>
            <div class="form-group">
                <select name="gender" class="form-select">
                    <option value="">Gender</option>
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="cpassword" class="form-control" placeholder="Konfirmasi Ulang Password" required>
            </div>
            <button class="btn btn-dark fw-bold" name="submit">Daftar Sekarang</button>
            <p>Sudah punya akun? <a href="login.php">Login Disini</a></p>
        </form>
    </div>
    <!-- Background IMG -->
    <img class="bg-img" src="assets/nav.jpeg" alt="bg_image">
    <!-- Bg-IMG berakhir -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
  </body>
</html>