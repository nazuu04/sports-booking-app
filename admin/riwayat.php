<?php
session_start();
if(!isset($_SESSION['user_login'])){ header("Location: login_user.php"); exit; }
include "koneksi.php";
$nama_user = $_SESSION['user_nama'];
$data = mysqli_query($conn, "SELECT * FROM booking WHERE nama_pelanggan='$nama_user' ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking</title>
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
        .main { max-width: 800px; margin: 0 auto; padding: 2rem 1rem; }
        .booking-card { background: #0d1810; border: 1px solid #152010; border-radius: 12px; padding: 1.25rem 1.5rem; margin-bottom: 12px; display: flex; align-items: center; gap: 1rem; transition: border-color 0.15s; }
        .booking-card:hover { border-color: #1D9E75; }
        .booking-icon { width: 44px; height: 44px; background: #0a1f15; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .booking-icon i { font-size: 22px; color: #1D9E75; }
        .badge-pending { background: #1a150a; color: #EF9F27; padding: 3px 10px; border-radius: 20px; font-size: 11px; }
        .badge-konfirmasi { background: #091f12; color: #5DCAA5; padding: 3px 10px; border-radius: 20px; font-size: 11px; }
        .badge-batal { background: #1a0a0a; color: #f09595; padding: 3px 10px; border-radius: 20px; font-size: 11px; }
        .btn-booking-baru { display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 9px 16px; font-size: 14px; text-decoration: none; }
        .empty { text-align: center; padding: 3rem; color: #2a4030; background: #0d1810; border-radius: 12px; border: 1px solid #152010; }
        .empty i { font-size: 48px; margin-bottom: 1rem; display: block; color: #1a3020; }
    </style>
</head>
<body>
<div class="navbar">
    <a class="navbar-brand" href="home.php"><i class="ti ti-ball-football"></i> Sports Booking</a>
    <div class="d-flex align-items-center gap-3">
        <div class="user-chip"><div class="avatar"><?= strtoupper(substr($nama_user,0,1)) ?></div><?= $nama_user ?></div>
        <a href="logout_user.php" class="btn-logout"><i class="ti ti-logout" style="font-size:15px"></i> Logout</a>
    </div>
</div>
<div class="main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0" style="color:#e0ffe8">Riwayat Booking</h4>
            <small style="color:#2a4030">Semua booking yang pernah kamu lakukan</small>
        </div>
        <a href="home.php" class="btn-booking-baru"><i class="ti ti-plus"></i> Booking Baru</a>
    </div>
    <?php if(mysqli_num_rows($data)==0): ?>
    <div class="empty">
        <i class="ti ti-calendar-off"></i>
        <p style="font-size:15px;font-weight:500;color:#5DCAA5;margin-bottom:6px">Belum ada booking</p>
        <small>Yuk booking lapangan pertamamu!</small><br>
        <a href="home.php" class="btn-booking-baru mt-3"><i class="ti ti-plus"></i> Booking Sekarang</a>
    </div>
    <?php else: ?>
    <?php while($d = mysqli_fetch_array($data)): ?>
    <div class="booking-card">
        <div class="booking-icon"><i class="ti ti-ball-football"></i></div>
        <div style="flex:1">
            <div style="font-size:15px;font-weight:500;color:#c0eecb;margin-bottom:3px"><?= $d['lapangan'] ?></div>
            <small style="color:#2a4030">
                <i class="ti ti-calendar" style="font-size:12px;vertical-align:-1px"></i> <?= date('d M Y',strtotime($d['tanggal'])) ?>
                &nbsp;•&nbsp; <i class="ti ti-clock" style="font-size:12px;vertical-align:-1px"></i> <?= $d['jam_mulai'] ?>
                &nbsp;•&nbsp; <?= $d['durasi'] ?> jam
            </small>
        </div>
        <div style="text-align:right">
            <div style="font-size:15px;font-weight:500;color:#1D9E75;margin-bottom:4px">Rp <?= number_format($d['total_harga'],0,',','.') ?></div>
            <?php $st=$d['status']; $cl=$st=='konfirmasi'?'badge-konfirmasi':($st=='batal'?'badge-batal':'badge-pending'); ?>
            <span class="<?= $cl ?>"><?= ucfirst($st) ?></span>
        </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
</div>
</body>
</html>