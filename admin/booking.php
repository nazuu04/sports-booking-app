<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include "koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM booking");
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booking</title>
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
        table { width: 100%; border-collapse: collapse; background: #0d1810; border-radius: 12px; overflow: hidden; border: 1px solid #152010; }
        thead tr { background: #091510; }
        th { padding: 12px 16px; font-size: 12px; font-weight: 500; color: #2a4030; text-align: left; border-bottom: 1px solid #152010; }
        td { padding: 13px 16px; font-size: 14px; color: #c0eecb; border-bottom: 1px solid #111f14; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #0a1810; }
        .btn-tambah { display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: 14px; text-decoration: none; }
        .btn-edit { display: inline-flex; align-items: center; gap: 4px; padding: 5px 10px; border-radius: 6px; font-size: 12px; background: #0a1f15; color: #1D9E75; text-decoration: none; margin-right: 4px; }
        .btn-hapus { display: inline-flex; align-items: center; gap: 4px; padding: 5px 10px; border-radius: 6px; font-size: 12px; background: #1a0a0a; color: #f09595; text-decoration: none; }
        .badge-pending { background: #1a150a; color: #EF9F27; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 500; }
        .badge-konfirmasi { background: #091f12; color: #5DCAA5; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 500; }
        .badge-batal { background: #1a0a0a; color: #f09595; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 500; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: #0d1f12; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 500; color: #1D9E75; }
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
        <a class="nav-item active" href="booking.php"><i class="ti ti-calendar-check"></i> Booking</a>
        <a class="nav-item" href="laporan_booking.php"><i class="ti ti-file-report"></i> Laporan</a>
    </div>
    <div class="logout"><a class="nav-item" href="logout.php"><i class="ti ti-logout"></i> Logout</a></div>
</div>
<div class="main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0" style="color:#e0ffe8">Data Booking</h4>
            <small style="color:#2a4030">Kelola semua pemesanan lapangan</small>
        </div>
        <div class="avatar">A</div>
    </div>
    <div class="mb-3"><a href="tambah_booking.php" class="btn-tambah"><i class="ti ti-plus"></i> Tambah Booking</a></div>
    <table>
        <thead>
            <tr><th>ID</th><th>Nama Pelanggan</th><th>Lapangan</th><th>Tanggal</th><th>Jam</th><th>Durasi</th><th>Total</th><th>Status</th><th>Aksi</th></tr>
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
                <td>
                    <?php
                    $st = $d['status'];
                    $cl = $st=='konfirmasi' ? 'badge-konfirmasi' : ($st=='batal' ? 'badge-batal' : 'badge-pending');
                    ?>
                    <span class="<?= $cl ?>"><?= ucfirst($st) ?></span>
                </td>
                <td>
                    <a href="edit_booking.php?id=<?= $d['id_booking'] ?>" class="btn-edit"><i class="ti ti-edit"></i> Edit</a>
                    <a href="hapus_booking.php?id=<?= $d['id_booking'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus?')"><i class="ti ti-trash"></i> Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>