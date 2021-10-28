<?php  
session_start(); 
include('../koneksi/koneksi.php'); 
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$id_user = $_SESSION['id_user'];
$tanggal = date("Y-m-d");
$id_kategori_blog = $_POST['kategori'];
if (empty($id_kategori_blog)) {
	$id_kategori_blog = "0";
}
if(empty($judul)||empty($isi)){ 
 header("Location:tambahblog.php?notif=tambahkosong"); 
}else{ 
 $sql = "insert into `blog` (`id_kategori_blog`, `id_user`, `tanggal`, `judul`, `isi`) 
 values ('$id_kategori_blog', '$id_user', '$tanggal', '$judul', '$isi')"; 
 mysqli_query($koneksi,$sql); 
 header("Location:blog.php?notif=tambahberhasil"); 
 //echo  $judul."<br>".$isi."<br>".$id_user."<br>".$tanggal."<br>".$id_kategori_blog;
} 
?> 