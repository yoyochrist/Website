<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM session";
?>
<h1>Sesi</h1>
<div class="row">
	<a class="btn btn-primary" href="index.php?mod=sesin">Tambah</a>
</div>
<div class="row"><br/></div>
<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					Kode Sesi
				</th>
				<th>
					Kode Periode
				</th>
				<th>
					Nama Sesi
				</th>
				<th>
					Sesi Ujian Dimulai
				</th>
				<th>
					Sesi Ujian Berakhir
				</th>
				<th>
					Aktif
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
							echo '<td>'.$row['id'].'</td>';
							echo "<td>".$row['period_id']."</td>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['time_start']."</td>";
							echo "<td>".$row['time_end']."</td>";
							if($row['active'] == 1)
							{
								echo "<td>Aktif</td>";
							}
							else
							{
								echo "<td>Non Aktif</td>";
							}
		?>
							<td>
								<a class="btn btn-primary btn-sm" href="index.php?mod=sesdet&id=<?php echo $row['id'];?>">Tambah Mahasiswa</a>
								<a class="btn btn-primary btn-sm" href="index.php?mod=sesup&id=<?php echo $row['id'];?>">Ubah</a>
								<a class="btn btn-primary btn-sm" href="index.php?mod=sesdel&id=<?php echo $row['id'];?>">Hapus</a>
							</td>
		<?php
						echo "</tr>";
					}
				}
			}
		?>
	</table>
</div>
