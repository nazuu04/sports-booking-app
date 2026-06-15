 <?php
session_start();
include "koneksi.php";
$error = ""; $success = "";
if(isset($_POST['daftar'])){
    $nama = $_POST['nama']; $email = $_POST['email'];
    $no_hp = $_POST['no_hp']; $username = $_POST['username'];
    $password = $_POST['password'];
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($cek) > 0){
        $error = "Username sudah dipakai!";
    } else {
        $q = mysqli_query($conn,"INSERT INTO users (nama,email,no_hp,username,password) VALUES ('$nama','$email','$no_hp','$username','$password')");
        if($q){ $success = "Akun berhasil dibuat! Silakan login."; }
        else { $error = "Gagal: ".mysqli_error($conn); }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #080f0a; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; padding: 1.5rem 0; }
        .wrap { width: 100%; max-width: 420px; padding: 1.5rem; }
        .header { text-align: center; margin-bottom: 2rem; }
        .logo { width: 64px; height: 64px; background: linear-gradient(135deg, #1D9E75, #085041); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
        .logo i { font-size: 30px; color: #fff; }
        .header h2 { font-size: 20px; font-weight: 500; color: #e0ffe8; margin-bottom: 4px; }
        .header p { font-size: 13px; color: #2a4030; }
        .card-form { background: #0d1810; border: 1px solid #152010; border-radius: 16px; padding: 1.75rem; }
        .form-label { font-size: 13px; font-weight: 500; color: #5DCAA5; display: block; margin-bottom: 6px; }
        .input-wrap { position: relative; margin-bottom: 1.25rem; }
        .input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 17px; color: #1a3020; pointer-events: none; }
        .form-control { background: #091510; border: 1px solid #152010; border-radius: 8px; color: #c0eecb; padding: 10px 12px 10px 38px; font-size: 14px; width: 100%; outline: none; }
        .form-control:focus { border-color: #1D9E75; box-shadow: 0 0 0 3px rgba(29,158,117,0.1); }
        .form-control::placeholder { color: #1a3020; }
        .error-box { background: #1a0a0a; color: #f09595; border-radius: 8px; padding: 10px 14px; font-size: 13px; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; border: 1px solid #2e1010; }
        .success-box { background: #091f12; color: #5DCAA5; border-radius: 8px; padding: 10px 14px; font-size: 13px; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; border: 1px solid #0f3020; }
        .btn-daftar { width: 100%; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 11px; font-size: 15px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-daftar:hover { opacity: 0.9; }
        .login-link { text-align: center; margin-top: 1rem; font-size: 13px; color: #2a4030; }
        .login-link a { color: #1D9E75; text-decoration: none; }
        .back-link { text-align: center; margin-top: 1.25rem; font-size: 13px; }
        .back-link a { color: #1D9E75; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="logo"><i class="ti ti-user-plus"></i></div>
        <h2>Buat Akun Baru</h2>
        <p>Isi data diri kamu untuk mendaftar</p>
    </div>
    <div class="card-form">
        <?php if($error): ?><div class="error-box"><i class="ti ti-alert-circle"></i><?= $error ?></div><?php endif; ?>
        <?php if($success): ?><div class="success-box"><i class="ti ti-circle-check"></i><?= $success ?></div><?php endif; ?>
        <form method="POST">
            <div class="row g-3 mb-0">
                <div class="col-6">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-wrap">
                        <i class="ti ti-user"></i>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">No. HP</label>
                    <div class="input-wrap">
                        <i class="ti ti-phone"></i>
                        <input type="text" name="no_hp" class="form-control" placeholder="08xx">
                    </div>
                </div>
            </div>
            <label class="form-label">Email</label>
            <div class="input-wrap">
                <i class="ti ti-mail"></i>
                <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
            </div>
            <label class="form-label">Username</label>
            <div class="input-wrap">
                <i class="ti ti-at"></i>
                <input type="text" name="username" class="form-control" placeholder="Username unik" required>
            </div>
            <label class="form-label">Password</label>
            <div class="input-wrap">
                <i class="ti ti-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>
            <button type="submit" name="daftar" class="btn-daftar"><i class="ti ti-user-plus"></i> Daftar Sekarang</button>
            <div class="login-link mt-3">Sudah punya akun? <a href="login_user.php">Login di sini</a></div>
        </form>
    </div>
    <div class="back-link"><a href="index.php"><i class="ti ti-arrow-left"></i> Kembali</a></div>
</div>
</body>
</html>