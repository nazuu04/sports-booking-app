<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if(!isset($_SESSION['user_login'])){
    header("Location: login_user.php");
    exit;
}
include "koneksi.php";

 $id = isset($_GET['id']) ? $_GET['id'] : 0;
$data = mysqli_query($conn, "SELECT * FROM lapangan WHERE id_lapangan='$id'");
$l = mysqli_fetch_array($data);

if(!$l){
    header("Location: home.php");
    exit;
}
$nama_user = $_SESSION['user_nama'];

if(isset($_POST['booking'])){
    $nama = $nama_user;
    $lapangan = $l['nama_lapangan'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $durasi = $_POST['durasi'];
    $total = $l['harga_per_jam'] * $durasi;

    $query = mysqli_query($conn,"
        INSERT INTO booking (nama_pelanggan, lapangan, tanggal, jam_mulai, durasi, total_harga, status)
        VALUES ('$nama', '$lapangan', '$tanggal', '$jam', '$durasi', '$total', 'pending')
    ");

    if($query){
        header("Location: riwayat.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        body { background: #f5f5f3; }
        .navbar { background: #fff; border-bottom: 1px solid #e5e5e5; padding: 0 2rem; height: 60px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10; }
        .navbar-brand { display: flex; align-items: center; gap: 8px; font-size: 15px; font-weight: 500; color: #333; text-decoration: none; }
        .navbar-brand i { font-size: 22px; color: #185FA5; }
        .user-chip { display: flex; align-items: center; gap: 8px; background: #f5f5f3; border-radius: 20px; padding: 6px 14px 6px 6px; font-size: 13px; color: #333; }
        .avatar { width: 28px; height: 28px; border-radius: 50%; background: #185FA5; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 500; color: #fff; }
        .btn-logout { display: inline-flex; align-items: center; gap: 5px; background: #FCEBEB; color: #A32D2D; border: none; border-radius: 8px; padding: 7px 14px; font-size: 13px; text-decoration: none; }
        .main { max-width: 700px; margin: 0 auto; padding: 2rem; }
        .info-card { background: #185FA5; border-radius: 12px; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem; }
        .info-icon { width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .info-icon i { font-size: 24px; color: #fff; }
        .card-form { background: #fff; border: 1px solid #e5e5e5; border-radius: 12px; padding: 1.75rem; }
        .form-label { font-size: 13px; font-weight: 500; color: #555; }
        .form-control { border: 1px solid #e0e0e0; border-radius: 8px; font-size: 14px; padding: 10px 12px; height: auto; }
        .form-control:focus { border-color: #185FA5; box-shadow: 0 0 0 3px #E6F1FB; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 17px; color: #aaa; pointer-events: none; }
        .input-wrap .form-control { padding-left: 38px; }
        .total-box { background: #EAF3DE; border-radius: 10px; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; }
        .btn-booking { width: 100%; background: #185FA5; color: #fff; border: none; border-radius: 8px; padding: 11px; font-size: 15px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-booking:hover { background: #0C447C; }
        .btn-back { display: inline-flex; align-items: center; gap: 6px; color: #666; font-size: 14px; text-decoration: none; }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <a class="navbar-brand" href="home.php"><i class="ti ti-ball-football"></i> Sports Booking</a>
    <div class="d-flex align-items-center gap-3">
        <div class="user-chip">
            <div class="avatar"><?= strtoupper(substr($nama_user, 0, 1)) ?></div>
            <?= $nama_user ?>
        </div>
        <a href="logout_user.php" class="btn-logout"><i class="ti ti-logout" style="font-size:15px"></i> Logout</a>
    </div>
</div>

<!-- Main -->
<div class="main">
    <div class="mb-4">
        <h4 class="mb-0">Form Booking</h4>
        <small class="text-muted">Isi detail booking lapangan kamu</small>
    </div>

    <!-- Info Lapangan -->
    <div class="info-card">
        <div class="info-icon">
            <?php
            $icon = 'ti-ball-football';
            if($l['jenis_olahraga'] == 'Basket') $icon = 'ti-ball-basketball';
            elseif($l['jenis_olahraga'] == 'Badminton') $icon = 'ti-feather';
            elseif($l['jenis_olahraga'] == 'Voli') $icon = 'ti-ball-volleyball';
            ?>
            <i class="ti <?= $icon ?>"></i>
        </div>
        <div>
            <h5 style="color:#fff;font-size:16px;font-weight:500;margin-bottom:2px"><?= $l['nama_lapangan'] ?></h5>
            <span style="color:#B5D4F4;font-size:13px"><?= $l['jenis_olahraga'] ?> &nbsp;•&nbsp; Rp <?= number_format($l['harga_per_jam'], 0, ',', '.') ?> / jam</span>
        </div>
    </div>

    <div class="card-form">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Pemesan</label>
                <div class="input-wrap">
                    <i class="ti ti-user"></i>
                    <input type="text" class="form-control" value="<?= $nama_user ?>" readonly style="background:#f9f9f9">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="col-6">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Durasi (Jam)</label>
                <div class="input-wrap">
                    <i class="ti ti-hourglass"></i>
                    <input type="number" name="durasi" id="durasi" class="form-control" placeholder="Contoh: 2" min="1" required
                    oninput="hitungTotal(this.value)">
                </div>
            </div>

            <div class="total-box mb-4">
                <span style="font-size:13px;color:#3B6D11">Total Harga</span>
                <strong id="total_tampil" style="font-size:18px;color:#3B6D11">Rp 0</strong>
            </div>

            <button type="submit" name="booking" class="btn-booking mb-3">
                <i class="ti ti-calendar-check" style="font-size:18px"></i> Konfirmasi Booking
            </button>
            <a href="home.php" class="btn-back"><i class="ti ti-arrow-left"></i> Kembali</a>
        </form>
    </div>
</div>

 <script>
const harga = <?= isset($l['harga_per_jam']) ? $l['harga_per_jam'] : 0 ?>;
function hitungTotal(durasi) {
    if(durasi < 1) return;
    const total = harga * durasi;
    document.getElementById('total_tampil').innerText = 'Rp ' + total.toLocaleString('id-ID');
}
</script>

</body>
</html>