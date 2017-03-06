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
		<title>Penjaminan Mutu - Detail</title>
		<link rel="stylesheet" href="<?php echo base_url().'/assets/css/bootstrap.min.css';?>">
		<script src="<?php echo base_url().'/assets/js/bootstrap.min.js';?>"></script>
	</head>
	<body>
		<div class="container panel panel-default" style="margin-top:5%">
			<?php $this->load->view('template/header'); ?>
			<div id="main">
				<?php $this->load->view('template/navbar');?>
				<div class="col-md-8 panel panel-default" align="center">
					<h2>Detail <?php echo $document['doc_code'];?></h2>
					<hr/>
					<div class="col-md-12">
						<table class="table">
							<tr>
								<th>Attribute</th>
								<th>Value</th>
							</tr>
							<tr>
								<td>Document Level</td>
								<td><?php echo $document['doc_level']; ?></td>
							</tr>
							<tr>
								<td>Document Type</td>
								<td><?php echo $document['doc_type']; ?></td>
							</tr>
							<tr>
								<td>Document Number</td>
								<td><?php echo $document['doc_no']; ?></td>
							</tr>
							<tr>
								<td>Title</td>
								<td><?php echo $document['doc_title']; ?></td>
							</tr>
							<tr>
								<td>Revision</td>
								<td><?php echo $document['doc_rev_no']; ?></td>
							</tr>
							<tr>
								<td>Author</td>
								<td><?php echo $document['doc_author']; ?></td>
							</tr>
							<tr>
								<td>Date Created</td>
								<td><?php echo $document['doc_date_created']; ?></td>
							</tr>
							<tr>
								<td>Filename</td>
								<td><a href="<?php echo base_url().'document/'.$document['doc_filename'];?>" target="_blank"><?php echo $document['doc_filename']; ?></a></td>
							</tr>
						</table>
						<a href="<?php echo site_url().'/portal/view';?>" class="btn btn-block btn-info" role="button">Back to summary</a>
					</div>
				</div>
			</div>
			<?php $this->load->view('template/footer'); ?>
		</div>
	</body>
</html>