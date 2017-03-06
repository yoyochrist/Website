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
		<title>Penjaminan Mutu - Search</title>
		<link rel="stylesheet" href="<?php echo base_url().'/assets/css/bootstrap.min.css';?>">
		<script src="<?php echo base_url().'/assets/js/bootstrap.min.js';?>"></script>
		
		<link rel="stylesheet" href="<?php base_url().'/assets/css/jqueryui.css';?>">
		<script src="<?php echo base_url().'/assets/js/jqueryui.min.js';?>"></script>
		<script src="<?php echo base_url().'/assets/js/jquery-2.2.1.min.js';?>"></script>
	</head>
	<body>
		<div class="container panel panel-default"  style="margin-top:5%">
			<?php $this->load->view('template/header'); ?>
			<div id="main" class="col-md-12">
				<?php $this->load->view('template/navbar');?>
				<div class="col-md-10 panel panel-default">
					<div class="row">
						<form method="post" action="<?php echo site_url().'/document/complete_search';?>">
							<div class="form-group col-md-6">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Document Level</span>
									<select class="form-control" id="doc_level" name="doc_level">
										<option value="%">ALL</option>
										<?php foreach($doclevel as $each)
											{
										?>
												<option value="<?php echo $each->typedoc_id; ?>"><?php echo $each->typedoc_id." (".$each->typedoc_name.")"; ?></option>
										<?php
											}
										?>
									</select>
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Document Type</span>
									<select class="form-control" id="doc_type" name="doc_type">
										<option value="%">ALL</option>
										<?php foreach($doctype as $each)
											{
										?>
												<option value="<?php echo $each->doctype_id; ?>"><?php echo $each->doctype_id." (".$each->doctype_name.")"; ?></option>
										<?php
											}
										?>
									</select>
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Document Number</span>
									<input type="text" class="form-control" name="doc_no" id="doc_no" placeholder="Document Number"/>
								</div>
							</div>
							<button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span></button>
						<form>
					</div>
				</div>
			</div>
			<?php $this->load->view('template/footer'); ?>
		</div>
	</body>
</html>