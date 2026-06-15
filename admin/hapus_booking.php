 <?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query(
$conn,
"DELETE FROM booking WHERE id_booking='$id'"
);

header("Location: booking.php");
exit;
?>
<a href="hapus_booking.php?id=<?= $d['id_booking']; ?>"
onclick="return confirm('Yakin ingin menghapus data ini?')">
Hapus
</a>

