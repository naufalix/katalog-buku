<?php 
$koneksi = mysqli_connect("localhost","root","","katalog_buku"); 
// cek koneksi 
if (!$koneksi){ 
  die("Error koneksi: " . mysqli_connect_errno()); 
} 
?> 