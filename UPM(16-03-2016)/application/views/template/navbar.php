<?php
		if (isset($this->session->userdata['logged_in'])) 
		{
			$username = ($this->session->userdata['logged_in']['username']);
			$role = ($this->session->userdata['logged_in']['idrole']);
		} 
		else
		{
			redirect(base_url());
		}
	?>
<div class="col-md-2 panel panel-default">
	<ul class="nav nav-pills nav-stacked">
		<li>Welcome <?php echo $username;?></li>
		<li><b id="home"><a href="<?php echo site_url().'/PORTAL/view'?>">Home</a></b></li>
		<li><b id="logout"><a href="<?php echo site_url().'/PORTAL/logout'?>">Logout</a></b></li>
	</ul>
</div>