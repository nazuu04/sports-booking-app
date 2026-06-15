<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if(!isset($_SESSION['user_login'])){ header("Location: login_user.php"); exit; }
include "koneksi.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$data = mysqli_query($conn, "SELECT * FROM lapangan WHERE id_lapangan='$id'");
$l = mysqli_fetch_array($data);
if(!$l){ header("Location: home.php"); exit; }
$nama_user = $_SESSION['user_nama'];
if(isset($_POST['booking'])){
    $nama = $nama_user;
    $lapangan = $l['nama_lapangan'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $durasi = $_POST['durasi'];
    $total = $l['harga_per_jam'] * $durasi;
    $q = mysqli_query($conn,"INSERT INTO booking (nama_pelanggan,lapangan,tanggal,jam_mulai,durasi,total_harga,status) VALUES ('$nama','$lapangan','$tanggal','$jam','$durasi','$total','pending')");
    if($q){ header("Location: riwayat.php"); exit; }
    else { echo "Error: ".mysqli_error($conn); }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #080f0a; font-family: sans-serif; }
        .navbar { background: #0a1410; border-bottom: 1px solid #152010; padding: 0 1.5rem; height: 60px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10; }
        .navbar-brand { display: flex; align-items: center; gap: 8px; font-size: 15px; font-weight: 500; color: #c0eecb; text-decoration: none; }
        .navbar-brand i { font-size: 22px; color: #1D9E75; }
        .user-chip { display: flex; align-items: center; gap: 8px; background: #0d1810; border-radius: 20px; padding: 6px 14px 6px 6px; font-size: 13px; color: #5DCAA5; border: 1px solid #152010; }
        .avatar-sm { width: 28px; height: 28px; border-radius: 50%; background: #0d1f12; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 500; color: #1D9E75; }
        .btn-logout { display: inline-flex; align-items: center; gap: 5px; background: #1a0a0a; color: #f09595; border: 1px solid #2e1010; border-radius: 8px; padding: 7px 14px; font-size: 13px; text-decoration: none; }
        .main { max-width: 700px; margin: 0 auto; padding: 2rem 1rem; }
        .info-card { background: linear-gradient(135deg, #0d1f12, #091510); border: 1px solid #152010; border-radius: 12px; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem; }
        .info-icon { width: 48px; height: 48px; background: rgba(29,158,117,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .info-icon i { font-size: 24px; color: #1D9E75; }
        .card-form { background: #0d1810; border: 1px solid #152010; border-radius: 12px; padding: 1.75rem; }
        .form-label { font-size: 13px; font-weight: 500; color: #5DCAA5; display: block; margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 17px; color: #1a3020; pointer-events: none; }
        .form-control { background: #091510; border: 1px solid #152010; border-radius: 8px; color: #c0eecb; padding: 10px 12px 10px 38px; font-size: 14px; width: 100%; outline: none; }
        .form-control:focus { border-color: #1D9E75; box-shadow: 0 0 0 3px rgba(29,158,117,0.1); }
        .form-control::placeholder { color: #1a3020; }
        .total-box { background: #091f12; border: 1px solid #0f3020; border-radius: 10px; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; }
        .btn-booking { width: 100%; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 11px; font-size: 15px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-booking:hover { opacity: 0.9; }
        .btn-back { display: inline-flex; align-items: center; gap: 6px; color: #2a4030; font-size: 14px; text-decoration: none; margin-top: 0.75rem; }
    </style>
</head>
<body>
<div class="navbar">
    <a class="navbar-brand" href="home.php"><i class="ti ti-ball-football"></i> Sports Booking</a>
    <div class="d-flex align-items-center gap-3">
        <div class="user-chip"><div class="avatar-sm"><?= strtoupper(substr($nama_user,0,1)) ?></div><?= $nama_user ?></div>
        <a href="logout_user.php" class="btn-logout"><i class="ti ti-logout" style="font-size:15px"></i> Logout</a>
    </div>
</div>
<div class="main">
    <div class="mb-4">
        <h4 class="mb-0" style="color:#e0ffe8">Form Booking</h4>
        <small style="color:#2a4030">Isi detail booking lapangan kamu</small>
    </div>
    <div class="info-card">
        <div class="info-icon">
            <?php
            $icon='ti-ball-football';
            if($l['jenis_olahraga']=='Basket') $icon='ti-ball-basketball';
            elseif($l['jenis_olahraga']=='Badminton') $icon='ti-feather';
            elseif($l['jenis_olahraga']=='Voli') $icon='ti-ball-volleyball';
            elseif($l['jenis_olahraga']=='Padel') $icon='ti-tennis';
            ?>
            <i class="ti <?= $icon ?>"></i>
        </div>
        <div>
            <div style="font-size:16px;font-weight:500;color:#c0eecb;margin-bottom:3px"><?= $l['nama_lapangan'] ?></div>
            <small style="color:#2a4030"><?= $l['jenis_olahraga'] ?> &nbsp;•&nbsp; Rp <?= number_format($l['harga_per_jam'],0,',','.') ?> / jam</small>
        </div>
    </div>
    <div class="card-form">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Pemesan</label>
                <div class="input-wrap"><i class="ti ti-user"></i><input type="text" class="form-control" value="<?= $nama_user ?>" readonly style="opacity:0.6"></div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" style="padding-left:12px" required>
                </div>
                <div class="col-6">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam" class="form-control" style="padding-left:12px" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Durasi (Jam)</label>
                <div class="input-wrap"><i class="ti ti-hourglass"></i><input type="number" name="durasi" id="durasi" class="form-control" placeholder="Contoh: 2" min="1" required oninput="hitungTotal(this.value)"></div>
            </div>
            <div class="total-box">
                <span style="font-size:13px;color:#5DCAA5">Total Harga</span>
                <strong id="total_tampil" style="font-size:18px;color:#1D9E75">Rp 0</strong>
            </div>
            <button type="submit" name="booking" class="btn-booking"><i class="ti ti-calendar-check" style="font-size:18px"></i> Konfirmasi Booking</button>
            <a href="home.php" class="btn-back"><i class="ti ti-arrow-left"></i> Kembali</a>
        </form>
    </div>
</div>
<script>
const harga = <?= $l['harga_per_jam'] ?>;
function hitungTotal(durasi) {
    if(durasi < 1) return;
    const total = harga * durasi;
    document.getElementById('total_tampil').innerText = 'Rp ' + total.toLocaleString('id-ID');
}
</script>
</body>
</html>