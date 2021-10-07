<?php 
  include('koneksi/koneksi.php'); 
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Katalog Buku</title>
    <link rel="canonical" href="../../examples/album/">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
      .bd-placeholder-img {font-size: 1.125rem; text-anchor: middle; -webkit-user-select: none;
        -moz-user-select: none; -ms-user-select: none; user-select: none;}
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {font-size: 3.5rem;}
      }
    </style>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container-fluid">
          <a class="navbar-brand me-5" href="index.php">Katalog Buku</a>
          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExample04">
            
            <ul class="navbar-nav ml-auto mb-2 mb-md-0">
              <form class="mx-4">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
              </form>
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="admin/">Login</a></li>
              <!--li class="nav-item"><a class="nav-link" href="#">Link</a></li>
              <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown04">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li-->
            </ul>
            
          </div>
        </div>
      </nav>
    </header>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1>Daftar Buku</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <!--p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p-->
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <?php 
          //query sql
          $sql_b = "SELECT `id_buku`,`judul`,`pengarang`,`cover` FROM `buku`";
          if (isset($_GET["katakunci"])){ 
            $katakunci = $_GET["katakunci"];
          }else {
            $katakunci = "";
          }
          $sql_b .= " where `judul` LIKE '%$katakunci%'";
          $sql_b .= " ORDER BY `id_buku` DESC";
          $query_b = mysqli_query($koneksi,$sql_b); 
          //$posisi += 1; 
          while($data_b = mysqli_fetch_row($query_b)){ 
             $id_buku = $data_b[0]; 
             $judul = $data_b[1];
             $pengarang = $data_b[2];
             $cover = $data_b[3]; 
        ?>
        <div class="col-md-3 col-6 text-center">
          <a href="buku.php?book=<?= $id_buku ?>" target="_blank">
            <div class="cover cover-height mx-auto shadow-sm" style="background-image: url(admin/cover/<?= $cover ?>)">    
            </div>
            <!--div class="mx-auto shadow-sm">    
              <img src="admin/cover/<?= $cover ?>" class="cover shadow-sm">  
            </div-->
          </a>
          <div class="card-body">
            <p class="card-text m-0" style="font-weight: 500"><?= $judul ?></p>
            <p class="m-0 nav-link disabled" style="font-size: 14px;"><em><?= $pengarang ?></em></p>
            <div class="d-flex m-1 justify-content-between align-items-center">
              <div class="btn-group mx-auto">
                <a href="buku.php?book=<?= $id_buku ?>" target="_blank" class="py-0 btn btn-sm btn-outline-secondary">Lihat</a>
              </div>
              <!--small class="text-muted">9 mins</small-->
            </div>
          </div>
        </div>
      <?php }?>
      </div>
    </div>
  </div>

</main>

<footer class="text-muted">
  <div class="container text-center">
    <!--p class="float-right"><a href="#">Back to top</a></p-->
    <p class="m-0">Created by Kelompok 3 (SI 2C)</p>
    <!--p>New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="../../getting-started/introduction/index.html">getting started guide</a>.</p-->
  </div>
</footer>
<script src="../../assets/js/vendor/jquery.slim.min.js" ></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
