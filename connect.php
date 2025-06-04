<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "thrifture";
    $koneksi = mysqli_connect("$host","$user","$pass","$db");

    if (!$koneksi) {
        echo "Connect Gagal";
    }
?>