<?php
include "function.php";

// Cek session pengguna sebelum melanjutkan
if (isset($_SESSION['role'])) {
    // Jika pengguna adalah role 1, arahkan ke halaman lain
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
        exit; // Pastikan proses berhenti setelah pengalihan
    }
} else {
    // Jika session tidak ada, arahkan ke halaman login
    header("location:index.php");
    exit;
}

// Jika Anda perlu query untuk data penyakit, pastikan query ini sudah dijalankan
$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"/>
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
        rel="stylesheet"/>
    <style>
        /* Tambahkan gaya CSS jika tombol tidak muncul */
        #tambah {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="kiri">
        <section class="logo">
            <img src="gambar/logobaru.png" alt="logobaru" height="70px" />
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Data User</h5>
        </div>
        <section class="isi">
            <a class="nav-link" href="indexAdmin.php">
                <span>Data Pasien</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexPakar.php">
                <span>Data Pakar</span>
            </a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Gejala & Penyakit</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexPenyakit.php">
                <span>Data Penyakit</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexGejala.php">
                <span>Data Gejala</span>
            </a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Solusi</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexSolusi.php">
                <span>Data Solusi</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="logout.php">
                <span>Logout</span>
            </a>
        </section>
    </div>

    <div class="kanan">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between ml-4 py-5">
                <h1 class="h3 mb-0 text-gray-800 " id="tess">Form Tambah Penyakit</h1>
            </div>

            <!-- Content Row -->
            <div class="row ml-4">
                <!-- Form untuk tambah penyakit -->
                <form action="function.php?act=tambahPenyakit" method="POST" >
                    <div class="form-group">
                        <label for="namaPenyakit">Penyakit</label>
                        <input type="text" class="form-control" id="namaPenyakit" name="namaPenyakit" placeholder="Masukkan nama penyakit" required>
                    </div>

                    <!-- Button tambah -->
                    <input type="submit" name="tambah_btn" id="tambah" class="btn btn-primary" value="Tambah">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
