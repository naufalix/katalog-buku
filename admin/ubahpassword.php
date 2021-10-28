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
            <h3><i class="fas fa-user-lock"></i> Ubah Password</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Ubah Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Pengaturan Password</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <div class="col-sm-10">
        <?php if(!empty($_GET['notif'])){?> 
          <?php if($_GET['notif']=="editberhasil"){?> 
            <br><div class="alert alert-success" role="alert">Password berhasil diubah</div> 
          <?php }?> 
        <?php }?> 
      </div>
      <form class="form-horizontal" method="post" action="konfirmasiubahpassword.php">
        <div class="card-body">
          <h6>
            <i class="text-blue"><i class="fas fa-info-circle"></i> Silahkan memasukkan password lama dan password baru Anda untuk mengubah password.</i>
          </h6><br>
          <!-- <div class="form-group row">
            <label for="pass_lama" class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="pass_lama" name="pass_lama" value="">
              <span class="text-danger">Mohon maaf, password lama wajib diisi.</span>
            </div>
          </div> -->
          <div class="form-group row">
            <label for="pass_lama" class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-9 col-sm-6" style="padding-right: 0px">
              <input type="password" class="inpass form-control" id="input-passl" name="pass_lama" value="">
              <?php if(!empty($_GET['passl'])){?> 
                <?php if($_GET['passl']=="kosong"){?> 
                  <span class="text-danger">Mohon maaf, password lama wajib diisi.</span>
                <?php } else if($_GET['passl']=="salah"){?> 
                  <span class="text-danger">Password Salah!</span>
                <?php }?>
              <?php }?>
            </div>
            <div><p id="passl" class="showpass form-control">
              <i id="hide-passl" class="fas fa-eye-slash" style="color: #ced4da" onclick="show('passl')"></i>
              <i id="show-passl" class="fas fa-eye" style="display: none" onclick="hide('passl')"></i>
            </p></div>
          </div>

          <div class="form-group row">
            <label for="pass_baru" class="col-sm-3 col-form-label">Password Baru</label>
            <div class="col-9 col-sm-6" style="padding-right: 0px">
              <input type="password" class="inpass form-control" id="input-passb" name="pass_baru" value="">
              <?php if(!empty($_GET['passb'])){?> 
                <?php if($_GET['passb']=="kosong"){?> 
                  <span class="text-danger">Mohon maaf, password baru wajib diisi.</span>
                <?php } else if($_GET['passb']=="sama"){?> 
                  <span class="text-danger">Password baru tidak boleh sama dengan password lama!</span>
                <?php }?>
              <?php }?>
            </div>
            <div><p id="passb" class="showpass form-control">
              <i id="hide-passb" class="fas fa-eye-slash" style="color: #ced4da" onclick="show('passb')"></i>
              <i id="show-passb" class="fas fa-eye" style="display: none" onclick="hide('passb')"></i>
            </p></div>
          </div>

          <div class="form-group row">
            <label for="konfirmasi" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-9 col-sm-6" style="padding-right: 0px">
              <input type="password" class="inpass form-control" id="input-passk" name="konfirmasi" value="">
              <?php if(!empty($_GET['passk'])){?> 
                <?php if($_GET['passk']=="kosong"){?> 
                  <span class="text-danger">Mohon maaf, konfirmasi password baru wajib diisi.</span>
                <?php } else if($_GET['passk']=="salah"){?> 
                  <span class="text-danger">Konfirmasi Salah!</span>
                <?php }?>
              <?php }?>
            </div>
            <div><p id="passk" class="showpass form-control">
              <i id="hide-passk" class="fas fa-eye-slash" style="color: #ced4da" onclick="show('passk')"></i>
              <i id="show-passk" class="fas fa-eye" style="display: none" onclick="hide('passk')"></i>
            </p></div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-10">
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
