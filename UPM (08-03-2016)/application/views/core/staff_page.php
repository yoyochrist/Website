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
		<title>Penjaminan Mutu</title>
		<link rel="stylesheet" href="<?php echo base_url().'/assets/css/bootstrap.min.css';?>">
		<script src="<?php echo base_url().'/assets/js/bootstrap.min.js';?>"></script>
		
		<link rel="stylesheet" href="<?php base_url().'/assets/css/jqueryui.css';?>">
		<script src="<?php echo base_url().'/assets/js/jqueryui.min.js';?>"></script>
		<script src="<?php echo base_url().'/assets/js/jquery-2.2.1.min.js';?>"></script>
		<script>
		 $(function () {
			$("#doc_code").autocomplete({   
				minLength:0,
				delay:0,
				source:'<?php echo site_url('document/autocomplete'); ?>',
			}); 
		</script>
	</head>
	<body>
		<div class="container panel panel-default"  style="margin-top:5%">
			<?php $this->load->view('template/header'); ?>
			<div id="main" class="col-md-12">
				<?php $this->load->view('template/navbar');?>
				<div class="col-md-10 panel panel-default">
					<div class="row">
						<form method="post" action="<?php echo site_url().'/document/search';?>">
							<div class="form-group col-md-6">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Document Code</span>
									<input type="text" class="form-control" name="doc_code" id="doc_code" placeholder="Document Code" required/>
								</div>
							</div>
							<button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span></button>
						<form>
					</div>
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
										<td><a href="<?php echo base_url().'document/'.$row['doc_filename'];?>" target="_blank"><?php echo $row['doc_filename']; ?></a></td>
										<td>
											<a href="<?php echo site_url().'/document/view/'.$row['doc_code'];?>" data-toggle="tooltip" data-placement="bottom" title="Detail">
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
			<?php $this->load->view('template/footer'); ?>
		</div>
	</body>
</html>