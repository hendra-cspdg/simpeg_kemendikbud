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
            
            <div class="control-group<?php echo form_error('Tingkat_Pendidikan_ID') ? ' error' : ''; ?> col-sm-3">
                <?php echo form_label('Jenjang Pendidikan', 'Tingkat_Pendidikan_ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="Tingkat_Pendidikan_ID" id="Tingkat_Pendidikan_ID" class="form-control">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($tk_pendidikans) && is_array($tk_pendidikans) && count($tk_pendidikans)):?>
						<?php foreach($tk_pendidikans as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($detail_riwayat->Tingkat_Pendidikan_ID))  echo  ($detail_riwayat->Tingkat_Pendidikan_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('Tingkat_Pendidikan_ID'); ?></span>
                </div>
            </div>
           <div class="control-group<?php echo form_error('Nama_Sekolah') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("Nama Sekolah", 'Nama_Sekolah', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nama_Sekolah' type='text' class="form-control" name='Nama_Sekolah' maxlength='200' value="<?php echo set_value('Nama_Sekolah', isset($detail_riwayat->Nama_Sekolah) ? $detail_riwayat->Nama_Sekolah : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nama_Sekolah'); ?></span>
                </div>
            </div>
            
			<div class="control-group col-sm-3">
				<label for="inputNama" class="control-label">Tgl Lulus</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='Tanggal_Lulus'  value="<?php echo set_value('Tanggal_Lulus', isset($detail_riwayat->Tanggal_Lulus) ? $detail_riwayat->Tanggal_Lulus : ''); ?>" />
					<span class='help-inline'><?php echo form_error('Tanggal_Lulus'); ?></span>
				</div>
			</div> 
            <div class="control-group<?php echo form_error('Tahun_Lulus') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("Tahun Lulus", 'Gelar_Belakang', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Tahun_Lulus' type='text' class="form-control" name='Tahun_Lulus' maxlength='11' value="<?php echo set_value('Tahun_Lulus', isset($detail_riwayat->Tahun_Lulus) ? $detail_riwayat->Tahun_Lulus : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Tahun_Lulus'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Nomor_Ijasah') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("Nomor Ijasah", 'Nomor_Ijasah', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Nomor_Ijasah' type='text' class="form-control" name='Nomor_Ijasah' maxlength='32' value="<?php echo set_value('Nomor_Ijasah', isset($detail_riwayat->Nomor_Ijasah) ? $detail_riwayat->Nomor_Ijasah : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Nomor_Ijasah'); ?></span>
                </div>
            </div>

            
             <div class="control-group<?php echo form_error('Gelar_Depan') ? ' error' : ''; ?> col-sm-6">
                <?php echo form_label('Gelar Depan', 'Gelar_Depan', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Gelar_Depan' type='text' class="form-control" name='Gelar_Depan' maxlength='11' value="<?php echo set_value('Gelar_Depan', isset($detail_riwayat->Gelar_Depan) ? $detail_riwayat->Gelar_Depan : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Gelar_Depan'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('Gelar_Belakang') ? ' error' : ''; ?> col-sm-6">
                <?php echo form_label("Gelar Belakang", 'Gelar_Belakang', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Gelar_Belakang' type='text' class="form-control" name='Gelar_Belakang' maxlength='11' value="<?php echo set_value('Gelar_Belakang', isset($detail_riwayat->Gelar_Belakang) ? $detail_riwayat->Gelar_Belakang : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Gelar_Belakang'); ?></span>
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
        if(date)$("[name=Tahun_Lulus]",form).val(date.getFullYear());
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