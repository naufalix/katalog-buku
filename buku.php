<?php 
  include('koneksi/koneksi.php'); 
  if (!isset($_GET['book'])||$_GET['book']=="") {header("Location:index.php");}
  if(isset($_GET['book'])){ 
   $id_buku = $_GET['book']; 
    //get data buku
    $sql_b = "SELECT `id_kategori_buku`,`judul`,`pengarang`,`id_penerbit`,`tahun_terbit`,`sinopsis`,`cover` FROM `buku` WHERE `id_buku`=$id_buku"; 
    $query_b = mysqli_query($koneksi,$sql_b); 
    while($data_b = mysqli_fetch_row($query_b)){ 
       $id_kategori_buku = $data_b[0]; 
       $judul = $data_b[1]; 
       $pengarang = $data_b[2]; 
       $id_penerbit = $data_b[3];
       $tahun_terbit = $data_b[4]; 
       $sinopsis = $data_b[5]; 
       $cover = $data_b[6]; 
    }
    $sql_pk = "SELECT kategori_buku.kategori_buku, penerbit.penerbit FROM `buku` INNER JOIN `kategori_buku` ON kategori_buku.id_kategori_buku=buku.id_kategori_buku INNER JOIN `penerbit` ON penerbit.id_penerbit=buku.id_penerbit where `id_buku`=$id_buku"; 
    $query_pk = mysqli_query($koneksi,$sql_pk); 
    while($data_pk = mysqli_fetch_row($query_pk)){ 
       $kategori_buku = $data_pk[0];
       $penerbit = $data_pk[1]; 
    }
  }   
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
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

  <div>
    <div class="container">
      <div class="row p-1">
        <div class="col-md-4 col-11 p-1 text-center mx-auto"> 
          <img src="admin/cover/<?= $cover ?>" class="cover shadow-lg mt-4" style="width: 80%;">   
        </div>
        <div class="col-md-7 col-12 p-2">
          <h2 class="text-center my-4"><?= $judul ?></h2>
          <ul class="series-infolist">
            <li><b>Pengarang</b><p><?= $pengarang ?></p></li>
            <li><b>Penerbit</b><p><?= $penerbit ?></p></li>
            <li><b>Tahun terbit</b><p><?= $tahun_terbit ?></p></li>
            <li><b>Kategori</b><p><?= $kategori_buku ?></p></li>
            <!--li>
              <b>Serialization</b><p> <a href="https://mangakane.com/serialization/margaret/" rel="tag">Margaret</a></p>
            </li-->
          </ul>
          <div class="series-synops">
            <p><b>Sinopsis :</b></p>
            <p><?= $sinopsis ?></p>
          </div>
          
        </div>
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
