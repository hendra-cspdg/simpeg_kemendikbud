<?php 
	$this->load->library('convert');
 	$convert = new convert();
    $tab_pane_pendidikan_id = uniqid("tab_pane_pendidikan");
    $tab_pane_personal_id = uniqid("tab_pane_personal");
    $tab_pane_pengalaman_id = uniqid("tab_pane_pengalaman");

    $tab_pane_kepangkatan_id = uniqid("tab_pane_kepangkatan");
    $tab_pane_pindah_unit_kerja_id = uniqid("tab_pane_pindah_unit_kerja");
    $tab_pane_prestasi_kerja = uniqid("tab_pane_prestasi_kerja");
    $tab_pane_diklat_struktural_id = uniqid("tab_pane_diklat_struktural");
    $tab_pane_diklat_fungsional_id = uniqid("tab_pane_diklat_fungsional");
?>
<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('pegawai_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;
$id = isset($pegawai->id) ? $pegawai->id : '';
$PNS_ID = isset($pegawai->PNS_ID) ? $pegawai->PNS_ID : '';

?>
<div class="admin-box box box-primary profile">
	<div class="box-body">
		<div class="row">
                            <div class="col-md-2">
                                <ul class="list-unstyled profile-nav">
                                    <li>
                                        <img src="<?php echo base_url(); ?>assets/images/<?php echo (isset($pegawai->photo) && $pegawai->photo != "") ? $pegawai->photo : 'noimage.jpg'; ?>" class="img-responsive pic-bordered" alt="">
                                        
                                        <a href="<?php echo base_url();?>admin/kepegawaian/pegawai/uploadfoto/<?php echo $PNS_ID; ?>" tooltip="Upload Foto" class="show-modal btn btn-small btn-warning margin"><i class="fa fa-photo"></i> Ubah foto </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-8 profile-info">
                                        <h1 class="font-green sbold uppercase"><?php echo isset($pegawai->Gelar_Depan) ? $pegawai->Gelar_Depan : ''; ?>  <?php echo isset($pegawai->Nama) ? $pegawai->Nama : ''; ?> <?php echo isset($pegawai->Gelar_Blk) ? $pegawai->Gelar_Blk : ''; ?></h1>
                                        <h4><b>NIP</b> <?php echo isset($pegawai->Nip_Baru) ? $pegawai->Nip_Baru : ''; ?></h4>
                                        <ul class="list-inline">
                                            <li>
                                                <i class="fa fa-map-marker"></i> <?php echo isset($pegawai->Alamat) ? $pegawai->Alamat : 'Alamat'; ?></li>
                                            <li>
                                                <i class="fa fa-calendar"></i> <?php echo isset($pegawai->Tgl_Lahir) ? $convert->fmtDate($pegawai->Tgl_Lahir,"dd month yyyy") : 'Tgl_Lahir'; ?> </li>                                                                                                                                                                                                                                                                                                                                                                                                       </ul>
                                    </div>
                                    <!--end col-md-8-->
                                    <div class="col-md-4">
                                        <div class="portlet sale-summary">
                                            <div class="portlet-title" style="padding:5px;">
                                                <div class="caption font-red sbold"> Unit Organisasi </div>
                                            </div>
                                            <div class="portlet-body" style="padding:5px;">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <strong>Satker</strong><br>
                                                        <small>
                                                            <?php echo isset($pegawai->satker) ? $pegawai->satker : '-'; ?>
                                                       </small>
                                                    </li>
                                                    <li>
                                                        <strong>Bidang</strong><br>
                                                        <small>
                                                            <?php echo isset($pegawai->bidang) ? $pegawai->bidang : '-'; ?>
                                                        </small>
                                                    </li>
                                                    <li>
                                                        <strong>Sub Bidang</strong><br>
                                                        <small>
                                                        	<?php echo isset($pegawai->sub_bidang) ? $pegawai->sub_bidang : '-'; ?>    
                                                        </small>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-md-4-->
                                </div>
                                

                                <div class="nav-tabs-custom">
                                    <ul id="tab-insides-here" class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#<?php echo $tab_pane_personal_id; ?>" data-toggle="tab" aria-expanded="true"> Data Personal </a>
                                        </li>
                                        <li class="">
                                            <a href="#<?php echo $tab_pane_pendidikan_id; ?>" data-toggle="tab" aria-expanded="false"> Pendidikan </a>
                                        </li>
                                        <li class="">
                                            <a href="#<?php echo $tab_pane_pengalaman_id;?>" data-toggle="tab" aria-expanded="false"> Pengalaman </a>
                                        </li>
                                        <li class="">
                                        
                                            <a href="#<?php echo $tab_pane_kepangkatan_id;?>" data-toggle="tab" aria-expanded="false"> Kepangkatan </a>
                                        </li>
                                         <li class="">
                                            <a href="#<?php echo $tab_pane_pindah_unit_kerja_id;?>" data-toggle="tab" aria-expanded="false"> Pindah Unit Kerja </a>
                                        </li>
                                         <li class="">
                                            <a href="#<?php echo $tab_pane_prestasi_kerja;?>" data-toggle="tab" aria-expanded="false"> Prestasi Kerja </a>
                                        </li>
                                         <li class="">
                                            <a href="#<?php echo $tab_pane_diklat_struktural_id;?>" data-toggle="tab" aria-expanded="false"> Diklat Struktural </a>
                                        </li>
                                         <li class="">
                                            <a href="#<?php echo $tab_pane_diklat_fungsional_id;?>" data-toggle="tab" aria-expanded="false"> Diklat Fungsional </a>
                                        </li>
                                         
                                    </ul>
                                    <div class="tab-content">
                                        <?php 
                                            $this->load->view('kepegawaian/tab_pane_personal',array('TAB_ID'=>$tab_pane_personal_id));                                         
                                            $this->load->view('kepegawaian/tab_pane_riwayat_pendidikan',array('TAB_ID'=>$tab_pane_pendidikan_id));
                                            $this->load->view('kepegawaian/tab_pane_riwayat_pengalaman',array('TAB_ID'=>$tab_pane_pengalaman_id));
                                            $this->load->view('kepegawaian/tab_pane_riwayat_kepangkatan',array('TAB_ID'=>$tab_pane_kepangkatan_id));
                                            $this->load->view('kepegawaian/tab_pane_riwayat_pindah_unit_kerja',array('TAB_ID'=>$tab_pane_pindah_unit_kerja_id));
                                            $this->load->view('kepegawaian/tab_pane_riwayat_prestasi_kerja',array('TAB_ID'=>$tab_pane_prestasi_kerja));
                                            $this->load->view('kepegawaian/tab_pane_riwayat_diklat_struktural',array('TAB_ID'=>$tab_pane_diklat_struktural_id));
                                            $this->load->view('kepegawaian/tab_pane_riwayat_diklat_fungsional',array('TAB_ID'=>$tab_pane_diklat_fungsional_id));

                                        ?>
                                        
                                        <!-- PRIVACY SETTINGS TAB -->
                                        <div class="tab-pane" id="kegiatan">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    Kegiatan
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <b>
                                                                                                              </b>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END PRIVACY SETTINGS TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>
</div>

 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-scrolling-tabs/jquery.scrolling-tabs.css">
 <script src="<?php echo base_url(); ?>assets/js/jquery-scrolling-tabs/jquery.scrolling-tabs.js"></script>

 <script>
    $(document).ready(function(){
        
        $('.nav-tabs').scrollingTabs();
        
    });
 </script>