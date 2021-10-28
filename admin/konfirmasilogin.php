<?php 
    //akses file koneksi database 
    include('../koneksi/koneksi.php'); 
    if (isset($_POST['login'])) { 
        $user = $_POST['username']; 
        $pass = $_POST['password']; 
        $username = mysqli_real_escape_string($koneksi, $user); 
        $password = mysqli_real_escape_string($koneksi, MD5($pass)); 
         
        //cek username dan password 
        $sql="select `id_user`, `level` from `user` where `username`='$username' and `password`='$password'"; 
        $query = mysqli_query($koneksi, $sql); 
        $jumlah = mysqli_num_rows($query); 
        if(empty($user)){ 
            header("Location:index.php?gagal=userKosong"); 
        }else if(empty($pass)){ 
            header("Location:index.php?gagal=passKosong"); 
        }else if($jumlah==0){ 
            header("Location:index.php?gagal=userpassSalah"); 
        }else{ 
            session_start(); 
            //get data 
            while($data = mysqli_fetch_row($query)){ 
                $id_user = $data[0]; //1 
                $level = $data[1]; //speradmin 
                $_SESSION['id_user']=$id_user; 
                $_SESSION['level']=$level; 
                header("Location:profil.php"); 
            }            
        } 
    } else {header("Location:index.php"); }
?> 