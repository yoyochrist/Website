<html>
	<?php
		if (isset($this->session->userdata['logged_in']))
		{
			redirect(site_url()."/PORTAL/view");
		}
	?>
	<head>
		<title>Penjaminan Mutu</title>
		<link rel="stylesheet" href="<?php echo base_url().'/assets/css/bootstrap.min.css';?>">
	</head>
	<body>
		<div id="container" style="margin-top:5%">
			<div class="col-md-5">
			</div>
			<div class="col-md-2 panel panel-default">
				<h2>Login Form</h2>
				<hr/>
				<?php 
					echo form_open('PORTAL/login'); 
				?>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" id="username" placeholder="Username" required/>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
				</div>
				<button type="submit" class="btn btn-block btn-primary">Submit</button>
				<?php echo form_close(); ?>
				<?php
					if (isset($logout_message)) 
					{
						echo "<div class='alert alert-info'>";
						echo $logout_message;
						echo "</div>";
					}
				?>
				<?php
					if (isset($message_display)) 
					{
						echo "<div class='alert alert-success'>";
						echo $message_display;
						echo "</div>";
					}
				?>
			</div>
		</div>
		<div class="col-md-5">
		</div>
	</body>
</html>