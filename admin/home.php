<?php
session_start();
if(!isset($_SESSION['user_login'])){
    header("Location: login_user.php");
    exit;
}

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
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:
            linear-gradient(rgba(0,0,0,.7),rgba(0,0,0,.7)),
            url('images/background.jpg');
            background-size:cover;
            background-position:center;
            background-repeat:no-repeat;
            background-attachment:fixed;
            min-height:100vh;
            font-family:sans-serif;
        }

        .navbar{
            position:fixed;
            top:15px;
            right:15px;
            z-index:999;
            background:transparent;
            width:auto;
            padding:0;
        }

        .btn-logout{
            width:45px;
            height:45px;
            border-radius:50%;
            background:rgba(26,10,10,.9);
            color:#f09595;
            border:1px solid #2e1010;
            display:flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
        }

        .btn-logout i{
            font-size:22px;
        }

        .btn-logout:hover{
            background:#b91c1c;
            color:white;
        }

        .main{
            max-width:1000px;
            margin:0 auto;
            padding:2rem 1rem;
        }

        .hero{
            background:rgba(13,31,18,.7);
            backdrop-filter:blur(8px);
            border:1px solid #152010;
            border-radius:16px;
            padding:2rem 2.5rem;
            margin-bottom:2rem;
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .hero h2{
            color:#e0ffe8;
            font-size:22px;
            font-weight:500;
            margin-bottom:6px;
        }

        .hero p{
            color:#5DCAA5;
            font-size:14px;
        }

        .hero i{
            font-size:64px;
            color:rgba(29,158,117,.2);
        }

        .section-title{
            font-size:15px;
            font-weight:500;
            color:#5DCAA5;
            margin-bottom:1rem;
            text-shadow:0 1px 4px rgba(0,0,0,.5);
        }

        .lapangan-card{
            background:rgba(13,24,16,.75);
            backdrop-filter:blur(8px);
            border:1px solid #152010;
            border-radius:12px;
            padding:1.25rem;
            transition:.2s;
        }

        .lapangan-card:hover{
            border-color:#1D9E75;
            background:rgba(13,31,18,.85);
        }

        .lapangan-icon{
            width:48px;
            height:48px;
            background:rgba(10,31,21,.8);
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            margin-bottom:.75rem;
        }

        .lapangan-icon i{
            font-size:24px;
            color:#1D9E75;
        }

        .btn-booking{
            display:flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            background:linear-gradient(135deg,#1D9E75,#085041);
            color:white;
            border:none;
            border-radius:8px;
            padding:9px;
            font-size:13px;
            width:100%;
            text-decoration:none;
        }

        .btn-booking:hover{
            color:white;
            opacity:.9;
        }
    </style>
</head>

<body>

<div class="navbar">
    <a href="logout_user.php" class="btn-logout">
        <i class="ti ti-logout"></i>
    </a>
</div>

<div class="main">

    <div class="hero">
        <div>
            <h2>Selamat Datangx👋</h2>
            <p>Mau olahraga hari ini? Yuk booking lapangan sekarang!</p>
        </div>
        <i class="ti ti-ball-football"></i>
    </div>

    <div class="section-title">
        Lapangan Tersedia
    </div>

    <div class="row g-3">

        <?php while($l = mysqli_fetch_array($lapangan)): ?>

        <div class="col-md-4 col-6">

            <div class="lapangan-card">

                <div class="lapangan-icon">

                    <?php
                    $icon = 'ti-ball-football';

                    if($l['jenis_olahraga']=='Basket')
                        $icon='ti-ball-basketball';

                    elseif($l['jenis_olahraga']=='Badminton')
                        $icon='ti-feather';

                    elseif($l['jenis_olahraga']=='Voli')
                        $icon='ti-ball-volleyball';

                    elseif($l['jenis_olahraga']=='Padel')
                        $icon='ti-tennis';

                    elseif($l['jenis_olahraga']=='Tennis')
                        $icon='ti-ball-tennis';
                    ?>

                    <i class="ti <?= $icon ?>"></i>

                </div>

                <div style="font-size:14px;font-weight:500;color:#c0eecb;margin-bottom:3px">
                    <?= $l['nama_lapangan'] ?>
                </div>

                <div style="font-size:12px;color:#5DCAA5;margin-bottom:.75rem">
                    <?= $l['jenis_olahraga'] ?>
                </div>

                <div style="font-size:14px;font-weight:500;color:#1D9E75;margin-bottom:.75rem">
                    Rp <?= number_format($l['harga_per_jam'],0,',','.') ?>/jam
                </div>

                <a href="booking_user.php?id=<?= $l['id_lapangan'] ?>" class="btn-booking">
                    <i class="ti ti-calendar-plus"></i>
                    Booking
                </a>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</div>

</body>
</html>