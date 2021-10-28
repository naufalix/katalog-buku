<?php  
  session_start(); 
  include('../koneksi/koneksi.php'); 
  $id_user = $_SESSION['id_user'];
  if (!isset($id_user)) {header("Location:index.php");}
  $passl = MD5($_POST['pass_lama']);
  $passb = $_POST['pass_baru']; 
  $passk = $_POST['konfirmasi']; 

  //get password 
  $sql = "select `password` from `user` where `id_user`='$id_user'"; 
  $query = mysqli_query($koneksi, $sql); 
  while($data = mysqli_fetch_row($query)){ 
    $pass = $data[0];
  }

  if($passl==MD5("")){$pl="kosong";}
  if(empty($passb)){$pb="kosong";}
  if(empty($passk)){$pk="kosong";}
  if($passl!=MD5("")&&$passl!=$pass){$pl="salah";}
  if(!empty($passb)&&$pass==MD5($passb)){$pb="sama";}
  if(!empty($passb)&&!empty($passk)&&$passb!=$passk){$pk="salah";}
  

  if(!empty($pl)||!empty($pb)||!empty($pk)){ 
    header("Location:ubahpassword.php?passl=".$pl."&passb=".$pb."&passk=".$pk);
  }else {
    //echo "pass  = ".$pass."<br>passl = ".$passl."<br>passb = ".$passb."<br>passk = ".$passk."<br>";
    $password = MD5($passb);
    $sql_p = "UPDATE `user` SET `password`='$password' WHERE `id_user`='$id_user'";
    mysqli_query($koneksi,$sql_p);
    header("Location:ubahpassword.php?notif=editberhasil");
  }
?> 