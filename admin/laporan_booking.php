<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include "koneksi.php";
$where = "";
if(isset($_GET['dari']) && isset($_GET['sampai']) && $_GET['dari']!='' && $_GET['sampai']!=''){
    $dari = $_GET['dari']; $sampai = $_GET['sampai'];
    $where = "WHERE tanggal BETWEEN '$dari' AND '$sampai'";
}
$data = mysqli_query($conn, "SELECT * FROM booking $where ORDER BY tanggal ASC");
$total = mysqli_query($conn, "SELECT SUM(total_harga) as total FROM booking $where");
$t = mysqli_fetch_array($total);
$grand_total = $t['total'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #080f0a; font-family: sans-serif; }
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 220px; background: #0a1410; border-right: 1px solid #152010; display: flex; flex-direction: column; padding: 1.5rem 0; }
        .sidebar-brand { padding: 0 1.25rem 1.5rem; border-bottom: 1px solid #152010; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 1.25rem; font-size: 14px; color: #2a4030; text-decoration: none; }
        .nav-item:hover { background: #0d1810; color: #5DCAA5; }
        .nav-item.active { color: #1D9E75; background: #0d1f12; font-weight: 500; }
        .nav-item i { font-size: 18px; }
        .nav-section { padding: 1rem 1.25rem 0.25rem; font-size: 11px; color: #1a3020; text-transform: uppercase; letter-spacing: 0.05em; }
        .logout { margin-top: auto; border-top: 1px solid #152010; padding-top: 1rem; }
        .logout .nav-item { color: #f09595; }
        .main { margin-left: 220px; padding: 2rem; }
        .filter-card { background: #0d1810; border: 1px solid #152010; border-radius: 12px; padding: 1.25rem 1.5rem; margin-bottom: 1.25rem; }
        .form-control { background: #091510; border: 1px solid #152010; border-radius: 8px; color: #c0eecb; padding: 9px 12px; font-size: 14px; outline: none; }
        .form-control:focus { border-color: #1D9E75; }
        .btn-filter { display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 9px 16px; font-size: 14px; cursor: pointer; }
        .btn-print { display: inline-flex; align-items: center; gap: 6px; background: #0a1f15; color: #1D9E75; border: 1px solid #152010; border-radius: 8px; padding: 9px 16px; font-size: 14px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; background: #0d1810; border-radius: 12px; overflow: hidden; border: 1px solid #152010; }
        thead tr { background: #091510; }
        th { padding: 12px 16px; font-size: 12px; font-weight: 500; color: #2a4030; text-align: left; border-bottom: 1px solid #152010; }
        td { padding: 13px 16px; font-size: 14px; color: #c0eecb; border-bottom: 1px solid #111f14; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #0a1810; }
        .total-card { background: linear-gradient(135deg, #0d1f12, #091510); border: 1px solid #152010; border-radius: 12px; padding: 1.25rem 1.5rem; display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: #0d1f12; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 500; color: #1D9E75; }
        @media print { .sidebar,.btn-print,.filter-card,.avatar{display:none!important} .main{margin-left:0!important;padding:1rem!important} }
        @media(max-width:768px){ .sidebar{display:none} .main{margin-left:0} }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-brand">
        <h5 style="font-size:15px;font-weight:500;color:#c0eecb"><i class="ti ti-ball-football" style="color:#1D9E75"></i> Sports Booking</h5>
        <small style="color:#2a4030">Panel Admin</small>
    </div>
    <div class="mt-3">
        <div class="nav-section">Menu</div>
        <a class="nav-item" href="dashboard.php"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
        <a class="nav-item" href="lapangan.php"><i class="ti ti-building-stadium"></i> Lapangan</a>
        <a class="nav-item" href="booking.php"><i class="ti ti-calendar-check"></i> Booking</a>
        <a class="nav-item active" href="laporan_booking.php"><i class="ti ti-file-report"></i> Laporan</a>
    </div>
    <div class="logout"><a class="nav-item" href="logout.php"><i class="ti ti-logout"></i> Logout</a></div>
</div>
<div class="main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0" style="color:#e0ffe8">Laporan Booking</h4>
            <small style="color:#2a4030">Rekap semua pemesanan lapangan</small>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button class="btn-print" onclick="window.print()"><i class="ti ti-printer"></i> Cetak</button>
            <div class="avatar">A</div>
        </div>
    </div>
    <div class="filter-card">
        <form method="GET" class="d-flex align-items-end gap-3 flex-wrap">
            <div>
                <label style="font-size:13px;color:#2a4030;display:block;margin-bottom:6px">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="<?= $_GET['dari'] ?? '' ?>">
            </div>
            <div>
                <label style="font-size:13px;color:#2a4030;display:block;margin-bottom:6px">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="<?= $_GET['sampai'] ?? '' ?>">
            </div>
            <button type="submit" class="btn-filter"><i class="ti ti-search"></i> Filter</button>
            <a href="laporan_booking.php" style="font-size:14px;color:#2a4030;text-decoration:none">Reset</a>
        </form>
    </div>
    <table>
        <thead>
            <tr><th>ID</th><th>Nama Pelanggan</th><th>Lapangan</th><th>Tanggal</th><th>Jam</th><th>Durasi</th><th>Total Harga</th></tr>
        </thead>
        <tbody>
            <?php while($d = mysqli_fetch_array($data)): ?>
            <tr>
                <td style="color:#1a3020"><?= $d['id_booking'] ?></td>
                <td><?= $d['nama_pelanggan'] ?></td>
                <td><?= $d['lapangan'] ?></td>
                <td><?= date('d M Y', strtotime($d['tanggal'])) ?></td>
                <td><?= $d['jam_mulai'] ?></td>
                <td><?= $d['durasi'] ?> jam</td>
                <td style="color:#1D9E75">Rp <?= number_format($d['total_harga'],0,',','.') ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="total-card">
        <span style="color:#2a4030;font-size:14px">Total Pendapatan</span>
        <strong style="color:#1D9E75;font-size:20px">Rp <?= number_format($grand_total,0,',','.') ?></strong>
    </div>
</div>
</body>
</html>