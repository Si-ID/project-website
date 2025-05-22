<?php

    $host = "sql12.freesqldatabase.com";
    $user = "sql12780537";
    $pass = "AxPy15ZKVF";
    $db   = "sql12780537";
    $koneksi = mysqli_connect("$host","$user","$pass","$db");

    if (!$koneksi) {
        echo "Connect Gagal";
    }
?>