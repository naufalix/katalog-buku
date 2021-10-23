<?php  
session_start(); 
include('../koneksi/koneksi.php'); 
if(isset($_SESSION['id_user'])){ 
$id_user = $_SESSION['id_edit_user'];
$nama = $_POST['nama']; 
$email = $_POST['email']; 
$username = $_POST['username'];

	//get password  
  $sql_p = "SELECT `password` FROM `user` WHERE `id_user`='$id_user'"; 
  $query_p = mysqli_query($koneksi,$sql_p); 
  while($data_p = mysqli_fetch_row($query_p)){ 
      $pass = $data_p[0]; 
      //echo $pass; 
  } 

if ($_POST['password']==false) {
	$password = $pass;
}
else {
	$password = MD5($_POST['password']);
}

$level = $_POST['level']; 
$lokasi_file = $_FILES['foto']['tmp_name'];
  
    //get foto  
    $sql_f = "SELECT `foto` FROM `user` WHERE `id_user`='$id_user'"; 
    $query_f = mysqli_query($koneksi,$sql_f); 
    while($data_f = mysqli_fetch_row($query_f)){ 
        $foto = $data_f[0]; 
        //echo $foto; 
    } 
  
  if(empty($nama)){ 
  header("Location:edituser.php?notif=editkosong&jenis=nama"); 
  }else if(empty($email)){ 
  header("Location:edituser.php?notif=editkosong&jenis=email"); 
  }else if(empty($username)){ 
  header("Location:edituser.php?notif=editkosong&jenis=username"); 
  }else{ 
    $lokasi_file = $_FILES['foto']['tmp_name']; 
    $nama_file = $_FILES['foto']['name']; 
    $direktori = 'foto/'.$nama_file; 
    if(move_uploaded_file($lokasi_file,$direktori)){ 
      if(!empty($foto)){ 
        unlink("foto/$foto"); 
      } 
      $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`='$password', `foto`='$nama_file', `level`='$level' where `id_user`='$id_user'";//echo $sql; 
      mysqli_query($koneksi,$sql); 
    }else{ 
      $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`='$password', `level`='$level' where `id_user`='$id_user'"; 
      //echo $sql; 
      mysqli_query($koneksi,$sql); 
    } 
    header("Location:user.php?notif=editberhasil");
    //echo $nama."<br>".$email."<br>".$username."<br>".$password."<br>".$level."<br>".$lokasi_file."<br>".$foto."<br>";

  } 
} 
  
?> 