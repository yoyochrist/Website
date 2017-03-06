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
			});
		</script>
	</head>
	<body>
		<div class="container panel panel-default"  style="margin-top:5%; background-color: yellow;">
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
					<div class="row panel panel-default">
					</div>
					<div id="<?php if(!is_null($hide)){ echo 'hideForm'; } else { echo 'form'; } ?>">
					<div class="row panel panel-default">
						<?php if (isset($error_message)): ?>
							<div class="alert alert-error"><?php echo $error_message; ?></div>
						<?php endif; ?>
						<?php if ($this->session->flashdata('success') == TRUE): ?>
							<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
						<?php endif; ?>
						<table class="table table-striped table-hover table-bordered table-condensed">
							<caption>Document Archive List</caption>
							<thead>
								<tr>
									<th>doc_level</th>
									<th>doc_type</th>
									<th>doc_no</th>
									<th>doc_title</th>
									<th>doc_rev_no</th>
									<th>doc_author</th>
									<th>doc_filename</th>
									<th>action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($document == FALSE): ?>
									<tr><td colspan="8">No Document yet</td></tr>
								<?php else: ?>
									<?php foreach ($document as $row): ?>
										<tr>
											<td><?php echo $row['doc_level']; ?></td>
											<td><?php echo $row['doc_type']; ?></td>
											<td><?php echo $row['doc_no']; ?></td>
											<td><?php echo $row['doc_title']; ?></td>
											<td><?php echo $row['doc_rev_no']; ?></td>
											<td><?php echo $row['doc_author']; ?></td>
											<td><?php echo $row['doc_filename']; ?></td>
											<td>
												<a href="<?php echo base_url().'pdf/'.$row['doc_filename'];?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Detail">
													<span class="glyphicon glyphicon-eye-open"></span>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
			</div>
			<?php $this->load->view('template/footer'); ?>
		</div>
	</body>
</html>