<?php
    $koneksi = mysqli_connect("localhost","root","","thrifture");

    if (!$koneksi) {
        echo "Connect Gagal";
    }
?>