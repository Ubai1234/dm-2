<?php 
include 'function.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: admin/indexAdmin.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: admin/indexPakar.php");
    }
} else {
    header("location:index.php");
}

$dmsatu = $_SESSION['dmsatu'] ?? 0;
$dmdua = $_SESSION['dmdua'] ?? 0;
$gesta = $_SESSION['gesta'] ?? 0;
$neo = $_SESSION['neo'] ?? 0;

function checkRisk($percentage) {
    return $percentage > 50 ? 'Beresiko' : 'Tidak Beresiko';
}

function getSolution($id_penyakit, $koneksi) {
    $query = "SELECT solusi FROM solusi WHERE id_penyakit = '$id_penyakit'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['solusi'] ?? 'Solusi tidak ditemukan';
}

function maximum($a, $b, $c, $d) {
    $max = $a; $kode = 1;
    if ($b > $max) { $max = $b; $kode = 2; }
    if ($c > $max) { $max = $c; $kode = 3; }
    if ($d > $max) { $max = $d; $kode = 4; }
    return $kode;
}

$riskDmsatu = checkRisk($dmsatu);
$riskDmdua = checkRisk($dmdua);
$riskGesta = checkRisk($gesta);
$riskNeo = checkRisk($neo);
$hasRisk = $riskDmsatu == 'Beresiko' || $riskDmdua == 'Beresiko' || $riskGesta == 'Beresiko' || $riskNeo == 'Beresiko';

$solusi = 'Tidak ada solusi';
if ($hasRisk) {
    $id_penyakit = maximum($dmsatu, $dmdua, $gesta, $neo);
    $solusi = getSolution($id_penyakit, $koneksi);
    $id_user = $_SESSION['id_user'];
    $query = "INSERT INTO riwayat_konsultasi (id_user, dmsatu, dmdua, gesta, neo, id_penyakit, solusi) 
              VALUES ('$id_user', '$dmsatu', '$dmdua', '$gesta', '$neo', '$id_penyakit', '$solusi')";
    mysqli_query($koneksi, $query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/custom.css" />
    <title>D3M</title>
</head>
<body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/img/logobaru.jpg" width="147" alt="logobaru"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li><a class="btn px-2 py-2 btn-success ml-2" href="function.php?act=ulang" role="button">Cek Ulang</a></li>
                    <li><a class="btn px-2 py-2 btn-primary ml-2" href="logout.php" role="button">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="hasil mt-4">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h3 class="mb-4">Hasil D3M, Anda adalah : </h3>
                    <h5 class="mb-4"><div class="py-1"><strong><?= $riskDmsatu; ?></strong></div></h5>
                    <h3 class="mb-4">Saran untuk hasil dari D3M anda adalah:</h3>
                    <p><?= $solusi; ?></p>
                </div>
                <div class="col d-none d-sm-block"><img width="500" src="assets/img/hasil.jpg" alt="hero" /></div>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</html>