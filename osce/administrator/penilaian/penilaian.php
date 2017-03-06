<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = 'SELECT  DISTINCT grade.student_id AS "studentID", grade.lecturer_id AS "lecturerID", grade.station_id  AS "stationID", grade.global_scale  AS "globalScale", grade.date_exam  AS "dateExam", subject.name AS "subjectName", grade.session_id AS "sessionID" FROM grade JOIN grade_detail ON grade.id = grade_detail.grade_id JOIN subject ON grade.subject_id = subject.id';
?>
<div class="row">
	<a class="btn btn-primary" href="index.php?mod=gen">Generate Peserta</a>
	<a class="btn btn-primary" href="index.php?mod=wei">Beri Bobot Soal</a>
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
					<i>Global Scale</i>
				</th>
				<th>
					Jadwal Ujian
				</th>
				<th>
					Nama Subjek
				</th>
				<th>
					Kode <i>Session</i>
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
							echo "<td>".$row['globalScale']."</td>";
							echo "<td>".$row['dateExam']."</td>";
							echo "<td>".$row['subjectName']."</td>";
							echo "<td>".$row['sessionID']."</td>";
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
