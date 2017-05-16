<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/select2/select2.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/datepicker/datepicker3.css">

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
<div class='box box-primary'>
    
	<div class="box-body">
    <?php echo form_open($this->uri->uri_string(), ''); ?>
        <fieldset>
            <legend>Profile</legend>
			 <div class="control-group<?php echo form_error('PNS_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label('PNS ID', 'PNS_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='PNS_ID' type='text' class="form-control" name='PNS_ID' maxlength='32' value="<?php echo set_value('PNS_ID', isset($pegawai->PNS_ID) ? $pegawai->PNS_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('PNS_ID'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('NIP_Lama') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_NIP_Lama'), 'NIP_Lama', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NIP_Lama' type='text' class="form-control" name='NIP_Lama' maxlength='9' value="<?php echo set_value('NIP_Lama', isset($pegawai->NIP_Lama) ? $pegawai->NIP_Lama : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NIP_Lama'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Nip_Baru') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Nip_Baru'), 'Nip_Baru', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nip_Baru' type='text' class="form-control" name='Nip_Baru' maxlength='18' value="<?php echo set_value('Nip_Baru', isset($pegawai->Nip_Baru) ? $pegawai->Nip_Baru : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nip_Baru'); ?></span>
                </div>
            </div>
			 <div class="control-group<?php echo form_error('Gelar_Depan') ? ' error' : ''; ?> col-sm-2">
                <?php echo form_label(lang('pegawai_field_Gelar_Depan'), 'Gelar_Depan', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Gelar_Depan' type='text' class="form-control" name='Gelar_Depan' maxlength='11' value="<?php echo set_value('Gelar_Depan', isset($pegawai->Gelar_Depan) ? $pegawai->Gelar_Depan : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Gelar_Depan'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('Nama') ? ' error' : ''; ?> col-sm-7">
                <?php echo form_label(lang('pegawai_field_Nama'), 'Nama', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nama' type='text' class="form-control" name='Nama' maxlength='11' value="<?php echo set_value('Nama', isset($pegawai->Nama) ? $pegawai->Nama : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nama'); ?></span>
                </div>
            </div>

           

            <div class="control-group<?php echo form_error('Gelar_Blk') ? ' error' : ''; ?> col-sm-3">
                <?php echo form_label(lang('pegawai_field_Gelar_Blk'), 'Gelar_Blk', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Gelar_Blk' type='text' class="form-control" name='Gelar_Blk' maxlength='11' value="<?php echo set_value('Gelar_Blk', isset($pegawai->Gelar_Blk) ? $pegawai->Gelar_Blk : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Gelar_Blk'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Tempat_Lahir_ID') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("Tempat Lahir", 'Tempat_Lahir_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Tempat_Lahir_ID' type='text' class="form-control" name='Tempat_Lahir_ID' maxlength='11' value="<?php echo set_value('Tempat_Lahir_ID', isset($pegawai->Tempat_Lahir_ID) ? $pegawai->Tempat_Lahir_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Tempat_Lahir_ID'); ?></span>
                </div>
            </div>
			<div class="control-group col-sm-3">
				<label for="inputNama" class="control-label">Tgl Lahir</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='Tgl_Lahir'  value="<?php echo set_value('Tgl_Lahir', isset($pegawai->Tgl_Lahir) ? $pegawai->Tgl_Lahir : ''); ?>" />
					<span class='help-inline'><?php echo form_error('Tgl_Lahir'); ?></span>
				</div>
			</div> 
            <div class="control-group<?php echo form_error('Jenis_Kelamin') ? ' error' : ''; ?> col-sm-6">
                <?php echo form_label(lang('pegawai_field_Jenis_Kelamin'), 'Jenis_Kelamin', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select class="validate[required] text-input form-control" name="Jenis_Kelamin" id="Jenis_Kelamin" class="chosen-select-deselect">
						<option value="">-- Pilih  --</option>
						<option value="M" <?php if(isset($pegawai->Jenis_Kelamin))  echo  ("M"==$pegawai->Jenis_Kelamin) ? "selected" : ""; ?>> Laki-laki</option>
						<option value="F" <?php if(isset($pegawai->Jenis_Kelamin))  echo  ("F"==$pegawai->Jenis_Kelamin) ? "selected" : ""; ?>> Perempuan</option>
					</select>
                    <span class='help-inline'><?php echo form_error('Jenis_Kelamin'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Agama_ID') ? ' error' : ''; ?> col-sm-6">
                <?php echo form_label("Agama", 'Agama_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="Agama_ID" id="Agama_ID" class="form-control select2">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($agamas) && is_array($agamas) && count($agamas)):?>
						<?php foreach($agamas as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($pegawai->Agama_ID))  echo  ($pegawai->Agama_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('Agama_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Jenis_Kawin_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Jenis_Kawin_ID'), 'Jenis_Kawin_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Jenis_Kawin_ID' type='text' class="form-control" name='Jenis_Kawin_ID' maxlength='32' value="<?php echo set_value('Jenis_Kawin_ID', isset($pegawai->Jenis_Kawin_ID) ? $pegawai->Jenis_Kawin_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Jenis_Kawin_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('NIK') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_NIK'), 'NIK', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NIK' type='text' class="form-control" name='NIK' maxlength='32' value="<?php echo set_value('NIK', isset($pegawai->NIK) ? $pegawai->NIK : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NIK'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Nomor_Darurat') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Nomor_Darurat'), 'Nomor_Darurat', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nomor_Darurat' type='text' class="form-control" name='Nomor_Darurat' maxlength='32' value="<?php echo set_value('Nomor_Darurat', isset($pegawai->Nomor_Darurat) ? $pegawai->Nomor_Darurat : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nomor_Darurat'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Nomor_HP') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Nomor_HP'), 'Nomor_HP', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nomor_HP' type='text' class="form-control" name='Nomor_HP' maxlength='32' value="<?php echo set_value('Nomor_HP', isset($pegawai->Nomor_HP) ? $pegawai->Nomor_HP : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nomor_HP'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Email') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Email'), 'Email', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Email' type='text' class="form-control" name='Email' maxlength='200' value="<?php echo set_value('Email', isset($pegawai->Email) ? $pegawai->Email : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Email'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Alamat') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Alamat'), 'Alamat', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'Alamat', 'id' => 'Alamat', 'rows' => '5', 'cols' => '80', 'value' => set_value('Alamat', isset($pegawai->Alamat) ? $pegawai->Alamat : ''))); ?>
                    <span class='help-inline'><?php echo form_error('Alamat'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('NPWP_Nomor') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_NPWP_Nomor'), 'NPWP_Nomor', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NPWP_Nomor' type='text' class="form-control" name='NPWP_Nomor' maxlength='25' value="<?php echo set_value('NPWP_Nomor', isset($pegawai->NPWP_Nomor) ? $pegawai->NPWP_Nomor : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NPWP_Nomor'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('BPJS') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_BPJS'), 'BPJS', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='BPJS' type='text' class="form-control" name='BPJS' maxlength='25' value="<?php echo set_value('BPJS', isset($pegawai->BPJS) ? $pegawai->BPJS : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('BPJS'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Jenis_Pegawai_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("Jenis Pegawai", 'Jenis_Pegawai_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="Jenis_Pegawai_ID" id="Jenis_Pegawai_ID" class="form-control select2">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($jenis_pegawais) && is_array($jenis_pegawais) && count($jenis_pegawais)):?>
						<?php foreach($jenis_pegawais as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($pegawai->Jenis_Pegawai_ID))  echo  ($pegawai->Jenis_Pegawai_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('Jenis_Pegawai_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Kedudukan_Hukum_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("Kedudukan Hukum", 'Kedudukan_Hukum_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="Kedudukan_Hukum_ID" id="Kedudukan_Hukum_ID" class="form-control select2">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($kedudukan_hukums) && is_array($kedudukan_hukums) && count($kedudukan_hukums)):?>
						<?php foreach($kedudukan_hukums as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($pegawai->Kedudukan_Hukum_ID))  echo  ($pegawai->Kedudukan_Hukum_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('Kedudukan_Hukum_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Status_CPNS_PNS') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("Status CPNS/PNS", 'Status_CPNS_PNS', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select class="validate[required] text-input form-control" name="Status_CPNS_PNS" id="Status_CPNS_PNS" class="chosen-select-deselect">
						<option value="">-- Pilih  --</option>
						<option value="P" <?php if(isset($pegawai->Status_CPNS_PNS))  echo  ("P"==$pegawai->Status_CPNS_PNS) ? "selected" : ""; ?>> PNS</option>
						<option value="C" <?php if(isset($pegawai->Status_CPNS_PNS))  echo  ("C"==$pegawai->Status_CPNS_PNS) ? "selected" : ""; ?>> CPNS</option>
					</select>
                    <span class='help-inline'><?php echo form_error('Status_CPNS_PNS'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Kartu_Pegawai') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Kartu_Pegawai'), 'Kartu_Pegawai', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Kartu_Pegawai' type='text' class="form-control" name='Kartu_Pegawai' maxlength='11' value="<?php echo set_value('Kartu_Pegawai', isset($pegawai->Kartu_Pegawai) ? $pegawai->Kartu_Pegawai : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Kartu_Pegawai'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Nomor_SK_CPNS') ? ' error' : ''; ?> col-sm-3">
                <?php echo form_label(lang('pegawai_field_Nomor_SK_CPNS'), 'Nomor_SK_CPNS', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nomor_SK_CPNS' type='text' class="form-control" name='Nomor_SK_CPNS' maxlength='11' value="<?php echo set_value('Nomor_SK_CPNS', isset($pegawai->Nomor_SK_CPNS) ? $pegawai->Nomor_SK_CPNS : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nomor_SK_CPNS'); ?></span>
                </div>
            </div>

           		
            <div class="control-group col-sm-3">
				<label for="inputNama" class="control-label">SK CPNS</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='Tgl_SK_CPNS' type='text' class="form-control pull-right datepicker" name='Tgl_SK_CPNS'  value="<?php echo set_value('Tgl_SK_CPNS', isset($pegawai->Tgl_SK_CPNS) ? $pegawai->Tgl_SK_CPNS : ''); ?>" />
					<span class='help-inline'><?php echo form_error('Tgl_SK_CPNS'); ?></span>
				</div>
			</div> 
			<div class="control-group col-sm-3">
				<label for="inputNama" class="control-label">TMT CPNS</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='TMT_CPNS' type='text' class="form-control pull-right datepicker" name='TMT_CPNS'  value="<?php echo set_value('TMT_CPNS', isset($pegawai->TMT_CPNS) ? $pegawai->TMT_CPNS : ''); ?>" />
					<span class='help-inline'><?php echo form_error('TMT_CPNS'); ?></span>
				</div>
			</div> 
          	<div class="control-group col-sm-3">
				<label for="inputNama" class="control-label">TMT PNS</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  	<input id='TMT_PNS' type='text' class="form-control pull-right datepicker" name='TMT_PNS'  value="<?php echo set_value('TMT_PNS', isset($pegawai->TMT_PNS) ? $pegawai->TMT_PNS : ''); ?>" />
					<span class='help-inline'><?php echo form_error('TMT_PNS'); ?></span>
				</div>
			</div>
            <div class="control-group<?php echo form_error('Gol_Awal_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("Golongan Awal", 'Gol_Awal_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="Gol_Awal_ID" id="Gol_Awal_ID" class="form-control select2">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($golongans) && is_array($golongans) && count($golongans)):?>
						<?php foreach($golongans as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($pegawai->Gol_Awal_ID))  echo  ($pegawai->Gol_Awal_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?> | <?php echo $record->NAMA_PANGKAT; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    
                    <span class='help-inline'><?php echo form_error('Gol_Awal_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Gol_ID') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("Golongan", 'Gol_ID', array('class' => 'control-label')); ?>
                <div class='controls'>	
                	<select name="Gol_ID" id="Gol_ID" class="form-control select2">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($golongans) && is_array($golongans) && count($golongans)):?>
						<?php foreach($golongans as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($pegawai->Gol_ID))  echo  ($pegawai->Gol_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?> | <?php echo $record->NAMA_PANGKAT; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('Gol_ID'); ?></span>
                </div>
            </div>
			<div class="control-group col-sm-3">
				<label for="inputNama" class="control-label">TMT Golongan</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='TMT_Golongan'  value="<?php echo set_value('TMT_Golongan', isset($pegawai->TMT_Golongan) ? $pegawai->TMT_Golongan : ''); ?>" />
					<span class='help-inline'><?php echo form_error('TMT_Golongan'); ?></span>
				</div>
			</div> 
			
            <div class="control-group<?php echo form_error('MK_Tahun') ? ' error' : ''; ?> col-sm-6">
                <?php echo form_label("Masa Kerja Tahun", 'MK_Tahun', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='MK_Tahun' type='text' class="form-control" name='MK_Tahun' maxlength='4' value="<?php echo set_value('MK_Tahun', isset($pegawai->MK_Tahun) ? $pegawai->MK_Tahun : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('MK_Tahun'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('MK_Bulan') ? ' error' : ''; ?> col-sm-6">
                <?php echo form_label("Masa kerja Bulan", 'MK_Bulan', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='MK_Bulan' type='text' class="form-control" name='MK_Bulan' maxlength='10' value="<?php echo set_value('MK_Bulan', isset($pegawai->MK_Bulan) ? $pegawai->MK_Bulan : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('MK_Bulan'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Jenis_Jabatan_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Jenis_Jabatan_ID'), 'Jenis_Jabatan_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Jenis_Jabatan_ID' type='text' class="form-control" name='Jenis_Jabatan_ID' maxlength='21' value="<?php echo set_value('Jenis_Jabatan_ID', isset($pegawai->Jenis_Jabatan_ID) ? $pegawai->Jenis_Jabatan_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Jenis_Jabatan_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Jabatan_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Jabatan_ID'), 'Jabatan_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Jabatan_ID' type='text' class="form-control" name='Jabatan_ID' maxlength='32' value="<?php echo set_value('Jabatan_ID', isset($pegawai->Jabatan_ID) ? $pegawai->Jabatan_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Jabatan_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('TMT_Jabatan') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_TMT_Jabatan'), 'TMT_Jabatan', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='TMT_Jabatan' type='text' class="form-control" name='TMT_Jabatan'  value="<?php echo set_value('TMT_Jabatan', isset($pegawai->TMT_Jabatan) ? $pegawai->TMT_Jabatan : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('TMT_Jabatan'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Pendidkan_ID') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label(lang('pegawai_field_Pendidkan_ID'), 'Pendidkan_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="Pendidkan_ID" id="Pendidkan_ID" class="form-control select2">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($pendidikans) && is_array($pendidikans) && count($pendidikans)):?>
						<?php foreach($pendidikans as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($pegawai->Pendidkan_ID))  echo  ($pegawai->Pendidkan_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('Pendidkan_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Tahun_Lulus') ? ' error' : ''; ?> col-sm-3">
                <?php echo form_label(lang('pegawai_field_Tahun_Lulus'), 'Tahun_Lulus', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Tahun_Lulus' type='text' class="form-control" name='Tahun_Lulus' maxlength='4' value="<?php echo set_value('Tahun_Lulus', isset($pegawai->Tahun_Lulus) ? $pegawai->Tahun_Lulus : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Tahun_Lulus'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('KPKN_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_KPKN_ID'), 'KPKN_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="KPKN_ID" id="KPKN_ID" class="form-control select2">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($kpkns) && is_array($kpkns) && count($kpkns)):?>
						<?php foreach($kpkns as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($pegawai->KPKN_ID))  echo  ($pegawai->KPKN_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('KPKN_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Lokasi_Kerja_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Lokasi_Kerja_ID'), 'Lokasi_Kerja_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="Lokasi_Kerja_ID" id="Lokasi_Kerja_ID" class="form-control select2">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($lokasis) && is_array($lokasis) && count($lokasis)):?>
						<?php foreach($lokasis as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($pegawai->Lokasi_Kerja_ID))  echo  ($pegawai->Lokasi_Kerja_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('Lokasi_Kerja_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Unor_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Unor_ID'), 'Unor_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Unor_ID' type='text' class="form-control" name='Unor_ID' maxlength='32' value="<?php echo set_value('Unor_ID', isset($pegawai->Unor_ID) ? $pegawai->Unor_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Unor_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Unor_induk_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Unor_induk_ID'), 'Unor_induk_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Unor_induk_ID' type='text' class="form-control" name='Unor_induk_ID' maxlength='11' value="<?php echo set_value('Unor_induk_ID', isset($pegawai->Unor_induk_ID) ? $pegawai->Unor_induk_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Unor_induk_ID'); ?></span>
                </div>
            </div>
			<!--
            <div class="control-group<?php echo form_error('Instansi_Induk_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Instansi_Induk_ID'), 'Instansi_Induk_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Instansi_Induk_ID' type='text' class="form-control" name='Instansi_Induk_ID' maxlength='11' value="<?php echo set_value('Instansi_Induk_ID', isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Instansi_Induk_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Instansi_Kerja_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Instansi_Kerja_ID'), 'Instansi_Kerja_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Instansi_Kerja_ID' type='text' class="form-control" name='Instansi_Kerja_ID' maxlength='11' value="<?php echo set_value('Instansi_Kerja_ID', isset($pegawai->Instansi_Kerja_ID) ? $pegawai->Instansi_Kerja_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Instansi_Kerja_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Satuan_kerja_Induk_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Satuan_kerja_Induk_ID'), 'Satuan_kerja_Induk_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Satuan_kerja_Induk_ID' type='text' class="form-control" name='Satuan_kerja_Induk_ID' maxlength='11' value="<?php echo set_value('Satuan_kerja_Induk_ID', isset($pegawai->Satuan_kerja_Induk_ID) ? $pegawai->Satuan_kerja_Induk_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Satuan_kerja_Induk_ID'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Satuan_Kerja_Kerja_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Satuan_Kerja_Kerja_ID'), 'Satuan_Kerja_Kerja_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Satuan_Kerja_Kerja_ID' type='text' class="form-control" name='Satuan_Kerja_Kerja_ID' maxlength='11' value="<?php echo set_value('Satuan_Kerja_Kerja_ID', isset($pegawai->Satuan_Kerja_Kerja_ID) ? $pegawai->Satuan_Kerja_Kerja_ID : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Satuan_Kerja_Kerja_ID'); ?></span>
                </div>
            </div>
			-->
            <div class="control-group<?php echo form_error('Golongan_Darah') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label(lang('pegawai_field_Golongan_Darah'), 'Golongan_Darah', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select class="validate[required] text-input form-control" name="Golongan_Darah" id="Golongan_Darah" class="chosen-select-deselect">
						<option value="">-- Pilih  --</option>
						<option value="O" <?php if(isset($pegawai->Golongan_Darah))  echo  ("O"==$pegawai->Golongan_Darah) ? "selected" : ""; ?>>O</option>
						<option value="A" <?php if(isset($pegawai->Golongan_Darah))  echo  ("A"==$pegawai->Golongan_Darah) ? "selected" : ""; ?>>A</option>
						<option value="B" <?php if(isset($pegawai->Golongan_Darah))  echo  ("B"==$pegawai->Golongan_Darah) ? "selected" : ""; ?>>B</option>
						<option value="AB" <?php if(isset($pegawai->Golongan_Darah))  echo  ("AB"==$pegawai->Golongan_Darah) ? "selected" : ""; ?>>AB</option>
					</select>
                    <span class='help-inline'><?php echo form_error('Golongan_Darah'); ?></span>
                </div>
            </div>
        </fieldset>
        </div>
  		<div class="box-footer">
            <input type='submit' name='save' class='btn btn-primary' value="Simpan" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/kepegawaian/pegawai', lang('pegawai_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    <?php echo form_close(); ?>
</div>
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