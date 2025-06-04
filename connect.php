<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "projectweb";
    $koneksi = mysqli_connect("$host","$user","$pass","$db");

    if (!$koneksi) {
        echo "Connect Gagal";
    }
?>