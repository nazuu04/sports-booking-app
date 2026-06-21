<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM lapangan WHERE id_lapangan='$id'"
    );
}

header("Location: lapangan.php");
exit;