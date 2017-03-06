<html>
	<?php
		if (isset($this->session->userdata['logged_in'])) 
		{
			$username = ($this->session->userdata['logged_in']['username']);
		} 
		else
		{
			redirect(base_url());
		}
	?>
	<head>
		<title>Penjaminan Mutu - Input</title>
		<link rel="stylesheet" href="<?php echo base_url().'/assets/css/bootstrap.min.css';?>">
		<script src="<?php echo base_url().'/assets/js/bootstrap.min.js';?>"></script>
		<script src="<?php echo base_url().'/assets/js/jquery-2.2.1.min.js';?>"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#hideForm').hide();

				$('#doc_filename').bind('change',function(){
					var file = this.files[0].name;
					var substrfile = file.substr(0,file.lastIndexOf('.'));
					var doc_code = substrfile.split('-');

					var doc_level = document.getElementById('doc_level');
					var doc_type= document.getElementById('doc_type');

    					var doc_level_opts = doc_level.options;
					var doc_type_opts = doc_type.options;

					var foundLevel = 0;
					for(var opt, j = 0; opt = doc_level_opts[j]; j++) {
        					if(opt.value == doc_code[0]) {
            						doc_level.selectedIndex = j;
							foundLevel++;
            						break;
       						 }
   					 }

					var foundType= 0;
					for(var opt, j = 0; opt = doc_type_opts[j]; j++) {
        					if(opt.value == doc_code[1]) {
            						doc_type.selectedIndex = j;
							foundType++;
            						break;
       						 }
   					 }
					this.form.elements["doc_no"].value = doc_code[2];
					
					if(foundLevel == 0 || foundType == 0 || isNaN(doc_code[2]))
					{
						$('#hideForm').hide();
						alert("Your document name is invalid");
					}
					else
					{
						$('#hideForm').show("high");
					}
				});
			});
		</script>
	</head>
	<body>
		<div class="container panel panel-default" style="margin-top:5%; background-color: green;">
			<?php $this->load->view('template/header'); ?>
			<div id="main" class="col-md-12">
				<?php $this->load->view('template/navbar');?>
				<div class="col-md-8 panel panel-default">
					<h2>Input New Document</h2>
					<hr/>

					<?php
						if (!is_null($error_message)) {
							echo "<div class='alert alert-danger'>";
							echo $error_message;
							echo validation_errors();
							echo "</div>";
						}
					?>
					<form method="post" action="<?php echo site_url().'/DOCUMENT/create';?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="doc_filename">Document Filename</label>
						<input type="file" class="form-control" name="doc_filename" id="doc_filename" required/>
					</div>
					<div id ="hideForm">
						<div class="form-group">
							<label for="doc_level">Document Level</label>
							<select class="form-control" id="doc_level" name="doc_level" disabled>
								<?php foreach($doclevel as $each){ ?>
									<option value="<?php echo $each->leveldoc_id; ?>"><?php echo $each->leveldoc_id." (".$each->leveldoc_name.")"; ?></option>';
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="doc_type">Document Type</label>
							<select class="form-control" id="doc_type" name="doc_type" disabled>
								<?php foreach($doctype as $each){ ?>
									<option value="<?php echo $each->typedoc_id; ?>"><?php echo $each->typedoc_id." (".$each->typedoc_name.")"; ?></option>';
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="doc_no">Document Number</label>
							<input type="number" class="form-control" step="any" name="doc_no" id="doc_no" placeholder="Document Number" disabled required/>
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