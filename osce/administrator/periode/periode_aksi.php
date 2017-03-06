<?php
	//mulai proses tambah data
 
	//cek dahulu, jika tombol tambah di klik
	if(isset($_POST['tambah'])){
	
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$date_start	= $_POST['date_start'];	//membuat variabel $date_start
		$date_end	= $_POST['date_end'];	//membuat variabel $date_end
	
		$sql = "INSERT INTO period(`date_start`, `date_end`) VALUES('$date_start', '$date_end')";
		//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
		$input = mysqli_query($link, $sql) or die(mysql_error());
	
		//jika query input sukses
		if($input)
		{	
			echo 'Data berhasil di tambahkan! ';		//Pesan jika proses tambah sukses
			echo '<a class="btn btn-primary" href="index.php?mod=per">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
		}
		else
		{		
			echo 'Gagal menambahkan data! ';		//Pesan jika proses tambah gagal
			echo '<a class="btn btn-primary" href="index.php?mod=per">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
		}
	}
	else
	{
		//jika tidak terdeteksi tombol tambah di klik
 		//redirect atau dikembalikan ke halaman tambah
		echo '<script>window.history.back()</script>';
	}
?>
