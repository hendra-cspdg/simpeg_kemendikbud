<?php 
    $id = isset($detail_riwayat->ID) ? $detail_riwayat->ID : '';
?>
<div class='box box-warning' id="form-diklat-struktural-add">
	<div class="box-body">
        <div class="messages">
        </div>
    <?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
        <fieldset>
            <input id='id_data' type='hidden' class="form-control" name='id_data' maxlength='32' value="<?php echo set_value('id_data', isset($id) ? trim($id) : ''); ?>" />
            <input id='ID_PNS' type='hidden' class="form-control" name='ID_PNS' maxlength='32' value="<?php echo set_value('ID_PNS', isset($PNS_ID) ? trim($PNS_ID) : ''); ?>" />
            <input nama='NIP_PNS' type='hidden' nama="">
            
            <div class="control-group<?php echo form_error('ID_DIKLAT') ? ' error' : ''; ?> col-sm-3">
                <?php echo form_label('NAMA', 'NAMA', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ID_DIKLAT" id="ID_DIKLAT" class="form-control">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($jenis_diklats) && is_array($jenis_diklats) && count($jenis_diklats)):?>
						<?php foreach($jenis_diklats as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($detail_riwayat->ID_DIKLAT))  echo  ($detail_riwayat->ID_DIKLAT==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('PENDIDIKAN_ID'); ?></span>
                </div>
            </div>            
			<div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">TANGGAL</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='TANGGAL'  value="<?php echo set_value('TANGGAL', isset($detail_riwayat->TANGGAL) ? $detail_riwayat->TANGGAL : ''); ?>" />
					<span class='help-inline'><?php echo form_error('Tgl'); ?></span>
				</div>
			</div> 
            <div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">TAHUN</label>
				<div class="input-group date">
					<input type='text' class="form-control pull-right " name='TAHUN'  value="<?php echo set_value('TAHUN', isset($detail_riwayat->TAHUN) ? $detail_riwayat->TAHUN : ''); ?>" />
					<span class='help-inline'><?php echo form_error('Tgl'); ?></span>
				</div>
			</div> 

            <div class="control-group<?php echo form_error('NOMOR') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("NOMOR", 'NOMOR', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NOMOR' type='text' class="form-control" name='NOMOR' maxlength='32' value="<?php echo set_value('NOMOR', isset($detail_riwayat->NOMOR) ? $detail_riwayat->NOMOR : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NOMOR'); ?></span>
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
    var form = $("#form-diklat-struktural-add");
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
		
		var json_url = "<?php echo base_url() ?>pegawai/diklatstruktural/save";
		 $.ajax({    
		 	type: "POST",
			url: json_url,
			data: $("#frm").serialize(),
            dataType: "json",
			success: function(data){ 
                if(data.success){
                    swal("Pemberitahuan!", data.msg, "success");
                    $("#modal-custom-global").trigger("sukses-tambah-riwayat-diklat-struktural");
					 $("#modal-custom-global").modal("hide");
                }
                else {
                    $("#form-diklat-struktural-add .messages").empty().append(data.msg);
                }
			}});
		return false; 
	}
</script>