<?php 

include("html_head.php");

if (isset($_GET['title'])){
	$title = $_GET['title'];
	$judul = str_replace("-", " ", $title);
	print_header(ucwords($judul));}
else{
	print_header("OSCE - Fakultas Kedokteran UKRIDA");
}



if(!isset($_SESSION)) { 
	session_start(); 
} 


//print_r($_SESSION);


?>

<body>

<?php

if(isset($_SESSION['rfid'])) {
	$_SESSION['id'] = $_SESSION['rfid'];
	$_SESSION['name'] = $_SESSION['full_name']; 
}

if (!isset($_SESSION['id'])) {
?>

	
	<div id="login">
		<div id="login-top">
			<img src="img/ukrida.png"  />
			<h4><strong>Aplikasi Objective-Structured Clinical Examination (OSCE)</strong></h4>
		</div>
		
		<div id="login-bottom">
			<p class="login-text">Silahkan login dengan menggunakan UserID dan Password<br />lewat menu login di bawah.</p>
			<div class="login-panel">
				<div class="panel-heading">
					<h4 class="panel-title"><strong>SIGN IN</strong></h4>
				</div>
				<div class="panel-body">
				<form id="form1" name="form1" method="post" action="content/main.php">
				  <fieldset>
					<div class="form-group">
						<input name="id" type="text" size="25" class="form-control" placeholder="User ID"></input>
						
					</div>
					<div class="form-group">
						<input name="pswd" type="password" size="25" class="form-control" placeholder="Password"></input>
					</div>
					<div class="buttons">
						<input type="submit" name="Submit" class="btn btn-primary" value="Log in" />
					</div>
				</fieldset>
			</form>
				
				</div>
			</div>
		
		</div>
	
	</div>

<?php

}
else {
?>	
    <div id="wrapper">
        <div id="wrapper_header" class="box-shadow">
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

                        case 'che'	: $isi='checkin.php';
                                      break;

                        default 	: $isi='checkin.php';
                        }					
                }
            else
                $isi='checkin.php';
            ?>
                    
            <?php include($isi);?>
        </div>
        
    
    </div>	
    <div id="wrapper_footer" class="clear"><?php include('content/footer.php'); ?></div>
	
<?php	
}
?>
</body>
</html>