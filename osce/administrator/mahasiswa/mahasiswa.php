<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM student";
?>
<h1>Mahasiswa</h1>
<div class="row">
	<a class="btn btn-primary" href="index.php?mod=mhsin">Tambah</a>
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
					Mahasiswa
				</th>
				<th>
       			                Foto
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
							if($row['photo'])
							{
								echo '<td><img src="../img/mhs/'.$row['photo'].'" heigth="45" width="45"/></td>';
							}							
							else
							{
								echo '<td><img src="../img/mhs/user.png" heigth="45" width="45"/></td>';
							}
		?>
							<td><a class="btn btn-primary btn-sm" href="#">Ubah</a><a class="btn btn-primary btn-sm" href="#">Hapus</a></td>
		<?php
						echo "</tr>";
					}
				}
			}
		?>
	</table>
</div>
