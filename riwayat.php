<?php 
include 'function.php';
// Simpan riwayat konsultasi setelah solusi ditampilkan
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user']; // Ambil ID user dari session
    $id_penyakit = $id_penyakit; // ID penyakit dari fungsi maximum
    $dmsatu = $_SESSION['dmsatu'];
    $dmdua = $_SESSION['dmdua'];
    $gesta = $_SESSION['gesta'];
    $neo = $_SESSION['neo'];
    
    // Ambil solusi dari database
    $query_solusi = "SELECT solusi FROM solusi WHERE id_penyakit = '$id_penyakit'";
    $result_solusi = mysqli_query($koneksi, $query_solusi);
    $solusi = "";
    
    while ($row = mysqli_fetch_array($result_solusi)) {
        $solusi .= $row['solusi'] . "\n"; // Gabungkan semua solusi
    }

    // Simpan ke tabel riwayat_konsultasi
    $query_simpan = "INSERT INTO riwayat_konsultasi (id_user, id_penyakit, persentase_diabetes_tipe1, persentase_diabetes_tipe2, persentase_dm_gestasional, persentase_dm_neonatal, solusi) 
                     VALUES ('$id_user', '$id_penyakit', '$dmsatu', '$dmdua', '$gesta', '$neo', '$solusi')";
    mysqli_query($koneksi, $query_simpan);
}


 ?>
 <h3 class="mb-4">Riwayat Konsultasi Anda:</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal Konsultasi</th>
            <th>Penyakit</th>
            <th>Diabetes Tipe 1 (%)</th>
            <th>Diabetes Tipe 2 (%)</th>
            <th>DM Gestasional (%)</th>
            <th>DM Neonatal (%)</th>
            <th>Solusi</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        // Ambil ID user dari session
        $id_user = $_SESSION['id_user'];
        // Query untuk mengambil riwayat konsultasi
        $query_riwayat = "SELECT r.*, p.nama_penyakit FROM riwayat_konsultasi r 
                          JOIN penyakit p ON r.id_penyakit = p.id 
                          WHERE r.id_user = '$id_user'
                          ORDER BY r.waktu_konsultasi DESC";
        $result_riwayat = mysqli_query($koneksi, $query_riwayat);

        // Tampilkan riwayat konsultasi
        while ($row = mysqli_fetch_array($result_riwayat)) {
            echo "<tr>";
            echo "<td>" . $row['waktu_konsultasi'] . "</td>";
            echo "<td>" . $row['nama_penyakit'] . "</td>";
            echo "<td>" . $row['persentase_diabetes_tipe1'] . "%</td>";
            echo "<td>" . $row['persentase_diabetes_tipe2'] . "%</td>";
            echo "<td>" . $row['persentase_dm_gestasional'] . "%</td>";
            echo "<td>" . $row['persentase_dm_neonatal'] . "%</td>";
            echo "<td>" . nl2br($row['solusi']) . "</td>"; // Menggunakan nl2br untuk line breaks
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<?php 
// Simpan riwayat konsultasi setelah solusi ditampilkan
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $id_penyakit = $id_penyakit; // Ini dari fungsi maximum
    $dmsatu = $_SESSION['dmsatu'];
    $dmdua = $_SESSION['dmdua'];
    $gesta = $_SESSION['gesta'];
    $neo = $_SESSION['neo'];

    // Ambil solusi dari database
    $query_solusi = "SELECT solusi FROM solusi WHERE id_penyakit = '$id_penyakit'";
    $result_solusi = mysqli_query($koneksi, $query_solusi);
    $solusi = "";

    while ($row = mysqli_fetch_array($result_solusi)) {
        $solusi .= $row['solusi'] . "\n"; // Gabungkan semua solusi
    }

    // Simpan ke tabel riwayat_konsultasi
    $query_simpan = "INSERT INTO riwayat_konsultasi (id_user, id_penyakit, persentase_diabetes_tipe1, persentase_diabetes_tipe2, persentase_dm_gestasional, persentase_dm_neonatal, solusi) 
                     VALUES ('$id_user', '$id_penyakit', '$dmsatu', '$dmdua', '$gesta', '$neo', '$solusi')";
    mysqli_query($koneksi, $query_simpan);
}

 ?>
