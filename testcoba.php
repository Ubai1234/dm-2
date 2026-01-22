<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
    }
}

if(!isset($_SESSION['persentase'])){
    $_SESSION['persentase'] = [];
}

if(!isset($_SESSION['no'])){
    $_SESSION['no'] = 1;  // Set nomor pertanyaan mulai dari 1
}

$gejala = mysqli_query($koneksi, "SELECT * FROM gejala");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"/>
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
    rel="stylesheet"/>
    <link rel="stylesheet" href="custom.css" />
    <title>D3M</title>
</head>
<body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"
            ><img src="logobaru.jpg" width="147" alt="logobaru"
            /></a>
            <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="btn px-4 btn-primary ml-2" href="logout.php" role="button"
                    >Log Out</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <section class="test mt-5">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h2 class="mb-4">Pertanyaan : </h2>
                    <form action="" method="post" enctype="multipart/form-data" role="form">
                    <?php
                        $id_penyakit=1;
                        $id = gejala($id_penyakit);
                        $id_gejala = intval($id);
                        if(!isset($_SESSION['id_gejala'])){
                            $_SESSION['id_gejala'] = $id_gejala;
                        }else{
                            $id_gejala = $_SESSION['id_gejala'];
                        }
                        $data = mysqli_query($koneksi, "SELECT gejala FROM gejala WHERE id_gejala = '$id_gejala'");
                        $row = mysqli_fetch_assoc($data);
                    ?>
                    <p class="mb-4">
                        Pertanyaan <?= $_SESSION['no']; ?>: Apakah anda <?= $row['gejala']; ?> ?
                    </p>
                    <input type="submit" class="btn btn-primary mr-2 px-4 py-2" name="ya" value="Ya">
                    <input type="submit" class="btn btn-danger px-3 py-2" name="tidak" value="Tidak">
                    <input type="submit" class="btn btn-secondary px-3 py-2" name="next" value="Next">
                    <input type="submit" class="btn btn-secondary px-3 py-2" name="back" value="Back">
                    
                    <?php 
                        $persentase = $_SESSION['persentase'];
                        $temp = 0;
                        $_SESSION['id_gejala'] = $id_gejala;
                        $next_gejala = $_SESSION['id_gejala'];

                        // Proses jika jawaban "Ya"
                        if(isset($_POST['ya'])){
                            if(isset($id_gejala)){
                                $temp = $id_gejala;
                                array_push($persentase, $temp);
                            }
                            $_SESSION['persentase'] = $persentase;
                            $next_gejala = $id_gejala + 1;
                            $_SESSION['id_gejala'] = $next_gejala;
                            $_SESSION['no'] += 1;
                        } 
                        // Proses jika jawaban "Tidak"
                        else if(isset($_POST['tidak'])){
                            $next_gejala = $id_gejala + 1;
                            $_SESSION['id_gejala'] = $next_gejala;
                            $_SESSION['no'] += 1;
                        }
                        // Proses jika tombol "Next" ditekan
                        else if(isset($_POST['next'])){
                            $_SESSION['id_gejala'] += 1;
                            $_SESSION['no'] += 1;
                        }
                        // Proses jika tombol "Back" ditekan
                        else if(isset($_POST['back']) && $_SESSION['id_gejala'] > 1){
                            $_SESSION['id_gejala'] -= 1;
                            $_SESSION['no'] -= 1;
                        }
                        
                        // Cek jika sudah lebih dari 27 gejala
                        if($_SESSION['id_gejala'] > 27) {
                        
                        $dmsatu = array(1,2,3,4,5,8,9,10,11,12,13,14,15,16,17,20,23,25,26,27);
                        $dmdua = array(1,2,3,4,5,6,7,8,10,12,13,15,16,17,18,19,20,21,25,26,27);
                        $gesta = array(1,2,3,4,5,6,7,8,10,12,13,15,16,17,20,21,24,25,26,27);
                        $neo = array(1,2,3,5,7,8,12,15,16,25,27);
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $dmsatu)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            } 
                        }
                        $dmSatu = $nilai/count($dmsatu);
                        $Akut = number_format($dmSatu,3);
                        $hasildmSatu = $Akut *100;
                        $_SESSION['dmsatu'] = $hasildmSatu;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $dmdua)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $dmDua = $nilai/count($dmdua);
                        $Kronis = number_format($dmDua,3);
                        $hasildmDua = $Kronis *100;
                        $_SESSION['dmdua'] = $hasildmDua;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $gesta)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $Gesta = $nilai/count($gesta);
                        $Batu = number_format($Gesta,3);
                        $hasilGesta = $Batu *100;
                        $_SESSION['gesta'] = $hasilGesta;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $neo)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $Neo = $nilai/count($neo);
                        $Infeksi = number_format($Neo,3);
                        $hasilNeo = $Infeksi *100;
                        $_SESSION['neo'] = $hasilNeo;
                        header('Location:hasil.php');
                    }
                    ?>
                    <br>
                    
                </div>
                    </form>
                <div class="col d-none d-sm-block">
                    <img width="500" src="jawab.jpg" alt="hero" />
                </div>
            </div>
        </div>
    </section>
</body>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
