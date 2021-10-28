<?php  
session_start(); 
include('../koneksi/koneksi.php'); 
if(isset($_SESSION['id_kategori_blog'])){ 
  $id_kategori_blog = $_SESSION['id_kategori_blog']; 
  $kategori_blog = $_POST['kategori_blog']; 
  if(empty($kategori_blog)){ 
 	header("Location:editkategoriblog.php?data=".$id_kategori_blog."&notif=editkosong"); 
  }else{ 
 	$sql = "update `kategori_blog` set `kategori_blog`='$kategori_blog' where `id_kategori_blog`='$id_kategori_blog'"; 
	mysqli_query($koneksi,$sql); 
	unset($_SESSION['id_kategori_blog']); 
	header("Location:kategoriblog.php?notif=editberhasil"); 
  } 
} 
?> 