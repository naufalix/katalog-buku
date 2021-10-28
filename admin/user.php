<?php  
  session_start(); 
  include('../koneksi/koneksi.php'); 
  $id_user = $_SESSION['id_user'];
  if (!isset($id_user)) {header("Location:index.php");}
  if ($_SESSION['level']!="superadmin") {header("Location:profil.php");}
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){ 
   if($_GET['aksi']=='hapus'){ 
   $id_hapus = $_GET['data']; 
   //hapus user 
   $sql_del = "delete from `user` where `id_user` = '$id_hapus'"; 
   mysqli_query($koneksi,$sql_del); 
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
            <h3><i class="fas fa-user-tie"></i> Data User</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Data User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  User</h3>
          <div class="card-tools">
            <a href="tambahuser.php" class="btn btn-sm btn-info float-right">
            <i class="fas fa-plus"></i> Tambah  User</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="col-md-12">
            <form method="" action="">
              <div class="row">
                  <div class="col-md-4 bottom-10">
                    <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                  </div>
                  <div class="col-md-5 bottom-10">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                  </div>
              </div><!-- .row -->
            </form>
          </div><br>
            <div class="col-sm-12"> 
              <?php if(!empty($_GET['notif'])){?> 
                <?php if($_GET['notif']=="tambahberhasil"){?> 
                  <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div> 
                <?php } else if($_GET['notif']=="editberhasil"){?> 
                  <div class="alert alert-success" role="alert"> Data Berhasil Diubah</div> 
                <?php } else if($_GET['notif']=="hapusberhasil"){?> 
                  <div class="alert alert-success" role="alert">  Data Berhasil Dihapus</div> 
                <?php }?>
              <?php }?> 
            </div>
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <th width="5%">No</th>
                  <th width="30%">Nama</th>
                  <th width="30%">Email</th>
                  <th width="20%">Level</th>
                  <th width="15%"><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $batas = 2; 
                if(!isset($_GET['halaman'])){ 
                     $posisi = 0; 
                     $halaman = 1; 
                }else{ 
                     $halaman = $_GET['halaman']; 
                     $posisi = ($halaman-1) * $batas; 
                }
                //query sql
                $sql_u = "SELECT `id_user`,`nama`,`email`,`level` FROM `user` ";  
                if (isset($_GET["katakunci"])){ 
                  $katakunci = $_GET["katakunci"];
                }else {
                  $katakunci = "";
                }
                $sql_u .= " where `nama` LIKE '%$katakunci%' or `email` LIKE '%$katakunci%'";
                $sql_u .= " ORDER BY `nama` limit $posisi, $batas";
                $query_u = mysqli_query($koneksi,$sql_u); 
                $posisi += 1; 
                while($data_u = mysqli_fetch_row($query_u)){ 
                   $id_user = $data_u[0]; 
                   $nama = $data_u[1]; 
                   $email = $data_u[2]; 
                   $level = $data_u[3]; 
                ?> 
                <tr>
                  <td><?php echo $posisi;?></td>
                  <td><?php echo $nama;?></td>
                  <td><?php echo $email;?></td>
                  <td><?php echo $level;?></td>
                  <td align="center">
                    <a href="edituser.php?data=<?php echo $id_user;?>" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="detailuser.php?data=<?php echo $id_user;?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                    <a href="javascript:if(confirm('Anda yakin ingin menghapus user <?php echo $nama; ?>?'))window.location.href = 'user.php?aksi=hapus&data=<?php echo $id_user;?>&notif=hapusberhasil'" class="btn btn-xs btn-warning"><i class="fas fa-trash" title="Hapus"></i></a>                         
                  </td>
                </tr>
                <?php $posisi++;}?> 
              </tbody>
            </table>  
          </div>
          <!-- /.card-body -->
          <?php 
            //hitung jumlah semua data  
            $sql_jum = "select `nama`, `email` from `user` ";  
            if (isset($_GET["katakunci"])){ 
              $katakunci = $_GET["katakunci"]; 
              $sql_jum .= " where `nama` or `email` LIKE '%$katakunci%'"; 
            }  
            $sql_jum .= " order by `nama`"; 
            $query_jum = mysqli_query($koneksi,$sql_jum); 
            $jum_data = mysqli_num_rows($query_jum); 
            $jum_halaman = ceil($jum_data/$batas); 
           
            $link = "user.php";
            include("includes/pagination.php")
          ?>
          
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
