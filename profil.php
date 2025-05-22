<?php
    session_start();
    include('connect.php');
    if (!isset($_SESSION['email'])){
        header("Location: login.php");
        exit;
    }

    // Ambil ID dari URL
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!$id) {
        // Jika tidak ada ID, gunakan ID dari session
        $email = $_SESSION['email'];
        $query = mysqli_query($koneksi, "SELECT id_user FROM users WHERE email = '$email'");
        $user = mysqli_fetch_assoc($query);
        $id = $user['id_user'];
    }

    // mengambil data user
    $email = $_SESSION['email'];
    $query = mysqli_query($koneksi, "SELECT*FROM users WHERE email = '$email'");
    $user = mysqli_fetch_array($query);
    $msg = '';

    if(isset($_POST['submit']))
    {
        $nama   = $_POST['nama'];
        $email  = $_POST['email'];
        $usn    = $_POST['username'];
        $ttl    = $_POST['ttl'];
        $gender = $_POST['gender'];

        $update_query = mysqli_query($koneksi, "UPDATE users SET 
                                    nama ='$nama',
                                    email='$email',
                                    username='$usn',
                                    tanggal_lahir='$ttl',
                                    gender='$gender'
                                    WHERE id_user =".$user['id_user']);   

        if ($update_query) {
            $msg = "Profil Berhasil di Update!";
            //refresh data user
            $query = mysqli_query($koneksi,"SELECT*FROM users WHERE email = '$email'");
            $user = mysqli_fetch_assoc($query);
        } else {
            $msg = "Gagal Update Profil! ". mysqli_error($koneksi);
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="CSS/form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="index.php" class="home-link">&larr; Home</a>
        <div class="brand">thrifture<span>.</span></div>
    </nav>
    <!-- NAVBAR SELESAI -->
    
    <div class="form">
        <form action="" method="post">
            <h2 class="form-title">Edit Profile</h2>
            <?php if($msg): ?>
                <div class="alert alert-info"><?php echo $msg; ?></div>
            <?php endif; ?>
            
            <div class="form-group mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="ttl" class="form-control" value="<?php echo htmlspecialchars($user['tanggal_lahir']); ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select">
                    <option value="Laki-laki" <?php echo ($user['gender'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                    <option value="Perempuan" <?php echo ($user['gender'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-dark">Update Profile</button>
            </div>
        </form>
    </div>
</body>
</html>