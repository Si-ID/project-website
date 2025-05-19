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
        header('Location:index.html');
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
  </head>
  <body>
    <div class="form">
        <form action="" method="post">
            <h2>Login Thrifture</h2>
            <p class="msg"></p>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required><br>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>
            <button class="btn btn-dark fw-bold" name="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>