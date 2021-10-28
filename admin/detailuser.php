<?php  
  session_start(); 
  include('../koneksi/koneksi.php');
  if (!isset($_SESSION['id_user'])) {header("Location:index.php");} 
  if (!isset($_GET['data'])||$_GET['data']=="") {header("Location:user.php");} 
  if ($_SESSION['level']!="superadmin") {header("Location:profil.php");}
  if(isset($_GET['data'])){ 
    $id_user = $_GET['data'];
    //get data user
    $sql_u = "SELECT `id_user`,`nama`,`email`,`username`,`level`,`foto` FROM `user` WHERE `id_user`=$id_user ORDER BY `id_user`"; 
    $query_u = mysqli_query($koneksi,$sql_u); 
    while($data_u = mysqli_fetch_row($query_u)){ 
       $id_user = $data_u[0]; 
       $nama = $data_u[1]; 
       $email = $data_u[2]; 
       $username = $data_u[3];
       $level = $data_u[4]; 
       $foto = $data_u[5]; 
    } 
  } else {header("Location:user.php");}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php")?> 
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
            <h3><i class="fas fa-user-tie"></i> Detail Data User</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="user.php">Data User</a></li>
              <li class="breadcrumb-item active">Detail Data User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <a href="user.php" class="btn btn-sm btn-warning float-right">
                  <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <tbody>  
                      <tr>
                        <td colspan="2"><i class="fas fa-user-circle"></i> <strong>Data User<strong></td>
                      </tr>                      
                      <tr>
                        <td><strong>Foto User<strong></td>
                        <td>
                          <!-- <img src="foto/<?=$foto?>" class="img-fluid" width="200px;"> -->
                          <div style="width: 190px; height: 190px; background-image: url(foto/<?php echo $foto;?>); background-size: cover; border-radius: 50%;"></div>
                        </td>
                      </tr>               
                      <tr>
                        <td width="20%"><strong>Nama<strong></td>
                        <td width="80%"><?=$nama?></td>
                      </tr>                 
                      <tr>
                        <td width="20%"><strong>Email<strong></td>
                        <td width="80%"><?=$email?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Level<strong></td>
                        <td width="80%"><?=$level?></td>
                      </tr>                 
                      <tr>
                        <td width="20%"><strong>Username<strong></td>
                        <td width="80%"><?=$username?></td>
                      </tr> 
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">&nbsp;</div>
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
