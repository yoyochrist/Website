<?php
	//mulai proses tambah data
 
	//cek dahulu, jika tombol tambah di klik
	if(isset($_POST['ubah'])){
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$periodID	= $_POST['periodID'];	//membuat variabel $period
		$name		= $_POST['nama'];	//membuat variabel $name
		$date_start	= $_POST['date_start'];	//membuat variabel $date_start
		$date_end	= $_POST['date_end'];	//membuat variabel $date_end
		$active		= $_POST['active'];	//membuat variabel $active
		$id		= $_POST['id'];		//membuat variabel $id
	
		$sql = "UPDATE `session` SET `period_id`='$periodID', `name`='$name',`time_start` = '$date_start', `time_end` = '$date_end', `active`='$active' WHERE `id` = '$id'";
		//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
		$input = mysqli_query($link, $sql) or die(mysql_error());
	
		//jika query input sukses
		if($input)
		{	
			echo 'Data berhasil diubah! ';					//Pesan jika proses tambah sukses
			echo '<a class="btn btn-primary" href="index.php?mod=ses">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
		}
		else
		{		
			echo 'Gagal mengubah data! ';					//Pesan jika proses tambah gagal
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
