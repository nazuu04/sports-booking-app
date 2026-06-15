<?php
include "koneksi.php";
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM booking WHERE id_booking='$id'");
$d = mysqli_fetch_array($data);
if(isset($_POST['update'])){
    $nama=$_POST['nama']; $lapangan=$_POST['lapangan'];
    $tanggal=$_POST['tanggal']; $jam=$_POST['jam'];
    $durasi=$_POST['durasi']; $total=$_POST['total'];
    $status=$_POST['status'];
    mysqli_query($conn,"UPDATE booking SET nama_pelanggan='$nama',lapangan='$lapangan',tanggal='$tanggal',jam_mulai='$jam',durasi='$durasi',total_harga='$total',status='$status' WHERE id_booking='$id'");
    header("Location: booking.php"); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
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
        .card-form { background: #0d1810; border: 1px solid #152010; border-radius: 12px; padding: 1.75rem; max-width: 600px; }
        .form-label { font-size: 13px; font-weight: 500; color: #5DCAA5; display: block; margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 17px; color: #1a3020; pointer-events: none; }
        .form-control, .form-select { background: #091510; border: 1px solid #152010; border-radius: 8px; color: #c0eecb; padding: 10px 12px 10px 38px; font-size: 14px; width: 100%; outline: none; }
        .form-select { padding-left: 12px; }
        .form-control:focus, .form-select:focus { border-color: #1D9E75; }
        .info-badge { display: inline-flex; align-items: center; gap: 6px; background: #1a150a; color: #EF9F27; border-radius: 8px; padding: 8px 14px; font-size: 13px; border: 1px solid #2a2010; }
        .btn-update { display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 10px 20px; font-size: 14px; cursor: pointer; }
        .btn-back { display: inline-flex; align-items: center; gap: 6px; color: #2a4030; font-size: 14px; text-decoration: none; }
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
            <h4 class="mb-0" style="color:#e0ffe8">Edit Booking</h4>
            <small style="color:#2a4030">Ubah data booking yang sudah ada</small>
        </div>
        <div class="avatar">A</div>
    </div>
    <div class="card-form">
        <div class="info-badge mb-4"><i class="ti ti-info-circle"></i> Mengubah data booking #<?= $id ?></div>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <div class="input-wrap"><i class="ti ti-user"></i><input type="text" name="nama" class="form-control" value="<?= $d['nama_pelanggan'] ?>" required></div>
            </div>
            <div class="mb-3">
                <label class="form-label">Lapangan</label>
                <div class="input-wrap"><i class="ti ti-building-stadium"></i><input type="text" name="lapangan" class="form-control" value="<?= $d['lapangan'] ?>" required></div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" style="padding-left:12px" value="<?= $d['tanggal'] ?>" required>
                </div>
                <div class="col-6">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam" class="form-control" style="padding-left:12px" value="<?= $d['jam_mulai'] ?>" required>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label class="form-label">Durasi (Jam)</label>
                    <input type="number" name="durasi" class="form-control" style="padding-left:12px" value="<?= $d['durasi'] ?>" required>
                </div>
                <div class="col-6">
                    <label class="form-label">Total Harga</label>
                    <input type="number" name="total" class="form-control" style="padding-left:12px" value="<?= $d['total_harga'] ?>" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="pending" <?= $d['status']=='pending'?'selected':'' ?>>⏳ Pending</option>
                    <option value="konfirmasi" <?= $d['status']=='konfirmasi'?'selected':'' ?>>✅ Konfirmasi</option>
                    <option value="batal" <?= $d['status']=='batal'?'selected':'' ?>>❌ Batal</option>
                </select>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button type="submit" name="update" class="btn-update"><i class="ti ti-edit"></i> Update</button>
                <a href="booking.php" class="btn-back"><i class="ti ti-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>