<?php
include "koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM lapangan WHERE id_lapangan='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];

    mysqli_query($conn,"
    UPDATE lapangan SET
    nama_lapangan='$nama',
    jenis_olahraga='$jenis',
    harga_per_jam='$harga'
    WHERE id_lapangan='$id'
    ");

    header("Location: lapangan.php");
}
?>

<form method="POST">

Nama Lapangan<br>
<input type="text"
name="nama"
value="<?= $d['nama_lapangan']; ?>">

<br><br>

Jenis Olahraga<br>
<input type="text"
name="jenis"
value="<?= $d['jenis_olahraga']; ?>">

<br><br>

Harga<br>
<input type="number"
name="harga"
value="<?= $d['harga_per_jam']; ?>">

<br><br>

<button name="update">
Update
</button>

</form>