<?php  
  session_start(); 
  include('../koneksi/koneksi.php'); 
  if (!isset($_SESSION['id_user'])) {header("Location:index.php");} 
  if (!isset($_GET['data'])||$_GET['data']=="") {header("Location:buku.php");}
  if(isset($_GET['data'])){ 
   $id_buku = $_GET['data']; 
   $_SESSION['id_buku']=$id_buku; 
   
    //get data buku
    $sql_b = "SELECT `id_kategori_buku`,`judul`,`pengarang`,`id_penerbit`,`tahun_terbit`,`sinopsis` FROM `buku` WHERE `id_buku`=$id_buku"; 
    $query_b = mysqli_query($koneksi,$sql_b); 
    while($data_b = mysqli_fetch_row($query_b)){ 
       $id_kategori_buku = $data_b[0]; 
       $judul = $data_b[1]; 
       $pengarang = $data_b[2]; 
       $id_penerbit = $data_b[3];
       $tahun_terbit = $data_b[4]; 
       $sinopsis = $data_b[5]; 
    } 
  }
?> 
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-edit"></i> Edit Data Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="buku.php">Data Buku</a></li>
              <li class="breadcrumb-item active">Edit Data Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Buku</h3>
        <div class="card-tools">
          <a href="buku.php" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
        <?php if(!empty($_GET['notif'])){?> 
          <?php if($_GET['notif']=="editkosong"){?> 
            <div class="alert alert-danger" role="alert">Maaf semua data wajib di isi</div> 
          <?php }?> 
        <?php }?> 
      </div>
      <form class="form-horizontal" method="post" action="konfirmasieditbuku.php" enctype="multipart/form-data">
        <div class="card-body">
          
        <div class="form-group row">
            <label for="foto" class="col-sm-3 col-form-label">Cover Buku </label>
            <div class="col-sm-7">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="cover" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>  
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Kategori Buku</label>
            <div class="col-sm-7">
              <select class="form-control" id="kategori" name="kategori">
                <option value="0">- Pilih Kategori -</option>
                <?php 
                  $cat = $id_kategori_buku;
                  $sql_k = "select `id_kategori_buku`, `kategori_buku` from `kategori_buku` order by `kategori_buku`";
                  $query_k = mysqli_query($koneksi,$sql_k); 
                  while($data_k = mysqli_fetch_row($query_k)){ 
                    $id_kategori_buku = $data_k[0]; 
                    $kategori_buku = $data_k[1];
                ?>
                <option value="<?= $id_kategori_buku ?>" <?php if ($cat == $id_kategori_buku) {echo "selected";} ?>><?=$kategori_buku?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="judul" id="judul" value="<?= $judul ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= $pengarang ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Penerbit</label>
            <div class="col-sm-7">
              <select class="form-control" id="penerbit" name="penerbit">
                <option value="0">- Pilih Kategori -</option>
                <?php 
                  $id_pen = $id_penerbit;
                  $sql_k = "select `id_penerbit`, `penerbit` from `penerbit` order by `penerbit`";
                  $query_k = mysqli_query($koneksi,$sql_k); 
                  while($data_k = mysqli_fetch_row($query_k)){ 
                    $id_penerbit = $data_k[0]; 
                    $penerbit = $data_k[1];
                ?>
                <option value="<?= $id_penerbit ?>" <?php if ($id_pen == $id_penerbit) {echo "selected";} ?>><?=$penerbit?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tahun Terbit</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <input type="text" class="form-control" name="tahun" id="datepicker-year"  autocomplete="off"
                value="<?= $tahun_terbit ?>">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="sinopsis" id="sinopsis" rows="12"><?= $sinopsis ?></textarea>
            </div>
          </div>          
          <div class="form-group row">
            <label for="hobi" class="col-sm-3 col-form-label">Tag</label>
            <div class="col-sm-7 row m-0">
              <?php 
                  $sql_k = "select `id_tag`, `tag` from `tag` order by `tag`";
                  $query_k = mysqli_query($koneksi,$sql_k); 
                  while($data_k = mysqli_fetch_row($query_k)){ 
                    $id_tag = $data_k[0]; 
                    $tag = $data_k[1];
                ?>
              <div style="width: 150px;">
                <input type="checkbox" name="tag[]" value="<?= $id_tag  ?>" <?php 
                  $idtag = $id_tag;
                  $sql_id = "SELECT `id_tag`, `id_buku` FROM `tag_buku` WHERE `id_buku`='$id_buku'";
                  $query_id = mysqli_query($koneksi,$sql_id); 
                    while($data_id = mysqli_fetch_row($query_id)){ 
                        $id_tag = $data_id[0];
                        $id_buku = $data_id[1];
                        if ($idtag == $id_tag) {echo "checked";}
                    }
                 ?>> <?= $tag  ?>
              </div></br>
              <?php }?>
            </div>
          </div>

          </div>
        </div>

      </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
          </div>  
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
</body>
</html>
