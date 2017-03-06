<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM subject";
?>
<h1>Subjek</h1>
<div class="row">
	<a class="btn btn-primary" href="index.php?mod=subin">Tambah</a>
</div>
<div class="row"><br/></div>
<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					Kode Subyek
				</th>
				<th>
					Nama Subyek
				</th>
				<th>
					Deskripsi
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
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['desc']."</td>";
		?>
							<td>
								<a class="btn btn-primary btn-sm" href="index.php?mod=subup&id=<?php echo $row['id'];?>">Ubah</a>
								<a class="btn btn-primary btn-sm" href="index.php?mod=subdel&id=<?php echo $row['id'];?>">Hapus</a>
							</td>
		<?php
						echo "</tr>";
					}
				}
			}
		?>
	</table>
</div>
