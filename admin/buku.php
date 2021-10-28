<?php 
  session_start(); 
  include('../koneksi/koneksi.php'); 
  $id_user = $_SESSION['id_user'];
  if (!isset($id_user)) {header("Location:index.php");}
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){ 
   if($_GET['aksi']=='hapus'){ 
   $id_buku = $_GET['data']; 
   //hapus buku 
   $sql_dh = "delete from `buku` where `id_buku` = '$id_buku'"; 
   mysqli_query($koneksi,$sql_dh); 
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
            <h3><i class="fas fa-book"></i> Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Buku</h3>
                <div class="card-tools">
                  <a href="tambahbuku.php" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Buku</a>
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
                        <th width="35">Judul</th>
                        <th width="20%">Kategori</th>
                        <th width="25%">Penerbit</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  
                      $batas = 4; 
                      if(!isset($_GET['halaman'])){ 
                        $posisi = 0; 
                        $halaman = 1; 
                      }else{ 
                        $halaman = $_GET['halaman']; 
                        $posisi = ($halaman-1) * $batas; 
                      }  
                      //query sql
                      $sql_b = "SELECT buku.id_buku, kategori_buku.kategori_buku, buku.judul, penerbit.penerbit FROM `buku` INNER JOIN `kategori_buku` ON kategori_buku.id_kategori_buku=buku.id_kategori_buku INNER JOIN `penerbit` ON penerbit.id_penerbit=buku.id_penerbit"; 
                      if (isset($_GET["katakunci"])){ 
                        $katakunci = $_GET["katakunci"];
                      }else {
                        $katakunci = "";
                      }
                      $sql_b .= " where `judul` LIKE '%$katakunci%'";
                      $sql_b .= " ORDER BY `judul` limit $posisi, $batas ";
                      $query_b = mysqli_query($koneksi,$sql_b); 
                      $posisi += 1; 
                      while($data_b = mysqli_fetch_row($query_b)){ 
                         $id_buku = $data_b[0]; 
                         $kategori_buku = $data_b[1];
                         $judul = $data_b[2];
                         $penerbit = $data_b[3]; 
                      ?>
                      <tr> 
                       <td><?php echo $posisi;?></td> 
                       <td><?php echo $judul;?></td>
                       <td><?php echo $kategori_buku;?></td>
                       <td><?php echo $penerbit;?></td> 
                       <td align="center"> 
                       <a href="editbuku.php?data=<?php echo $id_buku;?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a> 
                       <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $judul; ?>?'))window.location.href = 'buku.php?aksi=hapus&data=<?php echo $id_buku;?>&notif=hapusberhasil'"  class="btn btn-xs btn-warning"><i class="fas fa-trash"></i> Hapus</a> 
                      </td> 
                    </tr> 
                    <?php $posisi++;}?> 
                  </tbody>
                </table>  
              </div>
              <!-- /.card-body -->
              <?php 
                //hitung jumlah semua data  
                $sql_jum = "SELECT buku.id_buku, kategori_buku.kategori_buku, buku.judul, penerbit.penerbit FROM `buku` INNER JOIN `kategori_buku` ON kategori_buku.id_kategori_buku=buku.id_kategori_buku INNER JOIN `penerbit` ON penerbit.id_penerbit=buku.id_penerbit";
                if (isset($_GET["katakunci"])){ 
                  $katakunci = $_GET["katakunci"]; 
                  $sql_jum .= " where `judul` LIKE '%$katakunci%'"; 
                }  
                $sql_jum .= " order by `judul`"; 
                $query_jum = mysqli_query($koneksi,$sql_jum); 
                $jum_data = mysqli_num_rows($query_jum); 
                $jum_halaman = ceil($jum_data/$batas); 

                $link = "buku.php";
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
