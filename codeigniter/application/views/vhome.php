<?php $this->load->view('header');?>
    <div class="container" >

      <!--<form class="form-signin">-->
	  <?php echo form_open('Login', array('class'=>"form-signin")); ?>
        <h2 class="form-signin-heading" align="center">UKRIDA Help Desk</h2>
        <label for="username" class="sr-only">Email address</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
	  <?php echo validation_errors('<h4>','</h4>'); ?>
    </div> <!-- /container -->
<?php $this->load->view('footer');?>