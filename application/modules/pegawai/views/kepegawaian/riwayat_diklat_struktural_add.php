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

$id = isset($rwt_pendidikan->ID) ? $rwt_pendidikan->ID : '';

?>
<div class='box box-warning'>
    
	<div class="box-body">
    <?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
        <fieldset>
            <input id='id_data' type='hidden' class="form-control" name='id_data' maxlength='32' value="<?php echo set_value('id_data', isset($id) ? trim($id) : ''); ?>" />
            <input id='PNS_ID' type='hidden' class="form-control" name='PNS_ID' maxlength='32' value="<?php echo set_value('PNS_ID', isset($PNS_ID) ? trim($PNS_ID) : ''); ?>" />
            
            <div class="control-group<?php echo form_error('Pendidkan_ID') ? ' error' : ''; ?> col-sm-3">
                <?php echo form_label(lang('pegawai_field_Pendidkan_ID'), 'Pendidkan_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="Pendidikan_ID" id="Pendidikan_ID" class="form-control">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($pendidikans) && is_array($pendidikans) && count($pendidikans)):?>
						<?php foreach($pendidikans as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($rwt_pendidikan->Pendidikan_ID))  echo  ($rwt_pendidikan->Pendidikan_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('Pendidkan_ID'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('Nama') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("-", 'Nama', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nama' required type='text' class="form-control" name='Nama' maxlength='11' value="<?php echo set_value('Nama', isset($rwt_pendidikan->Nama) ? $rwt_pendidikan->Nama : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nama'); ?></span>
                </div>
            </div>
            
			<div class="control-group col-sm-3">
				<label for="inputNama" class="control-label">Tgl Lulus</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='Tanggal_Lulus'  value="<?php echo set_value('Tanggal_Lulus', isset($rwt_pendidikan->Tanggal_Lulus) ? $rwt_pendidikan->Tanggal_Lulus : ''); ?>" />
					<span class='help-inline'><?php echo form_error('Tanggal_Lulus'); ?></span>
				</div>
			</div> 
            <div class="control-group<?php echo form_error('Tahun_Lulus') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("Tahun Lulus", 'Gelar_Blk', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Tahun_Lulus' type='text' class="form-control" name='Tahun_Lulus' maxlength='11' value="<?php echo set_value('Tahun_Lulus', isset($rwt_pendidikan->Tahun_Lulus) ? $rwt_pendidikan->Tahun_Lulus : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Tahun_Lulus'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Nomor_Ijasah') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("Nomor Ijasah", 'Nomor_Ijasah', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nomor_Ijasah' type='text' class="form-control" name='Nomor_Ijasah' maxlength='32' value="<?php echo set_value('Nomor_Ijasah', isset($rwt_pendidikan->Nomor_Ijasah) ? $rwt_pendidikan->Nomor_Ijasah : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nomor_Ijasah'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('NAMA_DIKLAT') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("Nama Diklat", 'NAMA_DIKLAT', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NAMA_DIKLAT' type='text' class="form-control" name='NAMA_DIKLAT' maxlength='200' value="<?php echo set_value('NAMA_DIKLAT', isset($rwt_pendidikan->NAMA_DIKLAT) ? $rwt_pendidikan->NAMA_DIKLAT : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NAMA_DIKLAT'); ?></span>
                </div>
            </div>
            
        </div>
  		<div class="box-footer">
            <input type='submit' name='save' id="btnsave" class='btn btn-primary' value="Simpan Data" /> 
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
<script>
	$("#btnsave").click(function(){
		submitdata();
		return false; 
	});	
	$("#frma").submit(function(){
		submitdata();
		return false; 
	});	
	function submitdata(){
		var valNama = $("#Nama_Sekolah").val();
		if(valNama == ""){
			$("#valNama").focus();	
		   	swal("Silahkan masukan Nama Sekolah", "Warning");
		   	return false;
	   	}
		var json_url = "<?php echo base_url() ?>pegawai/diklatstruktural/save";
		 $.ajax({    
		 	type: "POST",
			url: json_url,
			data: $("#frm").serialize(),
			success: function(data){ 
				swal(data, "Warning");
				
			}});
		return false; 
	}
</script>