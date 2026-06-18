<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include "koneksi.php";
$lapangan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM lapangan"));
$booking = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM booking"));
$pending = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM booking WHERE status='pending'"));
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
           body{
    background:
    linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
    url('images/background.jpg');

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;

    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: sans-serif;
}
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 220px; background: #0a1410; border-right: 1px solid #152010; display: flex; flex-direction: column; padding: 1.5rem 0; }
        .sidebar-brand { padding: 0 1.25rem 1.5rem; border-bottom: 1px solid #152010; }
        .sidebar-brand h5 { font-size: 15px; font-weight: 500; color: #c0eecb; }
        .sidebar-brand small { color: #2a4030; font-size: 12px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 1.25rem; font-size: 14px; color: #2a4030; text-decoration: none; }
        .nav-item:hover { background: #0d1810; color: #5DCAA5; }
        .nav-item.active { color: #1D9E75; background: #0d1f12; font-weight: 500; }
        .nav-item i { font-size: 18px; }
        .nav-section { padding: 1rem 1.25rem 0.25rem; font-size: 11px; color: #1a3020; text-transform: uppercase; letter-spacing: 0.05em; }
        .logout { margin-top: auto; border-top: 1px solid #152010; padding-top: 1rem; }
        .logout .nav-item { color: #f09595; }
        .main { margin-left: 220px; padding: 2rem; }
        .stat-card { background: #0d1810; border: 1px solid #152010; border-radius: 12px; padding: 1.25rem; }
        .stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; }
        .action-card { background: #0d1810; border: 1px solid #152010; border-radius: 12px; padding: 1.25rem; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: border-color 0.15s; }
        .action-card:hover { border-color: #1D9E75; }
        .action-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: #0d1f12; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 500; color: #1D9E75; }
        @media(max-width:768px){ .sidebar{display:none} .main{margin-left:0} }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-brand">
        <h5><i class="ti ti-ball-football" style="color:#1D9E75"></i> Sports Booking</h5>
        <small>Panel Admin</small>
    </div>
    <div class="mt-3">
        <div class="nav-section">Menu</div>
        <a class="nav-item active" href="dashboard.php"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
        <a class="nav-item" href="lapangan.php"><i class="ti ti-building-stadium"></i> Lapangan</a>
        <a class="nav-item" href="booking.php"><i class="ti ti-calendar-check"></i> Booking</a>
        <a class="nav-item" href="laporan_booking.php"><i class="ti ti-file-report"></i> Laporan</a>
    </div>
    <div class="logout">
        <a class="nav-item" href="logout.php"><i class="ti ti-logout"></i> Logout</a>
    </div>
</div>
<div class="main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0" style="color:#e0ffe8">Dashboard</h4>
            <small style="color:#2a4030">Selamat datang kembali, Admin</small>
        </div>
        <div class="avatar">A</div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background:#0a1f15"><i class="ti ti-building-stadium" style="color:#1D9E75; font-size:20px"></i></div>
                <div style="color:#2a4030; font-size:12px">Total Lapangan</div>
                <div style="font-size:28px; font-weight:500; color:#c0eecb"><?= $lapangan ?></div>
                <small style="color:#1a3020">Lapangan aktif</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background:#0a1f15"><i class="ti ti-calendar-check" style="color:#5DCAA5; font-size:20px"></i></div>
                <div style="color:#2a4030; font-size:12px">Total Booking</div>
                <div style="font-size:28px; font-weight:500; color:#c0eecb"><?= $booking ?></div>
                <small style="color:#1a3020">Semua booking</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background:#1a150a"><i class="ti ti-clock" style="color:#EF9F27; font-size:20px"></i></div>
                <div style="color:#2a4030; font-size:12px">Booking Pending</div>
                <div style="font-size:28px; font-weight:500; color:#c0eecb"><?= $pending ?></div>
                <small style="color:#1a3020">Menunggu konfirmasi</small>
            </div>
        </div>
    </div>
    <div class="mb-2" style="font-size:14px; font-weight:500; color:#2a4030">Aksi Cepat</div>
    <div class="row g-3">
        <div class="col-md-6">
            <a href="lapangan.php" class="action-card">
                <div class="action-icon" style="background:#0a1f15"><i class="ti ti-building-stadium" style="color:#1D9E75; font-size:20px"></i></div>
                <div>
                    <div style="font-size:14px; font-weight:500; color:#c0eecb">Kelola Lapangan</div>
                    <small style="color:#2a4030">Tambah, edit, hapus lapangan</small>
                </div>
                <i class="ti ti-chevron-right ms-auto" style="color:#1a3020"></i>
            </a>
        </div>
        <div class="col-md-6">
            <a href="booking.php" class="action-card">
                <div class="action-icon" style="background:#0a1f15"><i class="ti ti-calendar-check" style="color:#5DCAA5; font-size:20px"></i></div>
                <div>
                    <div style="font-size:14px; font-weight:500; color:#c0eecb">Kelola Booking</div>
                    <small style="color:#2a4030">Lihat dan konfirmasi booking</small>
                </div>
                <i class="ti ti-chevron-right ms-auto" style="color:#1a3020"></i>
            </a>
        </div>
    </div>
</div>
</body>
</html>