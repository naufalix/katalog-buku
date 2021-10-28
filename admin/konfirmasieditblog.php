<?php  
session_start(); 
include('../koneksi/koneksi.php'); 
if(isset($_SESSION['id_blog'])){ 
  $id_blog = $_SESSION['id_blog']; 
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $id_user = $_SESSION['id_user'];
  $id_kategori_blog = $_POST['kategori'];
  if(empty($judul)||empty($isi)){ 
 	header("Location:editblog.php?data=".$id_blog."&notif=editkosong"); 
  }else{ 
 	$sql = "update `blog` set `judul`='$judul', `isi`='$isi', `id_user`='$id_user' where `id_blog`='$id_blog'"; 
	mysqli_query($koneksi,$sql); 
	unset($_SESSION['id_blog']); 
	header("Location:blog.php?notif=editberhasil"); 
  } 
} 
?> 