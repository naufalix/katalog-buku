<?php 
session_start(); 
include('../koneksi/koneksi.php'); 
$id_buku = $_SESSION['id_buku'];
$id_kategori_buku = $_POST['kategori']; 
$judul = $_POST['judul']; 
$pengarang = $_POST['pengarang']; 
$id_penerbit = $_POST['penerbit']; 
$tahun_terbit = $_POST['tahun']; 
$sinopsis = $_POST['sinopsis']; 
$lokasi_file = $_FILES['cover']['tmp_name'];

    //get cover  
    $sql_c = "SELECT `cover` FROM `buku` WHERE `id_buku`='$id_buku'"; 
    $query_c = mysqli_query($koneksi,$sql_c); 
    while($data_c = mysqli_fetch_row($query_c)){ 
        $cover = $data_c[0]; 
        //echo $cover; 
    }

if(empty($id_buku)||empty($id_kategori_buku)||empty($judul)||empty($pengarang)||empty($id_penerbit)||empty($tahun_terbit)||empty($sinopsis)){ 
	header("Location:editbuku.php?notif=tambahkosong");
}else {
	//update semua input user kecuali cover dan tag
	$sql = "UPDATE `buku` SET `id_kategori_buku`='$id_kategori_buku', `judul`='$judul', `pengarang`='$pengarang', `id_penerbit`='$id_penerbit', `tahun_terbit`='$tahun_terbit', `sinopsis`='$sinopsis' WHERE `id_buku`='$id_buku'";
    mysqli_query($koneksi,$sql);

    //update cover
	$lokasi_file = $_FILES['cover']['tmp_name']; 
    $nama_file = $_FILES['cover']['name']; 
    $direktori = 'cover/'.$nama_file; 
    if(move_uploaded_file($lokasi_file,$direktori)){ 
      if(!empty($cover)){unlink("cover/$cover");} 
      $sql_uc = "UPDATE `buku` SET `cover`='$nama_file' WHERE `id_buku`='$id_buku'"; 
      mysqli_query($koneksi,$sql_uc); 
    }

    //delete tag
    $sql_del = "DELETE FROM `tag_buku` WHERE `tag_buku`.`id_buku` = '$id_buku'";
    mysqli_query($koneksi,$sql_del); 

    //get query tag
    $sql_tag = "select `id_tag`, `tag` from `tag` order by `tag`";
    $query_tag = mysqli_query($koneksi,$sql_tag); 

    //looping ruwet yang butuh 40 kali percobaan untuk menemukan syntax dan logic yang pas
    if(!empty($_POST['tag'])){
		$tagg = $_POST['tag'];
		//looping semua tag
		while($data_tag = mysqli_fetch_row($query_tag)){ 
			$id_tag = $data_tag[0];
	        $tag = $data_tag[1];
	        //looping tag inputan user
	        for ($i=0; $i<count($tagg); $i++){
	        	if ($tagg[$i]==$id_tag) {
	        		echo $id_buku." ".$tagg[$i]." = ".$id_tag."</br>";
	        		$sql_intag = "INSERT INTO `tag_buku` (`id_buku`, `id_tag`) VALUES ('$id_buku', '$tagg[$i]')";
        			mysqli_query($koneksi,$sql_intag);
	        	}
			}
	    }    
	}

    unset($_SESSION['id_buku']); 
    header("Location:buku.php?notif=editberhasil"); 
}

 ?>