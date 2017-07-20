
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/select2/select2.min.css">
<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/select2/select2.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/datepicker/datepicker3.css">
<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($persiapan_kecamatan))
{
	$persiapan_kecamatan = (array) $persiapan_kecamatan;
}
$id = isset($persiapan_kecamatan['id']) ? $persiapan_kecamatan['id'] : '';
$id_persiapan = isset($persiapan_kecamatan['id_persiapan']) ? $persiapan_kecamatan['id_persiapan'] : '';
?>
<div class="admin-box box box-primary">
<div class="box-body">
	<?php echo form_open($this->uri->uri_string(), ''); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('tahun') ? 'error' : ''; ?> col-sm-12">
				<?php echo form_label('Tahun'. lang('bf_form_label_required'), 'persiapan_kecamatan_tahun', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='persiapan_kecamatan_tahun' type='text' class="form-control" name='persiapan_kecamatan_tahun' maxlength="4" value="<?php echo set_value('persiapan_kecamatan_tahun', isset($persiapan_kecamatan['tahun']) ? $persiapan_kecamatan['tahun'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tahun'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('provinsi') ? 'error' : ''; ?> col-sm-12">
				<?php echo form_label('Provinsi', 'provinsi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="ID_PROV" id="ID_PROV" class="select2 form-control">
						<option value="">-- Pilih Provinsi --</option>
						<?php if (isset($provinsis) && is_array($provinsis) && count($provinsis)):?>
						<?php foreach($provinsis as $provinsi_record):?>
							<option value="<?php echo $provinsi_record->id?>" <?php if(isset($provinsi))  echo  ($provinsi_record->id==$provinsi) ? "selected" : ""; ?>><?php echo $provinsi_record->prov; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('provinsi'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('persiapan_kabupaten_kabupaten') ? 'error' : ''; ?> col-sm-12">
				<?php echo form_label('Kabupaten', 'persiapan_kabupaten_kabupaten', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="persiapan_kabupaten_kabupaten" id="ID_KAB" class="chosen-select-deselect form-control">
						<option value="">-- Pilih Kabupaten --</option>
						<?php if (isset($recordkabupatens) && is_array($recordkabupatens) && count($recordkabupatens)):?>
						<?php foreach($recordkabupatens as $kabupaten_record):?>
							<option value="<?php echo $kabupaten_record->id?>" <?php if(isset($kabupaten))  echo  ($kabupaten_record->id==$kabupaten) ? "selected" : ""; ?>><?php echo $kabupaten_record->kab; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('persiapan_kabupaten_kabupaten'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('persiapan_kecamatan_kecamatan') ? 'error' : ''; ?> col-sm-12">
				<?php echo form_label('Kecamatan', 'kecamatan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="persiapan_kecamatan_kecamatan" id="ID_KEC" class="chosen-select-deselect form-control">
						<option value="">-- Pilih Kecamatan --</option>
						<?php if (isset($recordkecamatans) && is_array($recordkecamatans) && count($recordkecamatans)):?>
						<?php foreach($recordkecamatans as $kecamatan_record):?>
							<option value="<?php echo $kecamatan_record->id?>" <?php if(isset($persiapan_kecamatan['kecamatan']))  echo  ($kecamatan_record->id==$persiapan_kecamatan['kecamatan']) ? "selected" : ""; ?>><?php echo $kecamatan_record->kec; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('persiapan_kecamatan_kecamatan'); ?></span>
				</div>
			</div>
			
			<div class="form-group col-sm-6">
				<label for="inputNama" class="control-label">Pertemuan Pra Pelaksanaan Konstruksi</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='pertemuan_pra_pelaksanaan' class="form-control datepicker" type='text' name='pertemuan_pra_pelaksanaan'  value="<?php echo set_value('pertemuan_pra_pelaksanaan', isset($persiapan_kecamatan['pertemuan_pra_pelaksanaan']) ? str_replace("0000-00-00","",$persiapan_kecamatan['pertemuan_pra_pelaksanaan']) : ''); ?>" />
				  	<span class='help-inline'><?php echo form_error('pertemuan_pra_pelaksanaan'); ?></span>
				</div>
			</div>
			<div class="form-group col-sm-6">
				<label for="inputNama" class="control-label">Tgl. Mulai Pelaksanaan</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='tgl_mulai_pelaksanaan' class="form-control datepicker" type='text' name='tgl_mulai_pelaksanaan'  value="<?php echo set_value('tgl_mulai_pelaksanaan', isset($persiapan_kecamatan['tgl_mulai_pelaksanaan']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_mulai_pelaksanaan']) : ''); ?>" />
				  	<span class='help-inline'><?php echo form_error('tgl_mulai_pelaksanaan'); ?></span>
				</div>
			</div>
			
			</fieldset>
			<fieldset>
				<legend>Kontrak</legend>
			<div class="control-group <?php echo form_error('no_kontrak') ? 'error' : ''; ?> col-sm-12">
				<?php echo form_label('No Kontrak Sp3', 'persiapan_kecamatan_tahun', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='no_kontrak' type='text' class="form-control" name='no_kontrak' maxlength="100" value="<?php echo set_value('no_kontrak', isset($persiapan_kecamatan['no_kontrak']) ? $persiapan_kecamatan['no_kontrak'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('no_kontrak'); ?></span>
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="inputNama" class="control-label">Tanda Tangan Kontrak SP3</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='ttd_kontrak_sp3' class="form-control pull-right datepicker" type='text' name='ttd_kontrak_sp3'  value="<?php echo set_value('ttd_kontrak_sp3', isset($persiapan_kecamatan['ttd_kontrak_sp3']) ? str_replace("0000-00-00","",$persiapan_kecamatan['ttd_kontrak_sp3']) : ''); ?>" />
				  	<span class='help-inline'><?php echo form_error('ttd_kontrak_sp3'); ?></span>
				</div>
			</div> 
			<div class="form-group col-sm-3">
				<label for="inputNama" class="control-label">Tgl Mulai Kontrak</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='tgl_kontrak' class="form-control pull-right datepicker" type='text' name='tgl_kontrak'  value="<?php echo set_value('tgl_kontrak', isset($persiapan_kecamatan['tgl_kontrak']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_kontrak']) : ''); ?>" />
				  	<span class='help-inline'><?php echo form_error('tgl_kontrak'); ?></span>
				</div>
			</div> 
			<div class="form-group col-sm-3">
				<label for="inputNama" class="control-label">Tgl Akihr Kontrak</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='tgl_akhir_kontrak' class="form-control pull-right datepicker" type='text' name='tgl_akhir_kontrak'  value="<?php echo set_value('tgl_akhir_kontrak', isset($persiapan_kecamatan['tgl_akhir_kontrak']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_akhir_kontrak']) : ''); ?>" />
				  	<span class='help-inline'><?php echo form_error('tgl_akhir_kontrak'); ?></span>
				</div>
			</div> 
			<div class="form-group col-sm-3">
				<label for="inputNama" class="control-label">Tgl SPMK</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='tgl_spmk' class="form-control pull-right datepicker" type='text' name='tgl_spmk'  value="<?php echo set_value('tgl_spmk', isset($persiapan_kecamatan['tgl_spmk']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_spmk']) : ''); ?>" />
				  	<span class='help-inline'><?php echo form_error('tgl_spmk'); ?></span>
				</div>
			</div> 
			</fieldset>
			<fieldset>
				<legend>Pencairan 1</legend>
				<div class="control-group <?php echo form_error('no_sp2d1') ? 'error' : ''; ?> col-sm-12">
					<?php echo form_label('No SP2D', 'tgl_sp2d1', array('class' => 'control-label') ); ?>
					<div class='controls'>
						<input id='no_sp2d1' type='text' class="form-control" name='no_sp2d1' maxlength="100" value="<?php echo set_value('no_sp2d1', isset($persiapan_kecamatan['no_sp2d1']) ? $persiapan_kecamatan['no_sp2d1'] : ''); ?>" />
						<span class='help-inline'><?php echo form_error('no_sp2d1'); ?></span>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputNama" class="control-label">Tgl. Penerbitan SP2D</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='tgl_sp2d1' class="form-control datepicker" type='text' name='tgl_sp2d1'  value="<?php echo set_value('tgl_sp2d1', isset($persiapan_kecamatan['tgl_sp2d1']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_sp2d1']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('tgl_sp2d1'); ?></span>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputNama" class="control-label">Tgl. Masuk Rekening BKAD</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='tgl_masukrekening1' class="form-control datepicker" type='text' name='tgl_masukrekening1'  value="<?php echo set_value('tgl_masukrekening1', isset($persiapan_kecamatan['tgl_masukrekening1']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_masukrekening1']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('tgl_masukrekening1'); ?></span>
					</div>
				</div>
			
				
				<div class="form-group col-sm-6">
					<label for="inputNama" class="control-label">Pencairan Termin I (40%) dari Bank</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='pencairan_40' class="form-control pull-right datepicker" type='text' name='pencairan_40'  value="<?php echo set_value('pencairan_40', isset($persiapan_kecamatan['pencairan_40']) ? str_replace("0000-00-00","",$persiapan_kecamatan['pencairan_40']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('pencairan_40'); ?></span>
					</div>
				</div>
			 
					<div class="form-group col-sm-6">
					<label for="inputNama" class="control-label">Pencairan Dana BPM Tahap II (30%) ke Bank</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='pencairan_30_bpm' class="form-control datepicker" type='text' name='pencairan_30_bpm'  value="<?php echo set_value('pencairan_30_bpm', isset($persiapan_kecamatan['pencairan_30_bpm']) ? str_replace("0000-00-00","",$persiapan_kecamatan['pencairan_30_bpm']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('pencairan_30_bpm'); ?></span>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Pencairan 2</legend> 
				<div class="form-group col-sm-4">
					<label for="inputNama" class="control-label">Tgl. Pengajuan Pencairan oleh BKAD</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='tgl_pengajuan_pencairan2' class="form-control datepicker" type='text' name='tgl_pengajuan_pencairan2'  value="<?php echo set_value('tgl_pengajuan_pencairan2', isset($persiapan_kecamatan['tgl_pengajuan_pencairan2']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_pengajuan_pencairan2']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('tgl_pengajuan_pencairan2'); ?></span>
					</div>
				</div>
				<div class="control-group <?php echo form_error('no_sp2d2') ? 'error' : ''; ?> col-sm-12">
					<?php echo form_label('No SP2D', 'tgl_sp2d1', array('class' => 'control-label') ); ?>
					<div class='controls'>
						<input id='no_sp2d2' type='text' class="form-control" name='no_sp2d2' maxlength="100" value="<?php echo set_value('no_sp2d2', isset($persiapan_kecamatan['no_sp2d2']) ? $persiapan_kecamatan['no_sp2d2'] : ''); ?>" />
						<span class='help-inline'><?php echo form_error('no_sp2d2'); ?></span>
					</div>
				</div>
			   <div class="form-group col-sm-6">
				   <label for="inputNama" class="control-label">Tgl. Penerbitan SP2D</label>
				   <div class="input-group date">
					 <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					 </div>
					   <input id='tgl_sp2d2' class="form-control datepicker" type='text' name='tgl_sp2d2'  value="<?php echo set_value('tgl_sp2d2', isset($persiapan_kecamatan['tgl_sp2d2']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_sp2d2']) : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('tgl_sp2d2'); ?></span>
				   </div>
			   </div>
			    <div class="form-group col-sm-6">
				   <label for="inputNama" class="control-label">Tgl. Masuk Rekening BKAD</label>
				   <div class="input-group date">
					 <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					 </div>
					   <input id='tgl_masukrekening2' class="form-control datepicker" type='text' name='tgl_masukrekening2'  value="<?php echo set_value('tgl_masukrekening2', isset($persiapan_kecamatan['tgl_masukrekening2']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_masukrekening2']) : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('tgl_masukrekening2'); ?></span>
				   </div>
			   </div>
				
			   <div class="form-group col-sm-12">
				   <label for="inputNama" class="control-label">Pencairan Tahap II (30%)</label>
				   <div class="input-group date">
					 <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					 </div>
					   <input id='pencairan_30' class="form-control datepicker" type='text' name='pencairan_30'  value="<?php echo set_value('pencairan_30', isset($persiapan_kecamatan['pencairan_30']) ? str_replace("0000-00-00","",$persiapan_kecamatan['pencairan_30']) : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('pencairan_30'); ?></span>
				   </div>
			   </div>
			
			</fieldset>
			<fieldset>
				<legend>Progress Konstruksi</legend>
				<div class="form-group col-sm-4">
				  <label for="inputNama" class="control-label">Progres Fisik 25%</label>
				  <div class="input-group date">
					<div class="input-group-addon">
					  <i class="fa fa-calendar"></i>
					</div>
					  <input id='tgl_kontruksi25' class="form-control datepicker" type='text' name='tgl_kontruksi25'  value="<?php echo set_value('tgl_kontruksi25', isset($persiapan_kecamatan['tgl_kontruksi25']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_kontruksi25']) : ''); ?>" />
					  <span class='help-inline'><?php echo form_error('tgl_kontruksi25'); ?></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label for="inputNama" class="control-label">Progres Fisik 50%</label>
				  <div class="input-group date">
					<div class="input-group-addon">
					  <i class="fa fa-calendar"></i>
					</div>
					  <input id='tgl_kontruksi50' class="form-control datepicker" type='text' name='tgl_kontruksi50'  value="<?php echo set_value('tgl_kontruksi50', isset($persiapan_kecamatan['tgl_kontruksi50']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_kontruksi50']) : ''); ?>" />
					  <span class='help-inline'><?php echo form_error('tgl_kontruksi50'); ?></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
					<label for="inputNama" class="control-label">Tgl. Status Konstruksi 100%</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='tgl_kontruksi100' class="form-control datepicker" type='text' name='tgl_kontruksi100'  value="<?php echo set_value('tgl_kontruksi100', isset($persiapan_kecamatan['tgl_kontruksi100']) ? str_replace("0000-00-00","",$persiapan_kecamatan['tgl_kontruksi100']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('tgl_kontruksi100'); ?></span>
					</div>
				</div>
				<div class="control-group <?php echo form_error('progress_all') ? 'error' : ''; ?> col-sm-12">
					<?php echo form_label('Progres Keseluruhan Konstruksi (%)', 'tgl_sp2d1', array('class' => 'control-label') ); ?>
					<div class='controls'>
						<input id='progress_all' type='text' class="form-control" name='progress_all' maxlength="100" value="<?php echo set_value('progress_all', isset($persiapan_kecamatan['progress_all']) ? $persiapan_kecamatan['progress_all'] : ''); ?>" />
						<span class='help-inline'><?php echo form_error('progress_all'); ?></span>
					</div>
				</div>
			</fieldset>	
			<fieldset>
			<legend>Koordinat Kawasan</legend>
			<div class="control-group <?php echo form_error('koordinat') ? 'error' : ''; ?> col-sm-12">
				 <?php echo form_label('Deliniasi Kawasan', 'delineasi_kawasan', array('class' => 'control-label') ); ?>
				 <div class='controls'>
					 <input id='delineasi_kawasan' type='text' class="form-control" name='delineasi_kawasan' value="<?php echo set_value('delineasi_kawasan', isset($persiapan_kecamatan['delineasi_kawasan']) ? $persiapan_kecamatan['delineasi_kawasan'] : ''); ?>" />
					 <span class='help-inline'><?php echo form_error('delineasi_kawasan'); ?></span>
				 </div>
			 
		   </div>
		</fieldset>
			<fieldset>
				<legend>Pasca Pelaksanaan</legend>
				<div class="form-group col-sm-6">
					<label for="inputNama" class="control-label">Pertemuan Kecamatan II</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='musdes2' class="form-control datepicker" type='text' name='musdes2'  value="<?php echo set_value('musdes2', isset($persiapan_kecamatan['musdes2']) ? str_replace("0000-00-00","",$persiapan_kecamatan['musdes2']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('musdes2'); ?></span>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputNama" class="control-label">Pemeriksaan Hasil Pekerjaan</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='pemeriksaan_hasil' class="form-control datepicker" type='text' name='pemeriksaan_hasil'  value="<?php echo set_value('pemeriksaan_hasil', isset($persiapan_kecamatan['pemeriksaan_hasil']) ? str_replace("0000-00-00","",$persiapan_kecamatan['pemeriksaan_hasil']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('pemeriksaan_hasil'); ?></span>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputNama" class="control-label">Serah Terima dari BKAD kepada PPK</label>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
						<input id='serah_terima_bkad' class="form-control pull-right datepicker" type='text' name='serah_terima_bkad'  value="<?php echo set_value('serah_terima_bkad', isset($persiapan_kecamatan['serah_terima_bkad']) ? str_replace("0000-00-00","",$persiapan_kecamatan['serah_terima_bkad']) : ''); ?>" />
						<span class='help-inline'><?php echo form_error('serah_terima_bkad'); ?></span>
					</div>
				</div>
			<div class="form-group col-sm-6">
				<label for="inputNama" class="control-label">Serah Terima dari PPK kepada Desa</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='serah_terima_ppk' class="form-control datepicker" type='text' name='serah_terima_ppk'  value="<?php echo set_value('serah_terima_ppk', isset($persiapan_kecamatan['serah_terima_ppk']) ? str_replace("0000-00-00","",$persiapan_kecamatan['serah_terima_ppk']) : ''); ?>" />
				  	<span class='help-inline'><?php echo form_error('serah_terima_ppk'); ?></span>
				</div>
			</div>
			
			</fieldset>
			
        	<div class="box-footer">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('persiapan_kecamatan_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/pelaksanaan/persiapan_kecamatan', lang('persiapan_kecamatan_cancel'), 'class="btn btn-warning"'); ?>
				
			
			</div>
    <?php echo form_close(); ?>
    
    	<fieldset>
		<legend>Pencairan</legend>
            <div class="col-lg-12 col-md-12 col-sm-21 col-xs-12">
            <?php if ($this->auth->has_permission('Persiapan_Kecamatan.Persiapan.Create')) : ?>
            <a type="button" class="show-modal btn btn-default btn-warning margin pull-right " href="<?php echo base_url(); ?>persiapan_kecamatan/pencairan/add/<?php echo $id_persiapan ?>" tooltip="Tambah Pencairan">
				<i class="fa fa-plus"></i> Tambah
            </a>
            <?php endif; ?>
            <table class="table table-datatable table-bordered">
            <thead>
                <tr>
                    <th width='100px' >No</th>
                    <th>Termin</th>
                    <th>Tanggal</th>
                    <th width='100px' >Jumlah</th>
                    <th width='100px' align="center">#</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                        
                </tr>
            </tfoot>
            <tbody>
               
            </tbody>
        </table>  
        </div>
    	</fieldset>
</div>
<script type="text/javascript">	  
	 
	$("#ID_PROV").change(function(){
		 
			var id_provinsi = $("#ID_PROV").val();
			$("#ID_KAB").empty().append("<option>loading...</option>"); //show loading...
			 
			var json_url = "<?php echo base_url(); ?>admin/masters/kabupaten/getbyprovinsiterpilih?id_provinsi=" + encodeURIComponent(id_provinsi);
			$.getJSON(json_url,function(data){
				$("#ID_KAB").empty(); 
				if(data==""){
					$("#ID_KAB").append("<option value=\"\">Pilih Kabupaten </option>");
				}
				else{
					$("#ID_KAB").append("<option value=\"\">-- Pilih Kabupaten --</option>");
					for(i=0; i<data.id.length; i++){
						$("#ID_KAB").append("<option value=\"" + data.id[i]  + "\">" + data.kab[i] +"</option>");
					}
				}
				
			});
			
			return false;
		}); 
	$("#ID_KAB").change(function(){
			var id_kabupaten = $("#ID_KAB").val();
			$("#ID_KEC").empty().append("<option>loading...</option>"); //show loading...
			var json_url = "<?php echo base_url(); ?>admin/masters/kecamatan/getbykabupatenterpilih?id_kabupaten=" + encodeURIComponent(id_kabupaten);
			$.getJSON(json_url,function(data){
				$("#ID_KEC").empty(); 
				if(data==""){
					$("#ID_KEC").append("<option value=\"\">Pilih Kecamatan </option>");
				}
				else{
					$("#ID_KEC").append("<option value=\"\">-- Pilih Kecamatan --</option>");
					for(i=0; i<data.id.length; i++){
						$("#ID_KEC").append("<option value=\"" + data.id[i]  + "\">" + data.kec[i] +"</option>");
					}
				}
				
			});
			
			return false;
		});
	 
</script>
<script src="<?php echo base_url(); ?>themes/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,format: 'yyyy-mm-dd'
    });
</script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>themes/admin/plugins/select2/select2.full.min.js"></script>

<script>
	 $(".select2").select2();
</script>
<script>
Dropzone.autoDiscover = true;
    var foto_upload= new Dropzone(".dropzone",{
    	 autoProcessQueue: true,
		 url: "<?php echo base_url() ?>admin/persiapan/persiapan_kecamatan/saveberkas",
		 maxFilesize: 20,
		 parallelUploads : 10,
		 method:"post",
		 acceptedFiles:".pdf,.xls,.xlsx,.ppt,.pptx,.doc,.docx,.zip,.rar",
		 paramName:"userfile",
		 dictDefaultMessage:"<img src='<?php echo base_url(); ?>assets/images/dropico.png' width='50px'/><br>Drop dokumen disini atau klik area ini untuk browse file",
		 dictInvalidFileType:"Type file ini tidak dizinkan",
		 addRemoveLinks:true,
		 init: function () {
			   this.on("success", function (file,response) {
			   		var data_n=JSON.parse(response);
			   		$("#dokumen_pendukung").val(data_n.namafile);
				   swal("Upload selesai, silahkan lanjutkan simpan data", "Warning");
			   });
		   }
		 });
		foto_upload.on("sending",function(a,b,c){
			 a.token=Math.random();
			 c.append('token_foto',a.token);
			 c.append('id_log',"");
			 console.log('mengirim');           
		 });
	foto_upload.processQueue();
</script>
<script type="text/javascript">
var grid_daftar = "";
	(function($){
		 
		grid_daftar = $(".table-datatable").DataTable({
				ordering: false,
				processing: true,
				"bFilter": false,
				"bLengthChange": false,
				serverSide: true,
				"columnDefs": [
					//{"className": "dt-center", "targets": "_all"}
					{"className": "dt-center", "targets": [0,1,2,3]}
				],
				ajax: {
					url: "<?php echo base_url() ?>persiapan_kecamatan/pencairan/ajax_list",
					type:'POST',
					data : {
						id_kawasan:'<?php echo $id_persiapan;?>'
					}
				}
		});
	$(".box-body").on('click','.show-modal-custom',function(event){
			
				grid_daftar.ajax.reload();
			
			event.preventDefault();
		});
	$(".box-body").on('click','.btn-hapus',function(event){
			event.preventDefault();
			var kode =$(this).attr("kode");
				swal({
					title: "Anda Yakin?",
					text: "Hapus data !",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: 'btn-danger',
					confirmButtonText: 'Ya, Hapus!',
					cancelButtonText: "Tidak, Batalkan!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function (isConfirm) {
					if (isConfirm) {
						var post_data = "kode="+kode;
						$.ajax({
								url: "<?php echo base_url() ?>persiapan_kecamatan/pencairan/delete/"+kode,
								dataType: "html",
								timeout:180000,
								success: function (result) {
									swal("Data berhasil di hapus!", result, "success");
									grid_daftar.ajax.reload();
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
		
	})(jQuery);
</script>