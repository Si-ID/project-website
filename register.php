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
              $msg = "<div class='alert alert-dang er'>Passworddan konfirmasi password tidak cocok!</div>";
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
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
    <!-- NAVBAR SELESAI -->
    
    <div class="form">
        <form action="" method="post" class="opacity-75">
            <h2>Register Form</h2>
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
    <img class="bg-img" src="https://images.unsplash.com/photo-1569470451072-68314f596aec?q=100&w=2831&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="bg_image">
    <!-- Bg-IMG berakhir -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>