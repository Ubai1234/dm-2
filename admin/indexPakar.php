<?php
include "../function.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: ../test.php");
    }
} else {
    header("location: ../index.php");
}
$sql = "SELECT * FROM riwayat_konsultasi
        join user on riwayat_konsultasi.id_user = user.id_user 
        join penyakit on riwayat_konsultasi.id_penyakit = penyakit.id_penyakit 
";
$queryPasien = mysqli_query($koneksi, $sql);
$jumlahPasien = mysqli_query($koneksi, "SELECT COUNT('id_user') as jml_pasien FROM user WHERE role='1'");
$pasien = mysqli_fetch_assoc($jumlahPasien);
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
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Pasien</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pasien['jml_pasien']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow  ml-3 mb-12">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Riwayat</h6>
        </div>
        <div class="card-body">
            <form method="post" encytpe="multipart/form-data">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <?php if($_SESSION['role'] == 0) { echo'<th>Aksi</th>'; }?>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Alamat</th>
                            <th>Tgl Lahir</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($queryPasien)) { ?>
                    <tr>
                        <td>
                        <a class="badge badge-pill badge-primary" href="ubahPakar.php?id_user=<?php echo $data["id_user"]; ?>">edit</a> |
                        <a href="../function.php?act=hapusPakar&id_user=<?= $data["id_user"]; ?>" onclick="return confirm('Yakin ingin menghapus data?');" class="badge badge-pill badge-danger">hapus</a>
                        </td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['penyakit']; ?></td>
                        <td><?= $data['alamat']; ?></td>
                        <td><?= $data['tgl_lahir']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
            </form>
        </div>
    </div>
    </div>
    </div>
</body>
</html>