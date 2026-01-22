<?php 
include 'function.php';

// Cek sesi pengguna
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: admin/indexAdmin.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: admin/indexPakar.php");
    }
}

// Inisialisasi sesi
if (!isset($_SESSION['persentase'])) { $_SESSION['persentase'] = []; }
if (!isset($_SESSION['nomor_soal'])) { $_SESSION['nomor_soal'] = 1; }
if (!isset($_SESSION['id_gejala'])) { $_SESSION['id_gejala'] = 1; }

$gejala_total = 9; 
$gejala_dm1 = [1, 3]; 
$gejala_dm2 = [2, 4]; 
$gejala_gestasional = [5, 6, 7]; 
$gejala_neonatal = [8, 9]; 

function getSolusiByRisiko($persentase) {
    if ($persentase <= 30) {
        return "Risiko rendah. Anda disarankan untuk tetap menjaga pola hidup sehat.";
    } elseif ($persentase <= 60) {
        return "Risiko sedang. Disarankan untuk memperhatikan pola makan dan melakukan pemeriksaan rutin.";
    } else {
        return "Risiko tinggi. Anda perlu segera berkonsultasi dengan tenaga medis untuk mendapatkan penanganan lebih lanjut.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $persentase = $_SESSION['persentase'];
    $id_gejala = $_SESSION['id_gejala'];
    
    if (isset($_POST['ya']) || isset($_POST['tidak'])) {
        if (isset($_POST['ya'])) {
            array_push($persentase, $id_gejala);
        }
        $_SESSION['persentase'] = $persentase;
        
        if ($id_gejala < $gejala_total) {
            $_SESSION['id_gejala']++;
            $_SESSION['nomor_soal']++;
        } else {
            // Hitung persentase
            $count_dm1 = count(array_intersect($persentase, $gejala_dm1));
            $count_dm2 = count(array_intersect($persentase, $gejala_dm2));
            $count_gestasional = count(array_intersect($persentase, $gejala_gestasional));
            $count_neonatal = count(array_intersect($persentase, $gejala_neonatal));
            
            $_SESSION['dmsatu'] = ($count_dm1 / count($gejala_dm1)) * 100;
            $_SESSION['dmdua'] = ($count_dm2 / count($gejala_dm2)) * 100;
            $_SESSION['gesta'] = ($count_gestasional / count($gejala_gestasional)) * 100;
            $_SESSION['neo'] = ($count_neonatal / count($gejala_neonatal)) * 100;
            
            $_SESSION['solusi_dm1'] = getSolusiByRisiko($_SESSION['dmsatu']);
            $_SESSION['solusi_dm2'] = getSolusiByRisiko($_SESSION['dmdua']);
            $_SESSION['solusi_gesta'] = getSolusiByRisiko($_SESSION['gesta']);
            $_SESSION['solusi_neo'] = getSolusiByRisiko($_SESSION['neo']);
            
            header('Location: hasil.php');
            exit;
        }
    }

    if (isset($_POST['back']) && $_SESSION['nomor_soal'] > 1) {
        $_SESSION['id_gejala']--;
        $_SESSION['nomor_soal']--;
    }
}

$id_gejala = $_SESSION['id_gejala'];
$data = mysqli_query($koneksi, "SELECT gejala FROM gejala WHERE id_gejala = '$id_gejala'");
$row = mysqli_fetch_assoc($data);
$gejala_text = $row ? $row['gejala'] : "Data gejala tidak ditemukan.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/custom.css" />
    <title>D3M</title>
</head>
<body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/img/logobaru.jpg" width="147" alt="logobaru" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li><a class="btn px-4 btn-primary ml-2" href="logout.php" role="button">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="test mt-5">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h2 class="mb-4">Pertanyaan :</h2>
                    <form action="" method="post" enctype="multipart/form-data" role="form">
                        <p class="mb-4">Pertanyaan <?= $_SESSION['nomor_soal']; ?>: Apakah Anda <?= $gejala_text; ?>?</p>
                        
                        <input type="submit" class="btn btn-primary mr-2 px-4 py-2" name="ya" value="Ya">
                        <input type="submit" class="btn btn-danger px-3 py-2" name="tidak" value="Tidak">
                        
                        <?php if ($_SESSION['nomor_soal'] > 1): ?>
                            <input type="submit" class="btn btn-secondary px-3 py-2" name="back" value="Back">
                        <?php endif; ?>
                    </form>
                </div>
                <div class="col d-none d-sm-block">
                    <img width="500" src="assets/img/jawab.jpg" alt="hero" />
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</html>