<?php
	//mulai proses tambah data
 
	//cek dahulu, jika tombol tambah di klik
	if(isset($_POST['ubah'])){
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$name	= $_POST['nama'];	//membuat variabel $name
		$desc	= $_POST['desc'];	//membuat variabel $desc
		$id = $_POST['id'];
	
		$sql = "UPDATE `subject` SET `name` = '$name', `desc` = '$desc', `editlog` = NOW(), `userlog` = NOW() WHERE `id` = '$id'";
		//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
		$input = mysqli_query($link, $sql) or die(mysql_error());
	
		//jika query input sukses
		if($input)
		{	
			echo 'Data berhasil diubah! ';					//Pesan jika proses tambah sukses
			echo '<a class="btn btn-primary" href="index.php?mod=sub">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
		}
		else
		{		
			echo 'Gagal mengubah data! ';					//Pesan jika proses tambah gagal
			echo '<a class="btn btn-primary" href="index.php?mod=sub">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
		}
	}
	else
	{
		//jika tidak terdeteksi tombol tambah di klik
 		//redirect atau dikembalikan ke halaman tambah
		echo '<script>window.history.back()</script>';
	}
?>
