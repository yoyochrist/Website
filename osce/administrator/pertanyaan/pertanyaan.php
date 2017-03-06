<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM question";
?>
<h1>Kompetensi</h1>
<div class="row">
	<a class="btn btn-primary" href="index.php?mod=quein">Tambah</a>
</div>
<div class="row"><br/></div>
<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					Kode Kompetensi
				</th>
				<th>
					Kompetensi
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
							echo "<td>".$row['item']."</td>";
		?>
							<td>
								<a class="btn btn-primary btn-sm" href="index.php?mod=queup&id=<?php echo $row['id'];?>">Ubah</a>
								<a class="btn btn-primary btn-sm" href="index.php?mod=quedel&id=<?php echo $row['id'];?>">Hapus</a>
							</td>
		<?php
						echo "</tr>";
					}
				}
			}
		?>
	</table>
</div>
