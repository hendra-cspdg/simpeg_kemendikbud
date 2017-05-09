<?php
	Assets::add_css( array(
		'font-awesome.min.css',
		'ionicons.min.css',
	));

	if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
		Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
	}
	$mainmenu = $this->uri->segment(2);
	$menu = $this->uri->segment(3);
	$submenu = $this->uri->segment(4);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?> <?php echo $this->settings_lib->item('site.title') ?></title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex" />
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/bootstrap.min.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/dist/css/AdminLTE.min.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/dist/css/skins/_all-skins.min.css">
   	<script src="<?php echo base_url(); ?>themes/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
   	<?php echo Assets::css(null, true); ?> 
</head> 

<body class="skin-blue sidebar-mini <?php echo (isset($collapse) and $collapse) ? "sidebar-collapse" : ""; ?>">
 
<div id="wrapper">

<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url();?>assets/images/logo.png" height="25"/></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
      	<img src="<?php echo base_url();?>assets/images/logo.png" height="25"/> 
      		<?php
				echo $this->settings_lib->item('site.title');
			?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?>
                  <small>Role : <?php echo isset($current_user->role_name) ? $current_user->role_name : "" ?></small>
                </p>
              </li>
              <!-- Menu Body -->
               
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url(SITE_AREA .'/settings/users/edit') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="keyword" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
         
        <?php if ($this->auth->has_permission('Dashboard.Reports.View')) : ?>
        	<li class="treeview <?php echo $menu == 'dashboard' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/reports/dashboard">
	            	<i class="fa fa-dashboard"></i>
    	        	<span>Dashboard Simpedas</span>    
          		</a>
          </li>
        <?php endif; ?>
         
        <?php if ($this->auth->has_permission('Site.Masters.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'masters' ? 'active' : '' ?> <?php echo $menu == 'pegawai' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>MASTER DATA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->auth->has_permission('Kegiatan.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/kegiatan"><i class="fa fa-circle-o"></i>Kegiatan</a></li>
            <?php endif; ?>
            <?php if ($this->auth->has_permission('Pegawai.Kepegawaian.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/kepegawaian/pegawai"><i class="fa fa-circle-o"></i>Pegawai</a></li>
            <?php endif; ?>
            <?php if ($this->auth->has_permission('Pejabat_Pemberi_Perintah.Kepegawaian.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/kepegawaian/pejabat_pemberi_perintah"><i class="fa fa-circle-o"></i>Pejabat</a></li>
            <?php endif; ?>
          </ul>
          
        </li>
         <?php endif; ?>
        
    	<?php if ($this->auth->has_permission('Site.Kepegawaian.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'kepegawaian' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Kepegawaian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          </ul>
        </li>
         <?php endif; ?>
    	<?php if ($this->auth->has_permission('Site.Developer.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'developer' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>DEVELOPER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>admin/developer/sysinfo"><i class="fa fa-circle-o"></i> Informasi Sistem</a></li>
            <li><a href="<?php echo base_url();?>admin/developer/builder"><i class="fa fa-circle-o"></i> Module Builder</a></li>
             <li>
              <a href="<?php echo base_url();?>admin/settings/emailer"><i class="fa fa-circle-o"></i> Database Tools
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
              	<li><a href="<?php echo base_url();?>admin/developer/database"><i class="fa fa-circle-o"></i> Maintenance</a></li>
              	<li><a href="<?php echo base_url();?>admin/developer/database/backups"><i class="fa fa-circle-o"></i> Backups</a></li>
              	<li><a href="<?php echo base_url();?>admin/developer/migrations"><i class="fa fa-circle-o"></i> Migrations</a></li>
              </ul>
            </li>
          </ul>
        </li>
    <?php endif; ?>
    <?php if ($this->auth->has_permission('Site.Settings.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'settings' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          	<li><a href="<?php echo base_url();?>admin/settings/settings"><i class="fa fa-circle-o"></i> Setting</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/roles"><i class="fa fa-circle-o"></i> Role</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/users"><i class="fa fa-circle-o"></i> User</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/permissions"><i class="fa fa-circle-o"></i> Permissions</a></li>
            <li>
              <a href="<?php echo base_url();?>admin/settings/emailer"><i class="fa fa-circle-o"></i> Email
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
              	<li><a href="<?php echo base_url();?>admin/settings/emailer"><i class="fa fa-circle-o"></i> Setting</a></li>
                <li><a href="<?php echo base_url();?>admin/settings/emailer/template"><i class="fa fa-circle-o"></i> Template</a></li>
				<li><a href="<?php echo base_url();?>admin/settings/emailer/queue"><i class="fa fa-circle-o"></i> Antrian</a></li>
              </ul>
            </li>
          </ul>
        </li>
    <?php endif; ?>
   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

