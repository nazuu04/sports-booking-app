<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect(
    "mysql.railway.internal",
    "root",
    "SHINynRhwJSQpAiEyXlidoVGhMxKFYIX",
    "railway"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil";
?>