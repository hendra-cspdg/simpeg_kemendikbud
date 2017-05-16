  <!-- Extra Bar -->
    <div class="mini-navbar mini-navbar-dark hidden-xs">
      <div class="container">
        <div class="col-sm-12">
          <a href="#" class="first-child"><i class="fa fa-envelope"></i> Email<span class="hidden-sm">: pisew@gmail.com</span></a>
          <span class="phone">
            <i class="fa fa-phone-square"></i>+62 (21) 72799234, SMS: +62 (813) 11122012
          </span>
          <a href="<?php echo base_url(); ?>login" class="pull-right"><i class="fa fa-sign-in"></i> <?php echo lang('bf_login'); ?></a>
          <a href="#" class="pull-right" id="nav-search"><i class="fa fa-search"></i> Search</a>
          <a href="#" class="pull-right hidden" id="nav-search-close"><i class="fa fa-times"></i></a>
          <!-- Search Form -->
          <form class="pull-right hidden" role="search" action="<?php echo base_url(); ?>news" method="get" id="nav-search-form">
            <div class="input-group">
              <input type="text" class="form-control" name="key" value="<?php echo isset($key) ? $key : ""; ?>" placeholder="Search">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="navbar navbar-dark navbar-static-top" role="navigation">
      <div class="container">

        <!-- Navbar Header -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">
          	<img src="<?php echo base_url();?>assets/images/ciptakarya.png" width="50px"/> 
           		<?php echo lang('bf_site_name'); ?>
        	</a>
        </div> <!-- / Navbar Header -->

        <!-- Navbar Links -->
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="<?php echo (isset($mainmenu) and $mainmenu =="") ? "active" : "";?>"><a href="<?php echo base_url(); ?>" class="bg-hover-color">Home</a></li>
            <li class="dropdown <?php echo (isset($mainmenu) and $mainmenu =="about") ? "active" : "";?>">
              <a href="#"  class="dropdown-toggle bg-hover-color" data-toggle="dropdown">Profile <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>pages/view/11/sambutan-kapus" class="bg-hover-color"><?php echo lang('bf_sambutan'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>pages/view/16/visi-misi" class="bg-hover-color"><?php echo lang('bf_visimisi'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>pages/view/1/administrative-division" class="bg-hover-color"><?php echo lang('bf_administrativedivision'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>pages/view/2/reaearch-facilities-division" class="bg-hover-color"><?php echo lang('bf_reaearchfacilitiesdivision'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>pages/view/3/Service-dan-diseminasion-division" class="bg-hover-color"><?php echo lang('bf_Servicedandiseminasiondivision'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>pages/view/10/struktur-organisasi" class="bg-hover-color"><?php echo lang('bf_struktur'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>pages/view/12/fasilitas" class="bg-hover-color"><?php echo lang('bf_fasilitas'); ?></a></li>
                
            </ul>
            </li>

            <li class="dropdown <?php echo (isset($mainmenu) and $mainmenu =="kip") ? "active" : "";?>">
              <a href="<?php echo base_url(); ?>kip"  class="dropdown-toggle bg-hover-color" data-toggle="dropdown"><?php echo lang('bf_kip'); ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>kip" class="bg-hover-color">Dokumen</a></li>
                <li><a href="<?php echo base_url(); ?>even" class="bg-hover-color">Event Mendatang</a></li>
                <li><a href="<?php echo base_url(); ?>ikm/read/ikm" class="bg-hover-color">IKM</a></li>
                <li><a href="<?php echo base_url(); ?>gal" class="bg-hover-color">Galeri</a></li>
                <li><a href="<?php echo base_url(); ?>news" class="bg-hover-color"><?php echo lang('bf_news'); ?></a></li>
            </ul>
             </li>
            <li><a href="<?php echo base_url(); ?>contact" class="bg-hover-color"><?php echo lang('bf_contact'); ?></a></li>
             
             <!--<li class="<?php echo (isset($mainmenu) and $mainmenu =="news") ? "active" : "";?>" ><a href="<?php echo base_url(); ?>news" class="bg-hover-color"><?php echo lang('bf_news'); ?></a></li>-->

          </ul>

          <!-- Search Form (xs) -->
          <form class="navbar-form navbar-left visible-xs" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Go!</button>
          </form> <!-- / Search Form (xs) -->

        </div> <!-- / Navbar Links -->
      </div> <!-- / container -->
    </div> <!-- / navbar -->
