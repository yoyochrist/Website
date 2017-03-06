<?php
	//mulai proses tambah data
 
	//cek dahulu, jika tombol tambah di klik
	if(isset($_POST['tambah'])){
	
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$periodID	= $_POST['periodID'];	//membuat variabel $periodID
		$name		= $_POST['nama'];	//membuat variabel $name
		$date_start	= $_POST['date_start'];	//membuat variabel $time_start
		$date_end	= $_POST['date_end'];	//membuat variabel $time_end
		$active		= $_POST['active'];	//membuat variabel $time_end
	
		$sql = "INSERT INTO session(`period_id`,`name`,`time_start`, `time_end`, `active`) VALUES('$periodID','$name','$date_start', '$date_end', '$active')";
		//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
		$input = mysqli_query($link, $sql) or die(mysql_error());
	
		//jika query input sukses
		if($input)
		{	
			echo 'Data berhasil di tambahkan! ';					//Pesan jika proses tambah sukses
			echo '<a class="btn btn-primary" href="index.php?mod=ses">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
		}
		else
		{		
			echo 'Gagal menambahkan data! ';					//Pesan jika proses tambah gagal
			echo '<a class="btn btn-primary" href="index.php?mod=ses">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
		}
	}
	else
	{
		//jika tidak terdeteksi tombol tambah di klik
 		//redirect atau dikembalikan ke halaman tambah
		echo '<script>window.history.back()</script>';
	}
?>
