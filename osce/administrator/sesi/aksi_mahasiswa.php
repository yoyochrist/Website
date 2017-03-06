<?php
	//mulai proses tambah data
 
	//cek dahulu, jika tombol tambah di klik
	if(isset($_POST['tambah'])){
	
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$sessionID	= $_POST['id'];	//membuat variabel $date_start
		$studentID	= $_POST['studentID'];	//membuat variabel $date_end
		$checkSession	= "SELECT * FROM session WHERE id = '$sessionID'";
		$checkEntry	= "SELECT * FROM participant WHERE `student_id` = '".$studentID."' AND `session_id` = '".$sessionID."'";
		$flagSession = mysqli_query($link, $checkSession);
		$flagEntry = mysqli_query($link,$checkEntry);
		if(mysqli_num_rows($flagEntry)==0)
		{
			if(mysqli_num_rows($flagSession) > 0)
			{
				$sql = "INSERT INTO participant(`student_id`, `session_id`, `editlog`, `userlog`) VALUES('$studentID', '$sessionID', NOW(), '".$_SESSION['id']."')";
				//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
				$input = mysqli_query($link, $sql) or die(mysql_error());
		
				//jika query input sukses
				if($input)
				{	
					echo 'Data berhasil di tambahkan! ';		//Pesan jika proses tambah sukses
					echo '<a class="btn btn-primary" href="index.php?mod=sesdet&id='.$sessionID.'">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
				}
				else
				{		
					echo 'Gagal menambahkan data! ';		//Pesan jika proses tambah gagal
					echo '<a class="btn btn-primary" href="index.php?mod=sesdet&id='.$sessionID.'">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
				}
			}
			else
			{
				echo mysqli_num_rows($flagSession).' '.$sessionID;
				echo 'Pilih sesi yang aktif! ';		//Pesan jika proses tambah gagal
				echo '<a class="btn btn-primary" href="index.php?mod=sesdet&id='.$sessionID.'">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
			}
		}
		else
		{
			echo 'Partisipan pernah diinput! ';		//Pesan jika proses tambah gagal
			echo '<a class="btn btn-primary" href="index.php?mod=sesdet&id='.$sessionID.'">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
		}
	}
	else
	{
		//jika tidak terdeteksi tombol tambah di klik
 		//redirect atau dikembalikan ke halaman tambah
		echo '<script>window.history.back()</script>';
	}
?>
