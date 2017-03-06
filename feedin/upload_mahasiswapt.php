<!DOCTYPE html>
	<head>
	</head>
	<body>
		<!--
			Don't forget about enctype="multipart/form-data 
			It's for upload multipart attribute like doc, excel, pdf, csv extensions
		-->
		<form id="upload" action="lib/mahasiswapt_upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="filename"/>
			<input type="submit" name="submit" value="Upload"/>
		</form>
	</body>
</html>