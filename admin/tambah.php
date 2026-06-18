<?php
include "koneksi.php";
if(isset($_POST['simpan'])){
    $nama = $_POST['nama']; $jenis = $_POST['jenis']; $harga = $_POST['harga'];
    $q = mysqli_query($conn,"INSERT INTO lapangan (nama_lapangan,jenis_olahraga,harga_per_jam) VALUES ('$nama','$jenis','$harga')");
    if($q){ header("Location: lapangan.php"); exit; }
    else { die(mysqli_error($conn)); }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lapangan</title>
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
        .card-form { background: #0d1810; border: 1px solid #152010; border-radius: 12px; padding: 1.75rem; max-width: 520px; }
        .form-label { font-size: 13px; font-weight: 500; color: #5DCAA5; display: block; margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 17px; color: #1a3020; pointer-events: none; }
        .form-control { background: #091510; border: 1px solid #152010; border-radius: 8px; color: #c0eecb; padding: 10px 12px 10px 38px; font-size: 14px; width: 100%; outline: none; }
        .form-control:focus { border-color: #1D9E75; box-shadow: 0 0 0 3px rgba(29,158,117,0.1); }
        .form-control::placeholder { color: #1a3020; }
        .jenis-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 1.25rem; }
        .jenis-card { background: #091510; border: 1px solid #152010; border-radius: 10px; padding: 14px 12px; display: flex; flex-direction: column; align-items: center; gap: 6px; cursor: pointer; transition: all 0.15s; }
        .jenis-card:hover, .jenis-card.selected { border-color: #1D9E75; background: #0a1f15; }
        .jenis-card i { font-size: 22px; color: #1D9E75; }
        .jenis-card span { font-size: 13px; font-weight: 500; color: #5DCAA5; }
        .btn-simpan { display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 10px 20px; font-size: 14px; cursor: pointer; }
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
        <a class="nav-item active" href="lapangan.php"><i class="ti ti-building-stadium"></i> Lapangan</a>
        <a class="nav-item" href="booking.php"><i class="ti ti-calendar-check"></i> Booking</a>
        <a class="nav-item" href="laporan_booking.php"><i class="ti ti-file-report"></i> Laporan</a>
    </div>
    <div class="logout"><a class="nav-item" href="logout.php"><i class="ti ti-logout"></i> Logout</a></div>
</div>
<div class="main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0" style="color:#e0ffe8">Tambah Lapangan</h4>
            <small style="color:#2a4030">Isi form untuk menambah lapangan baru</small>
        </div>
        <div class="avatar">A</div>
    </div>
    <div class="card-form">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Lapangan</label>
                <div class="input-wrap">
                    <i class="ti ti-building-stadium"></i>
                    <input type="text" name="nama" class="form-control" placeholder="Contoh: Lapangan A" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" style="margin-bottom:10px">Jenis Olahraga</label>
                <input type="hidden" name="jenis" id="jenis_input" value="Futsal">
                <div class="jenis-grid">
                    <div class="jenis-card selected" onclick="pilihJenis(this,'Futsal')"><i class="ti ti-ball-football"></i><span>Futsal</span></div>
                    <div class="jenis-card" onclick="pilihJenis(this,'Badminton')"><i class="ti ti-feather"></i><span>Badminton</span></div>
                    <div class="jenis-card" onclick="pilihJenis(this,'Basket')"><i class="ti ti-ball-basketball"></i><span>Basket</span></div>
                    <div class="jenis-card" onclick="pilihJenis(this,'Voli')"><i class="ti ti-ball-volleyball"></i><span>Voli</span></div>
                    <div class="jenis-card" onclick="pilihJenis(this,'Padel')"><i class="ti ti-Padel"></i><span>Padel</span></div>
                    <div class="jenis-card" onclick="pilihJenis(this,'Tennis')"><i class="ti ti-tennis"></i><span>Tennis</span></div>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Harga Per Jam</label>
                <div class="input-wrap">
                    <i class="ti ti-cash"></i>
                    <input type="number" name="harga" class="form-control" placeholder="Contoh: 100000" required>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button type="submit" name="simpan" class="btn-simpan"><i class="ti ti-device-floppy"></i> Simpan</button>
                <a href="lapangan.php" class="btn-back"><i class="ti ti-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
<script>
function pilihJenis(el, nilai) {
    document.querySelectorAll('.jenis-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('jenis_input').value = nilai;
}
</script>
</body>
</html>