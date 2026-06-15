 <!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #080f0a; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; }
        .wrap { width: 100%; max-width: 400px; padding: 1.5rem; }
        .header { text-align: center; margin-bottom: 2.5rem; }
        .logo { width: 76px; height: 76px; background: linear-gradient(135deg, #1D9E75, #085041); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; }
        .logo i { font-size: 38px; color: #fff; }
        .header h2 { font-size: 24px; font-weight: 500; color: #e0ffe8; margin-bottom: 6px; }
        .header p { font-size: 11px; color: #1D9E75; letter-spacing: 0.1em; text-transform: uppercase; }
        .badge-custom { display: inline-block; background: #0d1f12; color: #1D9E75; font-size: 10px; padding: 3px 10px; border-radius: 20px; margin-bottom: 10px; letter-spacing: 0.08em; border: 1px solid #152e1a; }
        .pilihan { background: #0d1810; border: 1px solid #152010; border-radius: 14px; padding: 1.1rem 1.25rem; margin-bottom: 10px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.2s; }
        .pilihan:hover { border-color: #1D9E75; background: #0f1f13; }
        .pilihan-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .pilihan-icon i { font-size: 20px; }
        .pilihan-text p { font-size: 14px; font-weight: 500; color: #c0eecb; margin-bottom: 2px; }
        .pilihan-text span { font-size: 12px; color: #2a4030; }
        .arrow { margin-left: auto; color: #1a2e20; font-size: 18px; }
        .divider { display: flex; align-items: center; gap: 10px; margin: 1rem 0; }
        .divider hr { flex: 1; border: none; border-top: 1px solid #111f14; }
        .divider span { font-size: 11px; color: #1D9E75; }
        .footer { text-align: center; margin-top: 2rem; font-size: 11px; color: #1a2e20; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="logo"><i class="ti ti-ball-football"></i></div>
        <span class="badge-custom">PLATFORM OLAHRAGA</span>
        <h2>SportHub</h2>
        <p>Pilih cara masuk</p>
    </div>
    <a href="login.php" class="pilihan">
        <div class="pilihan-icon" style="background:#091510"><i class="ti ti-settings" style="color:#1D9E75"></i></div>
        <div class="pilihan-text"><p>Pengelola</p><span>Akses khusus pengelola</span></div>
        <i class="ti ti-chevron-right arrow"></i>
    </a>
    <a href="login_user.php" class="pilihan">
        <div class="pilihan-icon" style="background:#091510"><i class="ti ti-user" style="color:#5DCAA5"></i></div>
        <div class="pilihan-text"><p>Masuk sebagai Pelanggan</p><span>Login dan booking lapangan</span></div>
        <i class="ti ti-chevron-right arrow"></i>
    </a>
    <div class="divider"><hr><span>BELUM PUNYA AKUN YA? BUAT DULU DONG MWAHH </span><hr></div>
    <a href="register.php" class="pilihan">
        <div class="pilihan-icon" style="background:#0f150a"><i class="ti ti-user-plus" style="color:#97C459"></i></div>
        <div class="pilihan-text"><p>Daftar Akun Baru</p><span>Buat akun pelanggan baru</span></div>
        <i class="ti ti-chevron-right arrow"></i>
    </a>
    <div class="footer">Sports Booking App &copy; <?= date('Y') ?></div>
</div>
</body>
</html>