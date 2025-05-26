<?php
include("connect.php");
session_start();

// Cek jika belum login dari register
if (!isset($_SESSION['email'])) {
    header("Location: register.php");
    exit;
}

// $username = $_SESSION['username'];
$id_user = $_GET['id_user'];
$result = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Biodata Customer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/output.css">
</head>
<body>
  <!-- <nav class="navbar">
      <a href="index.php">&larr; Home</a>
      <div class="brand">thrifture<span>.</span></div>
    <?php
    if (isset($_GET['pesan']) && $_GET['pesan'] == 'login_dulu') {
    echo "<p style='color:red;'>Silakan login terlebih dahulu untuk checkout.</p>";
}   ?>
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
    <h2 class="text-center mb-4">Biodata Customer</h2>
    <form action="profil.php" method="post">
    <table class="table table-bordered">
      <tr>
        <th>Nama</th>
        <td><?= htmlspecialchars($user['nama']) ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?= htmlspecialchars($user['email']) ?></td>
      </tr>
      <tr>
        <th>Username</th>
        <td><?= htmlspecialchars($user['username']) ?></td>
      </tr>
      <tr>
        <th>Tanggal Lahir</th>
        <td><?= htmlspecialchars($user['tanggal_lahir']) ?></td>
      </tr>
      <tr>
        <th>Gender</th>
        <td><?= htmlspecialchars($user['gender']) ?></td>
      </tr>
    </table>
        <button class="" onclick="window.location.href='logout.php'">Logout</button>
        <button class="" onclick="window.location.href='profil.php'">Edit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
