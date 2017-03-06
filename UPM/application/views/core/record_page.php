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
		<title>Penjaminan Mutu</title>
		<link rel="stylesheet" href="<?php echo base_url().'/assets/css/bootstrap.min.css';?>">
		<script src="<?php echo base_url().'/assets/js/bootstrap.min.js';?>"></script>
		
		<link rel="stylesheet" href="<?php base_url().'/assets/css/jqueryui.css';?>">
		<script src="<?php echo base_url().'/assets/js/jqueryui.min.js';?>"></script>
		<script src="<?php echo base_url().'/assets/js/jquery-2.2.1.min.js';?>"></script>
		
		<script src="<?php echo base_url().'/assets/css/style.css';?>"></script>
		<script type="text/javascript">
		 $(document).ready(function(){
				$('#hideForm').hide();
				 $("#doc_level").bind('change', function (){
             			   var url = "<?php echo site_url('/DOCUMENT/add_ajax_doc_type');?>/"+$(this).val();
             			   $('#doc_type').load(url);
             			   return false;
            			});
				$("#doc_type").bind('change', function (){
             			   var url = "<?php echo site_url('/DOCUMENT/add_ajax_doc_no');?>/"+$(this).val();
             			   $('#doc_no').load(url);
             			   return false;
            			});
				$("#doc_code").autocomplete({    
					minLength:0,
					delay:0,
					source:'<?php echo site_url('/DOCUMENT/autocomplete'); ?>',
					select:function(event, ui){
                				$('#doc_code').val(ui.item.doc_code);
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
				<div class="col-md-10">
					<div class="row col-md-12">
						<div class="col-md-6 panel panel-default">
							<form method="post" action="<?php echo site_url().'/DOCUMENT/search';?>">
								<div class="row">
									<div class="row form-group col-md-12">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Document Level</span>
											<select class="form-control" id="doc_level" name="doc_level">
												<option value="%">ALL</option>
												<?php foreach($doclevel as $each)
													{
												?>
														<option value="<?php echo $each->leveldoc_id; ?>"><?php echo $each->leveldoc_id." (".$each->leveldoc_name.")"; ?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon2">Document Type</span>
											<select class="form-control" id="doc_type" name="doc_type">
												<option value="%">ALL</option>
											</select>
										</div>
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon3">Document Number</span>
											<select class="form-control" id="doc_no" name="doc_no">
												<option value="%">ALL</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row" align="center">
									<button type="submit" class="btn btn-primary">Find</button>
								</div>
							<form>
						</div>
						<div class="col-md-1">
						</div>
						<div class="col-md-5 panel panel-default">
							<form method="post" action="<?php echo site_url().'/DOCUMENT/search';?>">
								<div class="row">
									<div class="row form-group col-md-12">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Document Code</span>
											<input type="text" class="form-control" name="doc_code" id="doc_code" placeholder="Document Code"/>
										</div>
									</div>
								</div>
								<br/><br/><br/>
								<div class="row" align="center">
									<button type="submit" class="btn btn-primary">Find</button>
								</div>
								<br/>
							<form>
						</div>
					</div>
					<div class="row panel panel-default" align="center">
							<div class="button-group">
								<a href="<?php echo site_url().'/DOCUMENT/create';?>" class="btn btn-primary" role="button" data-toggle="tooltip" data-placement="bottom" title="Add Single Data">
									Add Data
								</a>
								<a href="<?php echo site_url().'/CSV';?>" class="btn btn-primary" role="button" data-toggle="tooltip" data-placement="bottom" title="Upload CSV Data">
									Upload List Data
								</a>
								<a href="<?php echo site_url().'/PDF';?>" class="btn btn-primary" role="button" data-toggle="tooltip" data-placement="bottom" title="Upload PDF Data">
									Upload PDF File
								</a>
								<a href="<?php echo site_url().'/DOCUMENT/check_lost_document';?>" class="btn btn-primary" role="button" data-toggle="tooltip" data-placement="bottom" title="Check Lost Document">
									Check Lost Document
								</a>
								<a href="<?php echo site_url().'/DOCUMENT/check_lost_record';?>" class="btn btn-primary" role="button" data-toggle="tooltip" data-placement="bottom" title="Check Lost Record">
									Check Lost Record
								</a>
							</div>
					</div>
					<div class="row panel panel-default">
						<?php if (isset($error_message)): ?>
							<div class="alert alert-error"><?php echo $error_message; ?></div>
						<?php endif; ?>
						<?php if ($this->session->flashdata('success') == TRUE): ?>
							<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
						<?php endif; ?>
						

						<table class="table table-striped table-hover table-bordered table-condensed">
							<caption>Your record is not found, but your pdf in here</caption>
							<thead>
								<tr>
									<th>doc_filename</th>
									<th>action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($document == FALSE): 
								?>
									<tr><td colspan="8">No Document yet</td></tr>
								<?php else: ?>
									<?php foreach ($document as $row): ?>
										<tr>
											<td><?php echo $row; ?></td>
											<td>
												<a href="<?php echo site_url().'/DOCUMENT/delete_file/'.$row;?>" onclick="return confirm('Are you sure you want to delete?');" data-toggle="tooltip" data-placement="bottom" title="Delete">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
						<?php echo $page;?>
					</div>
				</div>
			</div>
		<?php $this->load->view('template/footer'); ?>
		</div>
	</body>
</html>