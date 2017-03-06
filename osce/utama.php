<body>

<div id="wrapper">
	<div id="wrapper_header">
		<div id="banner"><?php include ("content/banner.php");?></div>
    </div>
	
    <!--bagian utama--> 
    <div id="wrapper_main" class="clear">
		

		<?php
		if (isset($_GET['mod'])){
			$mod = $_GET['mod'];
				switch($mod) {
					
					case 'reg'	: $isi='registrasi.php';
								  break;
					
					case 'nla'	: $isi='penilaian.php';
								  break;
								  
					case 'rev'	: $isi='review.php';
								  break;
							
					default 	: $isi='registrasi.php';
					}					
			}
		else
			$isi='registrasi.php';
		?>
				
		<?php include($isi);?>
	</div>
    

</div>	
<div id="wrapper_footer" class="clear"><?php include('content/footer.php'); ?></div>
    
</body>
