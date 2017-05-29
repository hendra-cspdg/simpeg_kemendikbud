<?php 
    $id = isset($detail_riwayat->ID) ? $detail_riwayat->ID : '';
?>
<div class='box box-warning' id="form-pendidikan-add">
	<div class="box-body">
        <div class="messages">
        </div>
    <?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
        <fieldset>
             <input id='id_data' type='hidden' class="form-control" name='id_data' maxlength='32' value="<?php echo set_value('id_data', isset($id) ? trim($id) : ''); ?>" />
            <input id='PNS_ID' type='hidden' class="form-control" name='PNS_ID' maxlength='32' value="<?php echo set_value('PNS_ID', isset($PNS_ID) ? trim($PNS_ID) : ''); ?>" />
            
            <div class="control-group<?php echo form_error('TINGKAT_PENDIDIKAN_ID') ? ' error' : ''; ?> col-sm-3">
                <?php echo form_label('Jenjang Pendidikan', 'TINGKAT_PENDIDIKAN_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="TINGKAT_PENDIDIKAN_ID" id="TINGKAT_PENDIDIKAN_ID" class="form-control">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($tk_pendidikans) && is_array($tk_pendidikans) && count($tk_pendidikans)):?>
						<?php foreach($tk_pendidikans as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($detail_riwayat->TINGKAT_PENDIDIKAN_ID))  echo  ($detail_riwayat->TINGKAT_PENDIDIKAN_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('TINGKAT_PENDIDIKAN_ID'); ?></span>
                </div>
            </div>
           <div class="control-group<?php echo form_error('NAMA_SEKOLAH') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("NAMA Sekolah", 'NAMA_SEKOLAH', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NAMA_SEKOLAH' type='text' class="form-control" name='NAMA_SEKOLAH' maxlength='200' value="<?php echo set_value('NAMA_SEKOLAH', isset($detail_riwayat->NAMA_Sekolah) ? $detail_riwayat->NAMA_Sekolah : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NAMA_SEKOLAH'); ?></span>
                </div>
            </div>
            
			<div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">Tgl Lulus</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='TANGGAL_LULUS'  value="<?php echo set_value('TANGGAL_LULUS', isset($detail_riwayat->TANGGAL_LULUS) ? $detail_riwayat->TANGGAL_LULUS : ''); ?>" />
					<span class='help-inline'><?php echo form_error('TANGGAL_LULUS'); ?></span>
				</div>
			</div> 
            <div class="control-group<?php echo form_error('TAHUN_LULUS') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("Tahun Lulus", 'GELAR_BELAKANG', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='TAHUN_LULUS' type='text' class="form-control" name='TAHUN_LULUS' maxlength='11' value="<?php echo set_value('TAHUN_LULUS', isset($detail_riwayat->TAHUN_LULUS) ? $detail_riwayat->TAHUN_LULUS : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('TAHUN_LULUS'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('NOMOR_IJASAH') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("Nomor Ijasah", 'NOMOR_IJASAH', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NOMOR_IJASAH' type='text' class="form-control" name='NOMOR_IJASAH' maxlength='32' value="<?php echo set_value('NOMOR_IJASAH', isset($detail_riwayat->NOMOR_IJASAH) ? $detail_riwayat->NOMOR_IJASAH : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NOMOR_IJASAH'); ?></span>
                </div>
            </div>

            
             <div class="control-group<?php echo form_error('GELAR_DEPAN') ? ' error' : ''; ?> col-sm-6">
                <?php echo form_label('Gelar Depan', 'GELAR_DEPAN', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='GELAR_DEPAN' type='text' class="form-control" name='GELAR_DEPAN' maxlength='11' value="<?php echo set_value('GELAR_DEPAN', isset($detail_riwayat->GELAR_DEPAN) ? $detail_riwayat->GELAR_DEPAN : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('GELAR_DEPAN'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('GELAR_BELAKANG') ? ' error' : ''; ?> col-sm-6">
                <?php echo form_label("Gelar Belakang", 'GELAR_BELAKANG', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='GELAR_BELAKANG' type='text' class="form-control" name='GELAR_BELAKANG' maxlength='11' value="<?php echo set_value('GELAR_BELAKANG', isset($detail_riwayat->GELAR_BELAKANG) ? $detail_riwayat->GELAR_BELAKANG : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('GELAR_BELAKANG'); ?></span>
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
    var form = $("#form-pendidikan-add");
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,format: 'yyyy-mm-dd'
    }).on("input change", function (e) {
        var date = $(this).datepicker('getDate');
        if(date)$("[name=TAHUN_LULUS]",form).val(date.getFullYear());
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
		
		var json_url = "<?php echo base_url() ?>pegawai/riwayatpendidikan/save";
		 $.ajax({    
		 	type: "POST",
			url: json_url,
			data: $("#frm").serialize(),
            dataType: "json",
			success: function(data){ 
                if(data.success){
                    swal("Pemberitahuan!", data.msg, "success");
                    $("#modal-custom-global").trigger("sukses-tambah-riwayat-pendidikan");
					$("#modal-custom-global").modal("hide");
                }
                else {
                    $("#form-pendidikan-add .messages").empty().append(data.msg);
                }
			}});
		return false; 
	}
</script>