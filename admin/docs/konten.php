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
            <h3><i class="fas fa-file-alt"></i> Konten</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Konten</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Konten</h3>
                <div class="card-tools">
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
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
                <div class="col-sm-12"> 
                  <?php if(!empty($_GET['notif'])){?> 
                    <?php if($_GET['notif']=="tambahberhasil"){?> 
                      <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div> 
                    <?php } else if($_GET['notif']=="editberhasil"){?> 
                      <div class="alert alert-success" role="alert">Data Berhasil Diubah</div> 
                    <?php }?> 
                  <?php }?> 
                </div> 
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="20%">Judul</th>
                      <th width="50%">Isi</th>
                      <th width="15%">Tanggal</th>
                      <th width="10%"><center>Aksi</center></th>
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
                    $sql_u = "SELECT `id_konten`,`judul`,`isi`,`tanggal` FROM `konten` ";  
                    if (isset($_GET["katakunci"])){ 
                      $katakunci = $_GET["katakunci"];
                    }else {
                      $katakunci = "";
                    }
                    $sql_u .= " where `judul` LIKE '%$katakunci%' or `isi` LIKE '%$katakunci%'";
                    $sql_u .= " ORDER BY `judul` limit $posisi, $batas";
                    $query_u = mysqli_query($koneksi,$sql_u); 
                    $posisi += 1; 
                    while($data_u = mysqli_fetch_row($query_u)){ 
                       $id_konten = $data_u[0]; 
                       $judul = $data_u[1]; 
                       $isi = $data_u[2]; 
                       $tanggal = $data_u[3]; 
                    ?>
                    <tr>
                    <td><?php echo $posisi;?></td>
                    <td><?php echo $judul;?></td>
                    <td><?php echo $isi;?></td>
                    <td><?php echo $tanggal;?></td>
                    <td align="center">
                      <a href="editkonten.php?data=<?php echo $id_konten;?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                      <a href="detailkonten.php?data=<?php echo $id_konten;?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                      <!--a href="javascript:if(confirm('Anda yakin ingin menghapus konten <?php echo $judul; ?>?'))window.location.href = 'konten.php?aksi=hapus&data=<?php echo $id_konten;?>&notif=hapusberhasil'" class="btn btn-xs btn-warning"><i class="fas fa-trash" title="Hapus"></i></a-->                         
                    </td>
                  </tr>
                  <?php $posisi++;}?> 
                </tbody>
              </table>
              </div>
              <!-- /.card-body -->
              <?php 
                //hitung jumlah semua data  
                $sql_jum = "select `judul`, `isi` from `konten` ";  
                if (isset($_GET["katakunci"])){ 
                  $katakunci = $_GET["katakunci"]; 
                  $sql_jum .= " where `judul` or `isi` LIKE '%$katakunci%'"; 
                }  
                $sql_jum .= " order by `judul`"; 
                $query_jum = mysqli_query($koneksi,$sql_jum); 
                $jum_data = mysqli_num_rows($query_jum); 
                $jum_halaman = ceil($jum_data/$batas); 
               
                $link = "konten.php";
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
