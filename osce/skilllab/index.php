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
		print_header("Administrator SkilLab - Fakultas Kedokteran UKRIDA");
	}


if(!isset($_SESSION)) { 
	session_start(); 
} 




if(isset($_SESSION['rfid'])) {
	$_SESSION['id'] = $_SESSION['rfid'];
	$_SESSION['name'] = $_SESSION['full_name']; 
}

//if (isset($_SESSION['id'])) {

?>

<!-- menu nav -->
<link rel="stylesheet" href="nav/styles.css">
<!--<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>-->
<script src="nav/script.js"></script>


<body>

	<div id="wrapper">
        <div id="wrapper_header">
            <div id="banner_adm"><?php include ("content/banner.php");?></div>
        </div>
        <div id="wrapper_nav">
			<?php include ("content/nav.php");?>
    	</div>
        
        
        <!--bagian utama--> 
        <div id="wrapper_main_adm" class="clear">
            
		<?php
        if (isset($_GET['mod'])){
        	$mod = $_GET['mod'];
            switch($mod) {
                        
            	case 'set'	: $isi='pengaturan.php';
                			break;
				
				case 'mst'	: $isi='master.php';
                			break;
				
				case 'sper'	: $isi='set_period.php';
                			break;
				
				case 'rses'	: $isi='rpt_session.php';
                			break;
				
				case 'rlec'	: $isi='rpt_lecturer.php';
                			break;
				
				case 'rstu'	: $isi='rpt_student.php';
                			break;

				case 'acad'	: $isi='akademik.php';
                			break;

				case 'acadcsv'	: $isi='csv.html.php';
                			break;

				case 'mon'	: $isi='monitoring.php';
                			break;

				case 'acadman'	: $isi='assign_student.php';
                			break;
                        
				default 	: $isi='set_period.php';
            }					
        }
        else
                $isi='set_period.php';
        
		include($isi);?>
        
		</div>
        <div id="wrapper_footer" class="clear"><?php include('../content/footer.php'); ?></div>
    </div>
</body>
</html>

<?php //} else header("location:http://192.168.14.229/id_server/checkid.php"); ?>
