<?php
session_start();
if(!isset($_SESSION['user_login'])){ header("Location: login_user.php"); exit; }
include "koneksi.php";
$lapangan = mysqli_query($conn, "SELECT * FROM lapangan");
$nama_user = $_SESSION['user_nama'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #080f0a; font-family: sans-serif; }
        .navbar { background: #0a1410; border-bottom: 1px solid #152010; padding: 0 1.5rem; height: 60px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10; }
        .navbar-brand { display: flex; align-items: center; gap: 8px; font-size: 15px; font-weight: 500; color: #c0eecb; text-decoration: none; }
        .navbar-brand i { font-size: 22px; color: #1D9E75; }
        .user-chip { display: flex; align-items: center; gap: 8px; background: #0d1810; border-radius: 20px; padding: 6px 14px 6px 6px; font-size: 13px; color: #5DCAA5; border: 1px solid #152010; }
        .avatar { width: 28px; height: 28px; border-radius: 50%; background: #0d1f12; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 500; color: #1D9E75; }
        .btn-logout { display: inline-flex; align-items: center; gap: 5px; background: #1a0a0a; color: #f09595; border: 1px solid #2e1010; border-radius: 8px; padding: 7px 14px; font-size: 13px; text-decoration: none; }
        .main { max-width: 1000px; margin: 0 auto; padding: 2rem 1rem; }
        .hero { background: linear-gradient(135deg, #0d1f12, #091510); border: 1px solid #152010; border-radius: 16px; padding: 2rem 2.5rem; margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; }
        .hero h2 { color: #e0ffe8; font-size: 22px; font-weight: 500; margin-bottom: 6px; }
        .hero p { color: #2a4030; font-size: 14px; }
        .hero i { font-size: 64px; color: rgba(29,158,117,0.15); }
        .lapangan-card { background: #0d1810; border: 1px solid #152010; border-radius: 12px; padding: 1.25rem; transition: border-color 0.15s; }
        .lapangan-card:hover { border-color: #1D9E75; }
        .lapangan-icon { width: 48px; height: 48px; background: #0a1f15; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; }
        .lapangan-icon i { font-size: 24px; color: #1D9E75; }
        .btn-booking { display: flex; align-items: center; justify-content: center; gap: 6px; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 9px; font-size: 13px; width: 100%; text-decoration: none; }
        .btn-booking:hover { opacity: 0.9; color: #fff; }
    </style>
</head>
<body>
<div class="navbar">
    <a class="navbar-brand" href="home.php"><i class="ti ti-ball-football"></i> Sports Booking</a>
    <div class="d-flex align-items-center gap-3">
        <div class="user-chip">
            <div class="avatar"><?= strtoupper(substr($nama_user,0,1)) ?></div>
            <?= $nama_user ?>
        </div>
        <a href="logout_user.php" class="btn-logout"><i class="ti ti-logout" style="font-size:15px"></i> Logout</a>
    </div>
</div>
<div class="main">
    <div class="hero">
        <div>
            <h2>Halo, <?= $nama_user ?>! 👋</h2>
            <p>Mau olahraga hari ini? Yuk booking lapangan sekarang!</p>
        </div>
        <i class="ti ti-ball-football"></i>
    </div>
    <div style="font-size:15px; font-weight:500; color:#5DCAA5; margin-bottom:1rem">Lapangan Tersedia</div>
    <div class="row g-3">
        <?php while($l = mysqli_fetch_array($lapangan)): ?>
        <div class="col-md-4 col-6">
            <div class="lapangan-card">
                <div class="lapangan-icon">
                    <?php
                    $icon = 'ti-ball-football';
                    if($l['jenis_olahraga']=='Basket') $icon='ti-ball-basketball';
                    elseif($l['jenis_olahraga']=='Badminton') $icon='ti-feather';
                    elseif($l['jenis_olahraga']=='Voli') $icon='ti-ball-volleyball';
                    elseif($l['jenis_olahraga']=='Padel') $icon='ti-tennis';
                    ?>
                    <i class="ti <?= $icon ?>"></i>
                </div>
                <div style="font-size:14px; font-weight:500; color:#c0eecb; margin-bottom:3px"><?= $l['nama_lapangan'] ?></div>
                <div style="font-size:12px; color:#2a4030; margin-bottom:0.75rem"><?= $l['jenis_olahraga'] ?></div>
                <div style="font-size:14px; font-weight:500; color:#1D9E75; margin-bottom:0.75rem">Rp <?= number_format($l['harga_per_jam'],0,',','.') ?>/jam</div>
                <a href="booking_user.php?id=<?= $l['id_lapangan'] ?>" class="btn-booking"><i class="ti ti-calendar-plus" style="font-size:15px"></i> Booking</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>