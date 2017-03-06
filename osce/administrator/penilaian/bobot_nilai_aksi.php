<?php
	if(isset($_POST['bobot'])){
	
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$session = $_POST['session'];
		$station = $_POST['station'];
		$bobot = $_POST['nilai'];
		$checkGrade = "SELECT `id` FROM grade WHERE `session_id` = '".$session."' AND `station_id` = '".$station."'";

		$flagGrade = mysqli_query($link, $checkGrade);

		while($row = mysqli_fetch_array($flagGrade))
		{
			$grade[] = $row['id'];
		}
		$gradeArray = implode(',',$grade);

		if(mysqli_num_rows($flagGrade) > 0)
		{

			$sql = "UPDATE `grade_detail` SET `question_weight`='".$bobot."' WHERE grade_id IN(".$gradeArray.")";
			//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
			$input = mysqli_query($link, $sql) or die(mysql_error());
		
			//jika query input sukses
			if($input)
			{	
				echo 'Bobot nilai berhasil ditambahkan! ';		//Pesan jika proses tambah sukses
				echo '<a class="btn btn-primary" href="index.php?mod=nla">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
			}
			else
			{		
				echo 'Gagal menambahkan data! ';		//Pesan jika proses tambah gagal
				echo '<a class="btn btn-primary" href="index.php?mod=nla">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
			}
		}
		else
		{
			echo mysqli_num_rows($flagSession).' '.$sessionID;
			echo 'Pilih sesi yang aktif! ';		//Pesan jika proses tambah gagal
			echo '<a class="btn btn-primary" href="index.php?mod=nla">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
		}
	}
	else
	{
		//jika tidak terdeteksi tombol tambah di klik
 		//redirect atau dikembalikan ke halaman tambah
		echo '<script>window.history.back()</script>';
	}
?>
