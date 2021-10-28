<?php  
include('../koneksi/koneksi.php'); 
$id_kategori_buku = $_POST['kategori']; 
$judul = $_POST['judul']; 
$pengarang = $_POST['pengarang']; 
$id_penerbit = $_POST['penerbit']; 
$tahun_terbit = $_POST['tahun']; 
$sinopsis = $_POST['sinopsis']; 
$lokasi_file = $_FILES['cover']['tmp_name'];
if(empty($id_kategori_buku)||empty($judul)||empty($pengarang)||empty($id_penerbit)||empty($tahun_terbit)||empty($sinopsis)||empty($lokasi_file)){ 
 	header("Location:tambahbuku.php?notif=tambahkosong");
}
else{ 
	$lokasi_file = $_FILES['cover']['tmp_name']; 
    $nama_file = $_FILES['cover']['name']; 
    $direktori = 'cover/'.$nama_file;
	if(move_uploaded_file($lokasi_file,$direktori)){
		//insert data buku kecuali tag
		$sql = "INSERT INTO `buku` (`id_kategori_buku`, `judul`, `pengarang`, `id_penerbit`, `tahun_terbit`, `sinopsis`, `cover`)
		VALUES ('$id_kategori_buku', '$judul', '$pengarang', '$id_penerbit', '$tahun_terbit', '$sinopsis', '$nama_file')";
		mysqli_query($koneksi,$sql);
		// $result = mysqli_query($koneksi,$sql);
		// var_dump($result);
	}
	//get id buku
	$sql_id = "SELECT `id_buku`, `judul` FROM `buku` WHERE `judul`='$judul'";
	$query_id = mysqli_query($koneksi,$sql_id); 
    while($data_id = mysqli_fetch_row($query_id)){ 
        $id_buku = $data_id[0];
        $judul2 = $data_id[1];
    }
	echo $id_buku."<br>".$judul2."<br>";

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
	header("Location:buku.php?notif=tambahberhasil");	
} 
?> 