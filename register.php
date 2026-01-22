<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: register.php");
    } else if ($_SESSION['role'] == 1) {
        header("location: test.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: admin/indexPakar.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/custom.css" />
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<title>D3M</title>
</head>
<body>
<div class="container">
    <div class="card text-center">
        <div class="card-title">
            <h1 class="card-title">Halaman Registrasi</h1>
        </div>
        <div class="card-body ">
            <form id="registrationForm" method="POST" action="function.php?act=register" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="nama">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                    </div>
                </div>
                <button type="submit" name="submitButton" id="submitButton" class="registerbtn btn btn-primary">Register</button>
                <br>
                <div class="container signin">
                    <p>Sudah punya akun? <a href="index.php">Log In</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
(function() {
'use strict';
window.addEventListener('load', function() {
var forms = document.getElementsByClassName('needs-validation');
var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
    }, false);
});
}, false);
})();
</script>
</body>
</html>