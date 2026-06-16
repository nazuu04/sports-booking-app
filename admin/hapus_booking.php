<?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM booking WHERE id_booking='$id'"
);

header("Location: booking.php");
exit;