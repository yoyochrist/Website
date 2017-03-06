<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT  DISTINCT grade.student_id AS `studentID`, grade.lecturer_id AS `lecturerID`, grade.station_id  AS `stationID`, grade.global_scale  AS `globalScale`, subject.name AS `subjectName`, grade.session_id AS `sessionID`, grade.question AS `kompetensi`, session.`time_start`, session.`time_end` FROM grade JOIN grade_detail ON grade.id = grade_detail.grade_id JOIN subject ON grade.subject_id = subject.id JOIN session ON grade.session_id = session.id JOIN participant ON grade.student_id = participant.student_id WHERE participant.exam_type = 'SR' and session.`active` = '1'";
?>
<h1>Jadwal Ujian Peserta Semester</h1>
<div class="row">
	<a class="btn btn-primary" href="index.php?mod=komcsv">Unggah Kompetensi</a>
	<a class="btn btn-primary" href="index.php?mod=sruplec">Ganti Penguji</a>
</div>
<div class="row"><br/></div>
<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					NIM
				</th>
				<th>
					NID
				</th>
				<th>
					Kode <i>Station</i>
				</th>
				<th>
					Jadwal Ujian
				</th>
				<th>
					Nama Subjek
				</th>
				<th>
					Kode Sesi
				</th>
				<th>
					Kode Kompetensi
				</th>
				<th>
					<i>Global Scale</i>
				</th>
				<th>
		                        Aksi
		                </th>
			</tr>
		</thead>
		<?php
			if($result = mysqli_query($link, $sql))
			{
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
							echo "<td>".$row['studentID']."</td>";
							echo "<td>".$row['lecturerID']."</td>";
							echo "<td>".$row['stationID']."</td>";
							echo "<td>".$row['time_start']." s/d ".$row['time_end']."</td>";
							echo "<td>".$row['subjectName']."</td>";
							echo "<td>".$row['sessionID']."</td>";
							echo "<td>".$row['kompetensi']."</td>";
							echo "<td>".$row['globalScale']."</td>";
		?>
							<td>
								<a class="btn btn-primary btn-sm" href="#">Ubah</a>
								<a class="btn btn-primary btn-sm" href="#">Hapus</a>
							</td>
		<?php
						echo "</tr>";
					}
				}
			}
		?>
	</table>
</div>
