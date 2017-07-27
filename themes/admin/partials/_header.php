<?php
	Assets::add_css( array(
		'font-awesome.min.css',
		'ionicons.min.css',
	));

	if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
	//	Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
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
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/bootstrap.min.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/dist/css/AdminLTE.min.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/dist/css/skins/_all-skins.min.css">
   	<script src="<?php echo base_url(); ?>themes/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
     
    <script src="<?php echo base_url(); ?>themes/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/admin/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/admin/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>themes/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
    
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>themes/admin/plugins/select2/select2.full.min.js"></script>

    <!-- sweet alert -->
    <script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
   
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/select2/select2.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">

     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-scrolling-tabs/jquery.scrolling-tabs.css">
     <script src="<?php echo base_url(); ?>assets/js/jquery-scrolling-tabs/jquery.scrolling-tabs.js"></script>
     <script src="<?php echo base_url(); ?>assets/plugins/jstree/dist/jstree.js"></script>
     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jstree/dist/themes/default/style.min.css">
     
     

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
				echo trim($this->settings_lib->item('site.title'));
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
              <img src="<?php echo base_url();?>assets/images/<?php echo (isset($pegawai->PHOTO) && $pegawai->PHOTO != "") ? $pegawai->PHOTO : 'noimage.jpg'; ?>" class="user-image" alt="Photo Profile">
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
          <img src="<?php echo base_url();?>assets/images/<?php echo (isset($pegawai->PHOTO) && $pegawai->PHOTO != "") ? $pegawai->PHOTO : 'noimage.jpg'; ?>" class="img-circle" alt="Profile Photo">
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
        	<li class="treeview <?php echo $submenu == 'profile' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/kepegawaian/pegawai/profile">
	            	<i class="fa fa-user"></i>
    	        	<span>Data Pribadi</span>    
          		</a>
          </li>
        <?php if ($this->auth->has_permission('Dashboard.Reports.View')) : ?>
        	<li class="treeview <?php echo $menu == 'dashboard' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/reports/dashboard">
	            	<i class="fa fa-dashboard"></i>
    	        	<span>Dashboard</span>    
          		</a>
          </li>
        <?php endif; ?>
         <?php if ($this->auth->has_permission('Rekap.Reports.View')) : ?>
        	<li class="treeview ">
        		<a href="<?php echo base_url();?>pegawai/rekap">
	            	<i class="fa fa-dashboard"></i>
    	        	<span>Rekap </span>    
          		</a>
          </li>
        <?php endif; ?>
        <!--
         <?php if ($this->auth->has_permission('Petajabatan.Reports.View')) : ?>
        	<li class="treeview <?php echo $menu == 'petajabatan' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/reports/petajabatan">
	            	<i class="fa fa-list"></i>
    	        	<span>Peta Jabatan</span>    
          		</a>
          </li>
        <?php endif; ?>
        -->
        <?php if ($this->auth->has_permission('Site.Masters.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'masters' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>MASTER DATA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->auth->has_permission('Agama.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/agama"><i class="fa fa-circle-o"></i>Agama</a></li>
            <?php endif; ?>
            <?php if ($this->auth->has_permission('Ref_jabatan.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/ref_jabatan"><i class="fa fa-circle-o"></i>Jabatan</a></li>
            <?php endif; ?>
            <?php if ($this->auth->has_permission('Tkpendidikan.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/tkpendidikan"><i class="fa fa-circle-o"></i>Tingkat Pendidikan</a></li>
            <?php endif; ?>
            <?php if ($this->auth->has_permission('Golongan.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/golongan"><i class="fa fa-circle-o"></i>Golongan</a></li>
            <?php endif; ?>
             <li><a href="<?php echo base_url();?>pegawai/manage_unitkerja/index"><i class="fa fa-circle-o"></i>Unit Kerja</a></li>
             <li><a href="<?php echo base_url();?>api/manage_api/index"><i class="fa fa-circle-o"></i>WS API</a></li>
             <li><a href="<?php echo base_url();?>api/manage_application/index"><i class="fa fa-circle-o"></i>WS Application</a></li>
          </ul>
          
        </li>
         <?php endif; ?>
        
    	<?php if ($this->auth->has_permission('Site.Kepegawaian.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'kepegawaian' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Profile Pegawai</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>admin/kepegawaian/pegawai"><i class="fa fa-circle-o"></i> Data Pegawai</a></li>
          </ul>
        </li>
         <?php endif; ?>
         <?php if ($this->auth->has_permission('Site.Reports.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'reports' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>pegawai/duk"><i class="fa fa-circle-o"></i>Daftar Urut Kepangkatan</a></li>
            <!--
            <li><a href="<?php echo base_url();?>admin/reports/pegawai/kelompokjabatan"><i class="fa fa-circle-o"></i>Daftar kelompok Jabatan</a></li>
            -->
            <li><a href="<?php echo base_url();?>admin/reports/petajabatan"><i class="fa fa-list"></i>Daftar kuota jabatan</a></li>
            <li><a href="<?php echo base_url();?>petajabatan/struktur"><i class="fa fa-circle-o"></i>Struktur Organisasi</a></li>
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
            <!--
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
            -->
          </ul>
        </li>
    <?php endif; ?>
    <?php if ($this->auth->has_permission('Site.Settings.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'settings' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Pengatuan Aplikasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          	<li><a href="<?php echo base_url();?>admin/settings/settings"><i class="fa fa-circle-o"></i> Pengaturan</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/roles"><i class="fa fa-circle-o"></i> Role</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/users"><i class="fa fa-circle-o"></i> User</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/permissions"><i class="fa fa-circle-o"></i> Permissions</a></li>
            <!--
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
            -->
          </ul>
        </li>
    <?php endif; ?>
   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<script>
    function showModalX(callableName,callableFn,parent) {
        $('.perhatian').fadeOut(300, function(){});
            var title = $(parent).attr("tooltip");
            $.ajax({
            url: $(parent).attr("href"),
            type: 'post',
            beforeSend: function (xhr) {
                $("#loading-all").show();
            },
            success: function (content, status, xhr) {
                
                var json = null;
                var is_json = true;
                try {
                    json = $.parseJSON(content);
                } catch (err) {
                    is_json = false;
                }
                if (is_json == false) {
                    $("#modal-custom-body").html(content);
                    $("#myModalcustom-Label").html(title);
                    $("#modal-custom-global").modal('show');
                    $("#modal-custom-global").off(callableName);
                    $("#modal-custom-global").on(callableName,callableFn);
                    $("#loading-all").hide();
                } else {
                    alert("Error");
                }
            }
            }).fail(function (data, status) {
            if (status == "error") {
                alert("Error");
            } else if (status == "timeout") {
                alert("Error");
            } else if (status == "parsererror") {
                alert("Error");
            }
            });
        }
</script>
