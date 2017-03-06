<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM period";
?>
<h1>Periode</h1>
<div class="row">
	<a class="btn btn-primary" href="index.php?mod=perin">Tambah</a>
</div>
<div class="row"><br/></div>
<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					Kode Periode
				</th>
				<th>
					Periode Ujian Dimulai
				</th>
				<th>
					Periode Ujian Berakhir
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
							echo "<td>".$row['date_start']."</td>";
							echo "<td>".$row['date_end']."</td>";
		?>
							<td>
								<a class="btn btn-primary btn-sm" href="index.php?mod=perup&id=<?php echo $row['id'];?>">Ubah</a>
								<a class="btn btn-primary btn-sm" href="index.php?mod=perdel&id=<?php echo $row['id'];?>">Hapus</a>
							</td>
		<?php
						echo "</tr>";
					}
				}
			}
		?>
	</table>
</div>
