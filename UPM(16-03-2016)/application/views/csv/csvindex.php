	<!DOCTYPE HTML>
<html>
<?php
		if (isset($this->session->userdata['logged_in'])) 
		{
			$username = ($this->session->userdata['logged_in']['username']);
			$role = ($this->session->userdata['logged_in']['idrole']);
			$rolename = $this->LOGIN_DATABASE->read_user_role($role)[0]->rolename;
		} 
		else
		{
			redirect(base_url());
		}
	?>
    <head>
        <meta charset="utf-8">
        <title>Unit Penjaminan Mutu</title>
		<link rel="stylesheet" href="<?php echo base_url().'/assets/css/bootstrap.min.css';?>">
		<script src="<?php echo base_url().'/assets/js/bootstrap.min.js';?>"></script>
		
		<link rel="stylesheet" href="<?php base_url().'/assets/css/jqueryui.css';?>">
		<script src="<?php echo base_url().'/assets/js/jqueryui.min.js';?>"></script>
		<script src="<?php echo base_url().'/assets/js/jquery-2.2.1.min.js';?>"></script>
    </head>
 
    <body> 
        <div class="container panel panel-default" style="margin-top:5%; <?php if($rolename == "admin"){ echo "background-color:green"; }else{echo "background-color:yellow"; }?>">    
			<?php $this->load->view('template/header'); ?>
			<div id="main" class="col-md-12">
				<?php $this->load->view('template/navbar');?>
				<div class="col-md-10 panel panel-default">
					<?php if (isset($error)): ?>
						<div class="alert alert-error"><?php echo $error; ?></div>
					<?php endif; ?>
					<?php if ($this->session->flashdata('success') == TRUE): ?>
						<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
					<?php endif; ?>
		 
					<h2>Upload Data</h2>
						<form method="post" action="<?php echo site_url() ?>/csv/importcsv" enctype="multipart/form-data">
							<input type="file" name="userfile" ><br><br>
							<input type="submit" name="submit" value="Upload" class="btn btn-primary">
						</form>
		 
					<br><br>
					<hr>
				</div>
			</div>
			<?php $this->load->view('template/footer'); ?>
		</div>
    </body>
</html>