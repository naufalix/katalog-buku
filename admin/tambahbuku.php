<?php  
  session_start(); 
  include('../koneksi/koneksi.php'); 
  $id_user = $_SESSION['id_user'];
  if (!isset($id_user)) {header("Location:index.php");}
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
            <h3><i class="fas fa-plus"></i> Tambah Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="buku.php">Data Buku</a></li>
              <li class="breadcrumb-item active">Tambah Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data Buku</h3>
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
          <?php if($_GET['notif']=="tambahkosong"){?> 
          <div class="alert alert-danger" role="alert">Maaf semua data wajib di isi</div> 
          <?php }?> 
        <?php }?>
      </div>
      <form class="form-horizontal" method="post" action="konfirmasitambahbuku.php" enctype="multipart/form-data">
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
                  $sql_k = "select `id_kategori_buku`, `kategori_buku` from `kategori_buku` order by `kategori_buku`";
                  $query_k = mysqli_query($koneksi,$sql_k); 
                  while($data_k = mysqli_fetch_row($query_k)){ 
                    $id_kategori_buku = $data_k[0]; 
                    $kategori_buku = $data_k[1];
                ?>
                <option value="<?= $id_kategori_buku ?>"><?=$kategori_buku?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="judul" id="judul" value="" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="pengarang" id="pengarang" value="" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Penerbit</label>
            <div class="col-sm-7">
              <select class="form-control" id="penerbit" name="penerbit">
                <option value="0">- Pilih Kategori -</option>
                <?php 
                  $sql_k = "select `id_penerbit`, `penerbit` from `penerbit` order by `penerbit`";
                  $query_k = mysqli_query($koneksi,$sql_k); 
                  while($data_k = mysqli_fetch_row($query_k)){ 
                    $id_penerbit = $data_k[0]; 
                    $penerbit = $data_k[1];
                ?>
                <option value="<?= $id_penerbit ?>"><?=$penerbit?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tahun Terbit</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <input type="text" class="form-control" name="tahun" id="datepicker-year"  autocomplete="off" value="" required>
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="sinopsis" id="sinopsis" rows="12" value=""required></textarea>
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
                <input type="checkbox" name="tag[]" value="<?= $id_tag  ?>"> <?= $tag  ?>
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
            <button type="submit" class="btn btn-info float-right"><i class="fas fa-plus"></i> Tambah</button>
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
