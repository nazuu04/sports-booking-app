 <?php
include "koneksi.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM lapangan WHERE id_lapangan='$id'"
    );
}

header("Location: lapangan.php");
exit;
?>
<a href="hapus_lapangan.php?id=<?= $d['id_lapangan']; ?>"
onclick="return confirm('Yakin ingin menghapus data ini?')">
Hapus
</a>