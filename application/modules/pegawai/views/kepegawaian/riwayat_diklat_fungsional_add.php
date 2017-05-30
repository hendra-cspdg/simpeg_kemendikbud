<?php 
    $id = isset($detail_riwayat->ID) ? $detail_riwayat->ID : '';
?>
<div class='box box-warning' id="form-diklat-fungsional-add">
	<div class="box-body">
        <div class="messages">
        </div>
    <?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
        <fieldset>
            <input id='DIKLAT_FUNGSIONAL_ID' type='hidden' class="form-control" name='DIKLAT_FUNGSIONAL_ID' maxlength='32' value="<?php echo set_value('DIKLAT_FUNGSIONAL_ID', isset($detail_riwayat->DIKLAT_FUNGSIONAL_ID) ? trim($detail_riwayat->DIKLAT_FUNGSIONAL_ID) : ''); ?>" />
            <input id='PNS_ID' type='hidden' class="form-control" name='PNS_ID' maxlength='32' value="<?php echo set_value('PNS_ID', isset($PNS_ID) ? trim($PNS_ID) : ''); ?>" />
           
            <div class="control-group<?php echo form_error('JENIS_DIKLAT') ? ' error' : ''; ?> col-sm-3">
                <?php echo form_label('NAMA', 'NAMA', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="JENIS_DIKLAT" id="JENIS_DIKLAT" class="form-control">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($jenis_diklats) && is_array($jenis_diklats) && count($jenis_diklats)):?>
						<?php foreach($jenis_diklats as $record):?>
							<option value="<?php echo $record->NAMA?>" <?php if(isset($detail_riwayat->JENIS_DIKLAT))  echo  ($detail_riwayat->JENIS_DIKLAT==$record->NAMA) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('JENIS_DIKLAT'); ?></span>
                </div>
            </div>            
			<div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">TANGGAL KURSUS</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='TANGGAL_KURSUS'  value="<?php echo set_value('TANGGAL_KURSUS', isset($detail_riwayat->TANGGAL_KURSUS) ? $detail_riwayat->TANGGAL_KURSUS : ''); ?>" />
					<span class='help-inline'><?php echo form_error('TANGGAL_KURSUS'); ?></span>
				</div>
			</div> 
            <div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">TAHUN</label>
				<div class="input-group date">
					<input type='text' class="form-control pull-right " name='TAHUN'  value="<?php echo set_value('TAHUN', isset($detail_riwayat->TAHUN) ? $detail_riwayat->TAHUN : ''); ?>" />
					<span class='help-inline'><?php echo form_error('Tgl'); ?></span>
				</div>
			</div> 
			<div class="control-group<?php echo form_error('NAMA_KURSUS') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("NAMA KURSUS", 'NAMA KURSUS', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NAMA_KURSUS' type='text' class="form-control" name='NAMA_KURSUS' maxlength='32' value="<?php echo set_value('NAMA_KURSUS', isset($detail_riwayat->NAMA_KURSUS) ? $detail_riwayat->NAMA_KURSUS : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NAMA_KURSUS'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('NOMOR_SERTIPIKAT') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("NOMOR SERTIPIKAT", 'NOMOR SERTIPIKAT', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NOMOR_SERTIPIKAT' type='text' class="form-control" name='NOMOR_SERTIPIKAT' maxlength='32' value="<?php echo set_value('NOMOR_SERTIPIKAT', isset($detail_riwayat->NOMOR_SERTIPIKAT) ? $detail_riwayat->NOMOR_SERTIPIKAT : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NOMOR_SERTIPIKAT'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('INSTITUSI_PENYELENGGARA') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("INSTITUSI PENYELENGGARA", 'INSTITUSI PENYELENGGARA', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='INSTITUSI_PENYELENGGARA' type='text' class="form-control" name='INSTITUSI_PENYELENGGARA' maxlength='32' value="<?php echo set_value('INSTITUSI_PENYELENGGARA', isset($detail_riwayat->INSTITUSI_PENYELENGGARA) ? $detail_riwayat->INSTITUSI_PENYELENGGARA : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('INSTITUSI_PENYELENGGARA'); ?></span>
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
    var form = $("#form-diklat-fungsional-add");
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,format: 'yyyy-mm-dd'
    }).on("input change", function (e) {
        var date = $(this).datepicker('getDate');
        if(date)$("[name=TAHUN]",form).val(date.getFullYear());
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
		
		var json_url = "<?php echo base_url() ?>pegawai/diklatfungsional/save";
		 $.ajax({    
		 	type: "POST",
			url: json_url,
			data: $("#frm").serialize(),
            dataType: "json",
			success: function(data){ 
                if(data.success){
                    swal("Pemberitahuan!", data.msg, "success");
                    $("#modal-custom-global").trigger("sukses-tambah-riwayat-diklat-fungsional");
					 $("#modal-custom-global").modal("hide");
                }
                else {
                    $("#form-diklat-fungsional-add .messages").empty().append(data.msg);
                }
			}});
		return false; 
	}
</script>