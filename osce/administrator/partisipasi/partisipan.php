<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM participant JOIN session ON participant.session_id = session.id WHERE session.active = 1";
?>
<h1>Peserta Ujian</h1>
<div class="row">
	<a class="btn btn-primary" href="index.php?mod=mhsin">Tambah</a>
</div>
<div class="row"><br/></div>
<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					Nomor Ujian
				</th>
				<th>
					NIM
				</th>
				<th>
					Kode Sesi
       			        </th>
				<th>
					Tipe Ujian
       			        </th>
				<th>
					Station/Lokasi
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
							echo "<td>".$row['id']."</td>";
							echo "<td>".$row['student_id']."</td>";
							echo "<td>".$row['session_id']."</td>";
							if($row['exam_type']=='SL')
							{
								echo "<td>Skill Lab</td>";
							}
							else
							{
								echo "<td>Semester</td>";
							}
							echo "<td>".$row['room']."</td>";
		?>
							<td>
								<a class="btn btn-primary btn-sm" href="#">Ubah</a>
								<a class="btn btn-primary btn-sm" href="index.php?mod=mhsdel&id=<?php echo $row['id'];?>">Hapus</a>
							</td>
		<?php
						echo "</tr>";
					}
				}
			}
		?>
	</table>
</div>
