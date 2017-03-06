<?php
	include("html_head.php");

	if (isset($_GET['title']))
	{
		$title = $_GET['title'];
		$judul = str_replace("-", " ", $title);
		print_header(ucwords($judul));
	}
	else
	{
		print_header("Akademik SkilLab - Fakultas Kedokteran UKRIDA");
	}
?>
<body style="margin-left:20px;">
	<div id="wrapper">
        <div id="wrapper_header">
            <div id="banner_adm"><?php include ("content/banner.php");?></div>
        </div>
        <div id="wrapper_main_adm" class="clear">
	<script src="akademik.js"></script>

	<!-- Button trigger modal -->
	<a href="index.php?mod=acadcsv" class="btn btn-primary" role="button" id="csv">
		Tambah Mahasiswa CSV
	</a>
	<a href="index.php?mod=acadman" class="btn btn-primary" role="button" id="manual">
		Tambah Mahasiswa Manual
	</a>

	<div id="txtData">
		<div class="col-md-12">
			<div class="col-md-4">
				<h3>Data Sesi Aktif Terakhir</h3>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-1">
				<b>Nama Periode</b>
			</div>
			<div class="col-md-1">
				<b>Nama Session</b>
			</div>
			<div class="col-md-3">
				<b>Tanggal</b>
			</div>
			<div class="col-md-1">
				<b>Lokasi</b>
			</div>
			<div class="col-md-1">
				<b>Station per Lokasi</b>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<br/><br/>
		<div class="col-md-12">
			<p style="color:red">
				<b>Keterangan:</b>
				<ul>
					<li>Upload CSV untuk data mahasiswa per sesi</li>
					<li>Upload manual untuk data mahasiswa susulan</li>
				</ul>
			</p>
		</div>
	</div>

	<div class="col-md-12 template">
		<div class="col-md-1 periodname">
		</div>
		<div class="col-md-1 sessionname">
		</div>
		<div class="col-md-3 date">
		</div>
		<div class="col-md-1 location">
		</div>
		<div class="col-md-1 station">
		</div>
	</div>     
</div>   
	<div id="wrapper_footer" class="clear"><?php include('../content/footer.php'); ?></div>
    </div>
</body>
</html>

<?php //} else header("location:http://192.168.14.229/id_server/checkid.php"); ?>