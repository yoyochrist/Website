<html>
	<?php
		if (isset($this->session->userdata['logged_in'])) 
		{
			$username = ($this->session->userdata['logged_in']['username']);
		} 
		else
		{
			header("location: http://192.168.32.152:88");
		}
	?>
	<head>
		<title>Penjaminan Mutu - Input</title>
		<link rel="stylesheet" href="<?php echo base_url().'/assets/css/bootstrap.min.css';?>">
		<script src="<?php echo base_url().'/assets/js/bootstrap.min.js';?>"></script>
	</head>
	<body>
		<div class="container panel panel-default">
			<?php $this->load->view('template/header'); ?>
			<div id="main" class="col-md-12">
				<?php $this->load->view('template/navbar');?>
				<div class="col-md-8 panel panel-default">
					<h2>Input New Document</h2>
					<hr/>
					<form method="post" action="<?php echo site_url().'/document/create';?>" enctype="multipart/form-data">
					<?php
						echo "<div class='alert alert-danger'>";
						if (isset($error_message)) {
							echo $error_message;
						}
						echo validation_errors();
						echo "</div>";
					?>
					<div class="form-group">
						<label for="doc_level">Document Level</label>
						<select class="form-control" id="doc_level" name="doc_level">
							<?php foreach($doclevel as $each){ ?>
								<option value="<?php echo $each->typedoc_id; ?>"><?php echo $each->typedoc_id." (".$each->typedoc_name.")"; ?></option>';
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="doc_type">Document Type</label>
						<select class="form-control" id="doc_type" name="doc_type">
							<?php foreach($doctype as $each){ ?>
								<option value="<?php echo $each->doctype_id; ?>"><?php echo $each->doctype_id." (".$each->doctype_name.")"; ?></option>';
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="doc_no">Document Number</label>
						<input type="number" class="form-control" step="any" name="doc_no" id="doc_no" placeholder="Document Number" required/>
					</div>
					<div class="form-group">
						<label for="doc_rev_no">Document Revision</label>
						<input type="number" class="form-control" step="any" name="doc_rev_no" id="doc_rev_no" placeholder="Document Revision" required/>
					</div>
					<div class="form-group">
						<label for="doc_title">Document Title</label>
						<input type="text" class="form-control" name="doc_title" id="doc_title" placeholder="Document Title" required/>
					</div>
					<div class="form-group">
						<label for="doc_author">Document Author</label>
						<input type="text" class="form-control" name="doc_author" id="doc_author" placeholder="Document Author" required/>
					</div>
					<div class="form-group">
						<label for="doc_date_created">Document Date Created</label>
						<?php
						  $timezone = "Asia/Jakarta";
						  date_default_timezone_set($timezone);
						  $today = date("Y-m-d");
						?>
						<input type="date" class="form-control" name="doc_date_created" id="doc_date_created" placeholder="Document Date Created" value = <?php echo $today;?> required/>
					</div>
					<div class="form-group">
						<label for="doc_date_created">Document Date Valid</label>
						<?php
						  $timezone = "Asia/Jakarta";
						  date_default_timezone_set($timezone);
						  $today = date("Y-m-d");
						?>
						<input type="date" class="form-control" name="doc_date_valid" id="doc_date_valid" placeholder="Document Date Valid" value = <?php echo $today;?> required/>
					</div>
					<div class="form-group">
						<label for="doc_filename">Document Filename</label>
						<input type="file" class="form-control" name="doc_filename" id="doc_filename" required/>
					</div>
					<div class="button-group">
						<button type="submit" class="btn btn-primary">Submit</button>
						<?php echo form_close(); ?>
						<a href="<?php echo site_url();?>" class="btn btn-primary" role="button">Cancel</a>
					</div>
					<?php
						if (isset($message_display)) 
						{
							echo "<div class='alert alert-success'>";
							echo $message_display;
							echo "</div>";
						}
					?>
				</div>
				<script>
					$(document).ready(function(){
						$('[data-toggle="tooltip"]').tooltip();   
					});
				</script>
			</div>
			<?php $this->load->view('template/footer'); ?>
		</div>
	</body>
</html>