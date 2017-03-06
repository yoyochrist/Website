<?php
	//mulai proses tambah data
 
	//cek dahulu, jika tombol tambah di klik
	if(isset($_POST['tambah'])){
	
		//inlcude atau memasukkan file koneksi ke database
		$link = mysqli_connect("localhost", "root", "", "osce");
	
		//jika tombol tambah benar di klik maka lanjut prosesnya
		$studentID	= $_POST['studentID'];	//membuat variabel $date_start
		$sessionID	= $_POST['sessionID'];
		$room		= $_POST['room'];	//membuat variabel $date_end
		$exam_type	= $_POST['exam_type'];
		$checkSession	= "SELECT * FROM session WHERE id = '$sessionID'";

		$flagSession = mysqli_query($link, $checkSession);
	
		if(mysqli_num_rows($flagSession) > 0)
		{
			$sql = "INSERT INTO participant(`student_id`, `session_id`, `room`, `exam_type`,`editlog`, `userlog`) VALUES('$studentID', '$sessionID', '$room', '$exam_type', NOW(), '".$_SESSION['id']."')";
			//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
			$input = mysqli_query($link, $sql) or die(mysql_error());

				if($exam_type == 'SL')
				{
					$sqlcount = 'SELECT CASE WHEN COUNT(`id`) = 0 THEN 0 WHEN COUNT(`id`) != 0 THEN MAX(`id`) END FROM `grade`';
					$count = mysqli_query($link, $sqlcount);
					$rowcount = mysqli_fetch_row($count);
					$counter = $rowcount[0]+1;

					$sqlroom = "SELECT `id` FROM station WHERE `name` = 'Station $room'";
					$resultroom = mysqli_query($link, $sqlroom);
					$rowroom = mysqli_fetch_row($resultroom);

					$sqlinsertheader = "INSERT into grade(`grade_id`, `session_id`,`student_id`,`station_id`,`editlog`) VALUES('$counter','$sessionID', '$studentID', '$rowroom[0]', NOW())";
					mysqli_query($link,$sqlinsertheader);
				}
				else
				{
					$sqlroom = "SELECT `id` FROM station WHERE `name` LIKE '%".$room."'";
					$resultroom = mysqli_query($link, $sqlroom);
					
					while($rowroom = mysqli_fetch_assoc($resultroom))
					{
						$sqlcount = 'SELECT CASE WHEN COUNT(`grade_id`) = 0 THEN 0 WHEN COUNT(`grade_id`) != 0 THEN MAX(`grade_id`) END FROM `grade`';
						$count = mysqli_query($link, $sqlcount);
						$rowcount = mysqli_fetch_row($count);
						$counter = $rowcount[0]+1;

						$sqlinsertheader = "INSERT into grade(`grade_id`, `session_id`,`student_id`,`station_id`,`editlog`) VALUES('$counter','$sessionID', '$studentID', '".$rowroom['id']."', NOW())";
						mysqli_query($link,$sqlinsertheader);
					}
				}
		
			//jika query input sukses
			if($input)
			{	
				echo 'Data berhasil ditambahkan! ';		//Pesan jika proses tambah sukses
				echo '<a class="btn btn-primary" href="index.php?mod=mhs">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah
			}
			else
			{		
				echo 'Gagal menambahkan data! ';		//Pesan jika proses tambah gagal
				echo '<a class="btn btn-primary" href="index.php?mod=mhs">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
			}
		}
		else
		{
			echo mysqli_num_rows($flagSession).' '.$sessionID;
			echo 'Pilih sesi yang aktif! ';		//Pesan jika proses tambah gagal
			echo '<a class="btn btn-primary" href="index.php?mod=mhs">Kembali</a>';	//membuat Link untuk kembali ke halaman tambah	
		}
	}
	else
	{
		//jika tidak terdeteksi tombol tambah di klik
 		//redirect atau dikembalikan ke halaman tambah
		echo '<script>window.history.back()</script>';
	}
?>
