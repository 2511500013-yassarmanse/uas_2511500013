<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_uas";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset ke UTF-8
mysqli_set_charset($koneksi, "utf8");

// Untuk debugging - cek koneksi
// echo "Koneksi berhasil ke database $db";
?>