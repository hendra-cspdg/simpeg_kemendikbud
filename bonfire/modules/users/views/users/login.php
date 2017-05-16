<?php
	$site_open = $this->settings_lib->item('auth.allow_register');
?>
<div class="wrapper">

      <!-- Topic Header -->
      <div class="topic">
        <div class="container">
          <div class="row">
            <div class="col-sm-4">

            </div>
            <div class="col-sm-8">
              <ol class="breadcrumb pull-right hidden-xs">
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
        	
          <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			<?php echo form_open(LOGIN_URL, array('autocomplete' => 'off')); ?>
            <div class="sign-form">
            <?php echo Template::message(); ?>
			 <?php
				 if (validation_errors()) :
			 ?>
			  <div class="row-fluid">
				 <div class="span12">
					 <div class="alert alert-error fade in">
						 <?php echo validation_errors(); ?>
					 </div>
				 </div>
			 </div>
			 <?php endif; ?>
              <h3 class="first-child">Sign In To Your Account</h3>
              <hr>
              <form role="form">
                <label class="sr-only" for="email">Email address/Username</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control" id="text" name="login" placeholder="Enter email/username">
                </div>
                <br>
                <label class="sr-only" for="exampleInputPassword1">Password</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Remember me
                  </label>
                </div>
                <button type="submit" name="log-me-in" class="btn btn-color">Submit</button>
                <hr>
              </form>
				<form>
				<?php  
				 if ($this->auth->is_logged_in()) :?>
					  <li><a href="<?php echo site_url('/logout') ?>"><?php e( lang('bf_action_logout')); ?></a></li>
					  <li><a href="<?php echo site_url(SITE_AREA) ?>"><span>Login area</span></a> </li>
				  <?php endif; ?>
              <!-- Lost password form -->
              <p>
                Lost your password? <a href="#lost-password__form" data-toggle="collapse" aria-expanded="false" aria-controls="lost-password__form">Click here to recover.</a>
              </p>
              <div class="collapse" id="lost-password__form">
                <p class="text-muted">
                  Enter your email address below and we will send you a link to reset your password.
                </p>
                <form class="form-inline" role="form">
                  <div class="form-group">
                    <label class="sr-only" for="lost-password__email">Email address</label>
                    <input type="email" class="form-control" id="lost-password__email" placeholder="Enter email">
                  </div>
                  <button type="submit" class="btn btn-color">Send</button>
                </form>
                
              </div> <!-- lost-password__form -->

            </div>
          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </div> <!-- / .wrapper -->