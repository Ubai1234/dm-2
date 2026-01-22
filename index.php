<?php 
include 'function.php';
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
            <li class="nav-item align-self-center active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item align-self-center active">
              <a class="nav-link"  href="#alur">Alur Kerja <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item ">
              <button type="button" class="btn px-4 btn-secondary ml-5 logintombol" data-toggle="modal" data-target="#exampleModal">Log In</button>
              
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                    </div>
                    <div class="modal-body">
                      <form id="login-form" action="function.php?act=login" method="POST" >
                        <div class="form-group">
                          <div id="result"></div>
                            <label for="nama" class="col-form-label">Username :</label>
                              <input type="text" class="form-control" id="nama" name="nama" rows="3" placeholder="Username">
                              <label for="pass" class="col-form-label">Password :</label>
                              <input type="password" class="form-control" id="password" name="password" rows="3" placeholder="Password">
                          </div>
                        <div class="form-row"></div>
                        <div class="modal-footer">
                          <input type="submit" name="login_btn" id="login" class="btn btn-primary" value="Login">
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a class="btn px-4 btn-primary ml-2" href="register.php" role="button">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="heroBWA mt-5">
      <div class="container">
        <div class="row">
          <div class="col align-self-center">
            <h1 class="mb-4">D3M</h1>
            <p class="mb-4">
              D3M Merupakan sistem Deteksi Dini Diabetes Melitus Web Based yang memanfaatkan teknologi informasi terkini. Dengan menggunakan sistem ini pengguna dapat mengenali gejala yang terjadi pada tubuhnya hanya dengan menjawab pertanyaan yang diberikan oleh sistem, dan kemudian pengguna dapat melihat hasil Test dengan hasil yang ditampilkan.
            </p>
            <a class="btn btn-primary" href="register.php" role="button">Ayo Mulai!</a>
          </div>
          <div class="col d-none d-sm-block">
            <img width="500" src="assets/img/dashboard.jpg" alt="hero" />
          </div>
        </div>
      </div>
    </section>

    <section id="alur">
      <div id="konten2" class="container konten">
        <h2 style="font-weight: bold;text-align: center;">Alur Kerja Sistem D3M!</h2>
        <div class="card-deck">
          <div class="card">
            <h5 class="card-title">Login</h5>
            <img src="assets/img/login.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Pengguna harus melakukan login sebelum melangkah ke tahap selanjutnya, dan jika belum memiliki akun akan diarahkan ke menu registrasi.</p>
            </div>
          </div>
          <div class="card">
            <h5 class="card-title">Test Gejala Pasien</h5>
            <img src="assets/img/jawab.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Dalam tahap ini pengguna akan diberikan beberapa pertanyaan terkait dengan gejala yang dialami.</p>
            </div>
          </div>
          <div class="card">
            <h5 class="card-title">Hasil dan Solusi</h5>
            <img src="assets/img/hasil.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Tahap ini merupakan tahap akhir dimana setelah melaksanakan test gejala pengguna akan diberikan hasil test berupa nama penyakit dan solusinya.</p>
            </div>
          </div>
        </div>
      </div>
    </sect>

  </body>
  <script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</html>