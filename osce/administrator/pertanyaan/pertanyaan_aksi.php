<?php
	//mulai proses tambah data
 
	//cek dahulu, jika tombol tambah di klik
	if(isset($_POST['tambah'])){
	
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$name	= $_POST['item'];	//membuat variabel $uitem
	
		$sql = "INSERT INTO question(`item`,`editlog`,`userlog`) VALUES('$name', NOW(), NOW())";
		//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
		$input = mysqli_query($link, $sql) or die(mysql_error());
	
		//jika query input sukses
		if($input)
		{	
			echo 'Data berhasil di tambahkan! ';					//Pesan jika proses tambah sukses
			echo '<a class="btn btn-primary" href="index.php?mod=que">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
		}
		else
		{		
			echo 'Gagal menambahkan data! ';					//Pesan jika proses tambah gagal
			echo '<a class="btn btn-primary" href="index.php?mod=que">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
		}
	}
	else
	{
		//jika tidak terdeteksi tombol tambah di klik
 		//redirect atau dikembalikan ke halaman tambah
		echo '<script>window.history.back()</script>';
	}
?>
