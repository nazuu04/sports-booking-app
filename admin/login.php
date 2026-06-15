 <?php
session_start();
include "koneksi.php";
$error = "";
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if(mysqli_num_rows($cek) > 0){
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengelola</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #080f0a; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; }
        .wrap { width: 100%; max-width: 400px; padding: 1.5rem; }
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
        .btn-login { width: 100%; background: linear-gradient(135deg, #1D9E75, #085041); color: #fff; border: none; border-radius: 8px; padding: 11px; font-size: 15px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-login:hover { opacity: 0.9; }
        .back-link { text-align: center; margin-top: 1.25rem; font-size: 13px; }
        .back-link a { color: #1D9E75; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="logo"><i class="ti ti-settings"></i></div>
        <h2>Login Pengelola</h2>
        <p>Akses khusus pengelola sistem</p>
    </div>
    <div class="card-form">
        <?php if($error): ?>
        <div class="error-box"><i class="ti ti-alert-circle"></i><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <label class="form-label">Username</label>
            <div class="input-wrap">
                <i class="ti ti-user"></i>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <label class="form-label">Password</label>
            <div class="input-wrap">
                <i class="ti ti-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" name="login" class="btn-login"><i class="ti ti-login"></i> Masuk</button>
        </form>
    </div>
    <div class="back-link"><a href="index.php"><i class="ti ti-arrow-left"></i> Kembali</a></div>
</div>
</body>
</html>