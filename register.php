<?php
    include ("connect.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <div class="form">
        <form action="" method="post">
            <h2>Register Form</h2>
            <p class="msg"></p>
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
                <select name="gender">
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Konfirmasi Ulang Password" required>
            </div>
            <button class="btn btn-dark fw-bold" name="submit">Daftar Sekarang</button>
            <p>Sudah punya akun? <a href="login.php">Login Disini</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>