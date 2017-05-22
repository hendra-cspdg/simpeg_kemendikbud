<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
<?php
$this->load->library('convert');
$convert = new convert();
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
                                

                                <div class="tabbable-line tabbable-custom-profile">
                                    <ul id="tab-insides-here" class="nav nav-tabs">
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
                                         <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan2 </a>
                                        </li>
                                         <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan3 </a>
                                        </li>
                                         <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan4 </a>
                                        </li>
                                         <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan5 </a>
                                        </li>
                                         <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan6 </a>
                                        </li>
                                         <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan7 </a>
                                        </li>
                                        <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan7 </a>
                                        </li>
                                        <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan7 </a>
                                        </li>
                                        <li class="">
                                            <a href="#kegiatan" data-toggle="tab" aria-expanded="false"> Kegiatan7 </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personal">
                                            <form role="form" action="#">
                                                
                                                 
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            Status Kepegawaian
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                            <b><?php echo isset($pegawai->Status_CPNS_PNS) ? $pegawai->Status_CPNS_PNS == "P" ? "PNS" : "" : ''; ?>   (<?php echo $convert->fmtDate($pegawai->TMT_PNS,"dd month yyyy"); ?>)</b>
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
                                                	<div class="col-lg-12 col-md-12 col-sm-21 col-xs-12">
                                                    <?php if ($this->auth->has_permission('Pegawai.Kepegawaian.Addpendidikan')) : ?>
													<a href="<?php echo base_url(); ?>admin/kepegawaian/pegawai/addpendidikan/<?php echo $PNS_ID ?>" class="show-modal" tooltip="Tambah Riwayat Pendidikan">
														<button type="button" class="btn btn-default btn-warning margin pull-right "><i class="fa fa-plus"></i> Tambah</button>
													</a>
													<?php endif; ?>
													<table class="table">
													<thead>
														<tr>
															<th>No</th>
															<th>Pendidikan</th>
															<th>Tgl. Lulus</th>
															<th>Tahun Lulus</th>
															<th>Nomor Ijazah</th>
															<th>Nama Sekolah</th>
															<th>Pendidikan Pertama</th>
															<th>#</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															 
														</tr>
													</tfoot>
													<tbody>
														<?php
														$NO = 1;
														$has_records	= isset($records) && is_array($records) && count($records);
														if ($has_records) :
															foreach ($records as $record) :
														?>
														<tr>
															<td><?php e($NO); ?>.</td>
															<td><?php e($record->NAMA_PENDIDIKAN); ?></td>
															<td><?php e($record->Tanggal_Lulus) ?></td>
															<td><?php e($record->Tahun_Lulus) ?></td>
															<td><?php e($record->Nomor_Ijasah) ?></td>
															<td><?php e($record->Nama_Sekolah) ?></td>
															<td><?php e($record->Pendidikan_Pertama) ?></td>
															<td>
															<a href="<?php echo base_url(); ?>admin/kepegawaian/pegawai/addpendidikan/<?php echo $record->PNS_ID; ?>/<?php echo $record->ID; ?>"  data-toggle='tooltip' title='Edit data' class="show-modal"><span class='fa-stack'>
															 <i class='fa fa-square fa-stack-2x'></i>
															 <i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
															 </span>
															 </a>
															 <a href="#" url="<?php echo base_url() ?>admin/kepegawaian/pegawai/deletependidikan" kode="<?php echo $record->ID; ?>" class='delete' data-toggle='tooltip' title='Hapus Data' >
															 <span class='fa-stack'>
															 <i class='fa fa-square fa-stack-2x'></i>
															 <i class='fa fa-trash-o fa-stack-1x fa-inverse'></i>
															 </span>
															 </a>
															 </td>
														</tr>
														<?php
															endforeach;
														else:
														?>
														<tr>
															<td colspan="7">Data tidak ada</td>
														</tr>
														<?php endif; ?>
													</tbody>
												</table>  
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
    </div>
</div>
<script type="text/javascript">
$(".delete").click(function(){
	var kode =$(this).attr("kode");
	var url =$(this).attr("url");
	swal({
		title: "Anda Yakin?",
		text: "Hapus data riwayat pendidikan!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: 'btn-danger',
		confirmButtonText: 'Ya, Delete!',
		cancelButtonText: "Tidak, Batalkan!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function (isConfirm) {
		if (isConfirm) {
			var post_data = "kode="+kode;
			$.ajax({
					url: url,
					type:"POST",
					data: post_data,
					dataType: "html",
					timeout:180000,
					success: function (result) {
						 swal("Deleted!", result, "success");
						 location.reload(true);
				},
				error : function(error) {
					alert(error);
				} 
			});        
			
		} else {
			swal("Batal", "", "error");
		}
	});
});
</script>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-scrolling-tabs/jquery.scrolling-tabs.css">
 <script src="<?php echo base_url(); ?>assets/js/jquery-scrolling-tabs/jquery.scrolling-tabs.js"></script>

 <script>
    $(document).ready(function(){
        
        $('.nav-tabs').scrollingTabs();
        
    });
 </script>