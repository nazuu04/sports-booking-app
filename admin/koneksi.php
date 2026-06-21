<?php
$conn = mysqli_connect(
    "mysql.railway.internal",
    "root",
    "GANTI_DENGAN_PASSWORD_BARU_KAMU",
    "railway"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}