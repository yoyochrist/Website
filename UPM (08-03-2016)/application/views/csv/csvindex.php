<!DOCTYPE HTML>
<html>
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
        <div class="container panel panel-default" style="margin-top:5%">    
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
		 
					<h2>CI Document Import</h2>
						<form method="post" action="<?php echo site_url() ?>/csv/importcsv" enctype="multipart/form-data">
							<input type="file" name="userfile" ><br><br>
							<input type="submit" name="submit" value="UPLOAD" class="btn btn-primary">
						</form>
		 
					<br><br>
					<table class="table table-striped table-hover table-bordered table-condensed col-md-10">
						<caption>Document Archive List</caption>
						<thead>
							<tr>
								<th>doc_level</th>
								<th>doc_type</th>
								<th>doc_no</th>
								<th>doc_title</th>
								<th>doc_rev_no</th>
								<th>doc_author</th>
								<th>doc_date_created</th>
								<th>doc_date_valid</th>
								<th>doc_filename</th>
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
										<td><?php echo $row['doc_date_created']; ?></td>
										<td><?php echo $row['doc_date_valid']; ?></td>
										<td><?php echo $row['doc_filename']; ?></td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
					<hr>
				</div>
			</div>
			<?php $this->load->view('template/footer'); ?>
		</div>
    </body>
</html>