<?php
include "../function.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: ../test.php");
    }
} else {
    header("location: ../index.php");
}
$id_gejala = $_GET["id_gejala"];
$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");
$query = mysqli_query($koneksi, "SELECT * FROM relasi INNER JOIN penyakit ON relasi.id_penyakit = penyakit.id_penyakit INNER JOIN gejala ON relasi.id_gejala = gejala.id_gejala WHERE relasi.id_gejala = '$id_gejala'");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet"/>
</head>
<body >
    <div class="kiri">
        <section class="logo">
            <img src="../assets/img/logobaru.jpg" alt="logobaru" height="70px" />
        </section>
        <div class="sidebar-heading"><h5 class="font-weight-bold text-white text-uppercase teks">Data User</h5></div>
        <section class="isi"><a class="nav-link" href="indexAdmin.php"><span>Data Pasien</span></a></section>
        <section class="isi"><a class="nav-link" href="indexPakar.php"><span>Data Riwayat</span></a></section>
        <div class="sidebar-heading"><h5 class="font-weight-bold text-white text-uppercase teks">Gejala & Status</h5></div>
        <section class="isi"><a class="nav-link" href="indexPenyakit.php"><span>Data Status</span></a></section>
        <section class="isi"><a class="nav-link" href="indexGejala.php"><span>Data Gejala</span></a></section>
        <div class="sidebar-heading"><h5 class="font-weight-bold text-white text-uppercase teks">Solusi</h5></div>
        <section class="isi"><a class="nav-link" href="indexSolusi.php"><span>Data Solusi</span></a></section>
        <section class="isi"><a class="nav-link" href="../logout.php"><span>Logout</span></a></section>
    </div>

    <div class="kanan">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ubah Data Gejala</h1>
            </div>
            <div class="row">
                <form action="../function.php?act=ubahGejala&id_gejala=<?= $data['id_gejala']; ?>" id="ubah" method="POST">
                    <div class="form-group">
                        <label for="namaGejala">Nama Gejala</label>
                        <input type="text" class="form-control" id="namaGejala" name="namaGejala" value="<?= $data['gejala']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_penyakit">Penyakit</label>
                        <select class="form-control" id="id_penyakit" name="id_penyakit">
                            <?php while ($penyakit = mysqli_fetch_assoc($queryPenyakit)) { ?>
                                <option value="<?= $penyakit['id_penyakit']; ?>" <?= ($penyakit['id_penyakit'] == $data['id_penyakit']) ? 'selected' : ''; ?>><?= $penyakit['penyakit']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="submit" name="ubah_btn" id="ubah" class="btn btn-primary" value="Ubah">
                </form>
            </div>
        </div>
    </div>
</body>
</html>