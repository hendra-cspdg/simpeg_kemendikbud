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

?>
<div class="admin-box box box-primary profile">
	<div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="list-unstyled profile-nav">
                                    <li>
                                        <img src="https://intra.lipi.go.id/public/uploads/foto/__323/198503012010121001.jpg" class="img-responsive pic-bordered" alt="">
                                        <a href="javascript:;" class="profile-edit"> ubah foto </a>
                                    </li>
                                    <li>
                                        <a href="https://intra.kemdikbud.go.id/"> Publikasi </a>
                                    </li>
                                    <li>
                                        <a href="https://intra.kemdikbud.go.id/"> Kegiatan </a>
                                    </li>
                                    <li>
                                        <a href="https://intra.kemdikbud.go.id/"> Perjalanan Luar Negeri </a>
                                    </li>
                                    <li>
                                        <a href="https://intra.kemdikbud.go.id/"> Blog </a>
                                    </li>
                                    <li>
                                        <a href="https://intra.kemdikbud.go.id/"> Grup </a>
                                    </li>
                                    <li>
                                        <a href="https://intra.kemdikbud.go.id/"> Berita </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8 profile-info">
                                        <h1 class="font-green sbold uppercase"><?php echo isset($pegawai->Gelar_Depan) ? $pegawai->Gelar_Depan : ''; ?>  <?php echo isset($pegawai->Nama) ? $pegawai->Nama : ''; ?> <?php echo isset($pegawai->Gelar_Blk) ? $pegawai->Gelar_Blk : ''; ?></h1>
                                        <h4><?php echo isset($pegawai->Nama_satker) ? $pegawai->Nama_satker : 'Nama Satker'; ?></h4>
                                        <p>   </p>
                                                                                <p>
                                            <a href="javascript:;"><?php echo isset($pegawai->Email) ? $pegawai->Email : 'Email'; ?></a>
                                        </p>
                                        <ul class="list-inline">
                                            <li>
                                                <i class="fa fa-map-marker"></i> <?php echo isset($pegawai->Alamat) ? $pegawai->Alamat : 'Alamat'; ?></li>
                                            <li>
                                                <i class="fa fa-calendar"></i> <?php echo isset($pegawai->Tgl_Lahir) ? $pegawai->Tgl_Lahir : 'Tgl_Lahir'; ?> </li>
                                                                                        <li>
                                                <a target="_blank" href="Mardiana Razors"><i class="fa fa-facebook"></i> Facebook </a>
                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </ul>
                                    </div>
                                    <!--end col-md-8-->
                                    <div class="col-md-4">
                                        <div class="portlet sale-summary">
                                            <div class="portlet-title" style="padding:5px;">
                                                <div class="caption font-red sbold"> Kepakaran Sivitas </div>
                                            </div>
                                            <div class="portlet-body" style="padding:5px;">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <strong>Bidang Kepakaran</strong><br>
                                                        <small>
                                                            Tidak Ada Bidang Kepakaran                                                        </small>
                                                    </li>
                                                    <li>
                                                        <strong>Bidang Penelitian</strong><br>
                                                        <small>
                                                            Tidak Ada Bidang Penelitian                                                        </small>
                                                    </li>
                                                    <li>
                                                        <strong>Rumpun Kepakaran</strong><br>
                                                        <small>
                                                            Tidak Ada Rumpun Kepakaran                                                        </small>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-md-4-->
                                </div>
                                <!--end row-->
                                <div class="tabbable-line tabbable-custom-profile">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#personal" data-toggle="tab" aria-expanded="true"> Data Personal </a>
                                        </li>
                                        <li class="">
                                            <a href="#pendidikan" data-toggle="tab" aria-expanded="false"> Pendidikan </a>
                                        </li>
                                        <li class="">
                                            <a href="#pengalaman" data-toggle="tab" aria-expanded="false"> Pengalaman </a>
                                        </li>
                                        <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personal">
                                            <form role="form" action="#">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Nama
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>Yana Mardiyana </b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            NIP
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>198503012010121001</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Satuan Kerja
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>
                                                                Pusat Penelitian Sistem Mutu dan Teknologi Pengujian                                                            </b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Status Kepegawaian
                                                            
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>PNS (12 Jan 2010 - 03 Jan 2043)</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Golongan
                                                            
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>III/b - Penata Muda Tingkat I</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Tanggal Masuk / Aktif
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>
                                                                12 Jan 2010 / 01 Jan 2011                                                            </b>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Tanggal Pensiun
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>
                                                                03 Jan 2043                                                            </b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            No. Handphone
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>082260195526</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Jenis Kelamin
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>Pria</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Agama
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>Islam</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Status Pernikahan
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>Kawin</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Tempat Lahir
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Jabatan
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>Programmer Subbagian Kepegawaian dan Umum</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Kemampuan Bahasa
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b> Sunda</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Kontak
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>
                                                                  yana004@kemdikbud.go.id<br>yana.mardiyana@kemdikbud.go.id<br>yanarazor@gmail.com<br>-<br><br>                                                            </b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Email
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b>
                                                                yanarazor@gmail.com                                                            </b>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                        <!--tab-pane-->
                                        <div class="tab-pane" id="pendidikan">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                        Pendidikan
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <b>
                                                              Pelatihan CCNA (Cisco), Pelatihan Mikrotik jaringan, Pelatihan Programming Phyton dan Java                                                        </b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--tab-pane-->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="pengalaman">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    Pengalaman
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <b>
                                                        <p>  Data entry Di PT.Alihdaya Indonesia,</p><p><barisbaru>Programmer PT.Dolphines Technology (1.5 Tahun),</barisbaru></p><p><barisbaru><barisbaru>Programmer PT.Bank Andara (15 Juni 2009 - februari 2011)</barisbaru></barisbaru></p>                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
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
                    
                    <!--tab_1_2-->
                    <!--end tab-pane-->
            </div>
</div>