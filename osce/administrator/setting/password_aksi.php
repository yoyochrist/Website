<?php
	//mulai proses tambah data
 
	//cek dahulu, jika tombol tambah di klik
	if(isset($_POST['change'])){	
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$old	= $_POST['old'];	//membuat variabel $periodID
		$new	= $_POST['new'];	//membuat variabel $periodID
		$conf	= $_POST['conf'];	//membuat variabel $periodID
	
		$check = "SELECT * FROM userx WHERE `id` = '".$_SESSION['id']."' AND `pswd`= '".md5(md5($old))."'";
		$flag = mysqli_query($link, $check);
		if(mysqli_num_rows($flag) > 0)
		{
			if($conf == $new)
			{
				$sql = "UPDATE userx SET pswd='".md5(md5($new))."' WHERE `id` = '".$_SESSION['id']."' AND `pswd`= '".md5(md5($old))."'";
				//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
				$input = mysqli_query($link, $sql) or die(mysql_error());
		
				//jika query input sukses
				if($input)
				{	
					echo 'Password berhasil diganti! ';					//Pesan jika proses tambah sukses
					echo '<a class="btn btn-primary" href="index.php?mod=passwd">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
				}
				else
				{		
					echo 'Password gagal diganti! ';					//Pesan jika proses tambah gagal
					echo '<a class="btn btn-primary" href="index.php?mod=passwd">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
				}
			}
			else
			{
				echo 'Password baru tidak terkonfirmasi! ';					//Pesan jika proses tambah gagal
				echo '<a class="btn btn-primary" href="index.php?mod=passwd">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
			}
		}
		else
		{
			echo 'Password lama salah! ';					//Pesan jika proses tambah gagal
			echo '<a class="btn btn-primary" href="index.php?mod=passwd">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
		}
	}
	else
	{
		//jika tidak terdeteksi tombol tambah di klik
 		//redirect atau dikembalikan ke halaman tambah
		echo '<script>window.history.back()</script>';
	}
?>
