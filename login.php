<?php
    include ("connect.php");
    session_start();


    if (isset($_POST['submit'])) {
      $email    = $_POST['email'];
      $password = $_POST['password'];
      
      $query  = mysqli_query($koneksi, "SELECT*FROM users WHERE email='$email' AND password = '$password' AND is_deleted = '0';");
      $query_delete = mysqli_query($koneksi, "SELECT*FROM users  WHERE email='$email' AND password = '$password' AND is_deleted = '1';");
      if (mysqli_num_rows($query) > 0 ) {
        $user   = mysqli_fetch_array($query);
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];
        header('Location:index.php');
      }else if(mysqli_fetch_array($query_delete) ) {
        echo "<script>alert('Akun Anda sudah di suspend! Jika ingin memulihkan akun silahkan menghubungi admin!')</script>";
      }else{
        echo "<script>alert('Akun tidak Ditemukan!')</script>";

    }}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link rel="stylesheet" href="CSS/form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="assets/logo.png">
    <style>
    a {
      color: blue;
    }
    a:hover {
      color: white; /* saat mouse diarahkan */
    }
  </style>
  </head>

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

     <div class="form">
        <form action="" method="post">
            <h2 style="text-align: center;">Login Thrifture</h2>
            <p class="msg"></p>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>
            <button class="btn btn-dark fw-bold" name="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
        </form>
    </div>


    <!-- Background IMG -->
    <img class="bg-img" src="assets/nav.jpeg" alt="bg_image">
    <!-- Bg-IMG berakhir -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>