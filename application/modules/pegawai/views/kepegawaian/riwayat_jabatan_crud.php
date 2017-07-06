<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/select2/select2.min.css">

<?php 
    $id = isset($detail_riwayat->ID) ? $detail_riwayat->ID : '';
?>
<div class='box box-warning' id="form-riwayat-jabatan-add">
	<div class="box-body">
        <div class="messages">
        </div>
    <?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
        <fieldset>
            <input id='ID' type='hidden' class="form-control" name='ID' maxlength='32' value="<?php echo set_value('ID', isset($detail_riwayat->ID) ? trim($detail_riwayat->ID) : ''); ?>" />
            <input id='PNS_ID' type='hidden' class="form-control" name='PNS_ID' maxlength='32' value="<?php echo set_value('PNS_ID', isset($PNS_ID) ? trim($PNS_ID) : ''); ?>" />
           <div class="control-group col-sm-12">
				<label for="inputNAMA" class="control-label">UNOR</label>
				<div class='controls'>
                    <select id="ID_UNOR" name="ID_UNOR" width="100%" class=" col-md-10 format-control"></select>
                </div>
			</div> 
           <div class="control-group<?php echo form_error('GOLONGAN') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label('Jenis', 'Jenis Jabatan', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ID_JENIS_JABATAN" id="ID_JENIS_JABATAN" class="form-control">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($jenis_jabatans) && is_array($jenis_jabatans) && count($jenis_jabatans)):?>
						<?php foreach($jenis_jabatans as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($detail_riwayat->ID_JENIS_JABATAN))  echo  ($detail_riwayat->ID_JENIS_JABATAN==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('ID_JENIS_JABATAN'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('ID_JABATAN') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label('JABATAN', 'ID_JABATAN', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ID_JABATAN" id="ID_JABATAN" class="form-control select2  col-sm-12" width="100%">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($jabatans) && is_array($jabatans) && count($jabatans)):?>
						<?php foreach($jabatans as $record):?>
							<option value="<?php echo $record->KODE_JABATAN?>" <?php if(isset($detail_riwayat->ID_JABATAN))  echo  (trim($detail_riwayat->ID_JABATAN)==trim($record->KODE_JABATAN)) ? "selected" : ""; ?>><?php echo $record->NAMA_JABATAN; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('ID_JABATAN'); ?></span>
                </div>
            </div>            
			<div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">TMT</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='TMT_JABATAN'  value="<?php echo set_value('TMT_JABATAN', isset($detail_riwayat->TMT_JABATAN) ? $detail_riwayat->TMT_JABATAN : ''); ?>" />
					<span class='help-inline'><?php echo form_error('TMT_JABATAN'); ?></span>
				</div>
			</div> 
            
            <div class="control-group<?php echo form_error('NOMOR_SK') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("SK NOMOR", 'SK NOMOR', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NOMOR_SK' type='text' class="form-control" name='NOMOR_SK' maxlength='32' value="<?php echo set_value('NOMOR_SK', isset($detail_riwayat->NOMOR_SK) ? $detail_riwayat->NOMOR_SK : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NOMOR_SK'); ?></span>
                </div>
            </div>
            <div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">SK TANGGAL</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='TANGGAL_SK'  value="<?php echo set_value('TANGGAL_SK', isset($detail_riwayat->TANGGAL_SK) ? $detail_riwayat->TANGGAL_SK : ''); ?>" />
					<span class='help-inline'><?php echo form_error('TANGGAL_SK'); ?></span>
				</div>
			</div>
			<div class="control-group<?php echo form_error('ID_SATUAN_KERJA') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label('SATUAN KERJA', 'ID_SATUAN_KERJA', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ID_SATUAN_KERJA" id="ID_SATUAN_KERJA" class="form-control select2  col-sm-12" width="100%">
						<option value="">-- Silahkan Pilih --</option>
						<?php if (isset($recsatker) && is_array($recsatker) && count($recsatker)):?>
						<?php foreach($recsatker as $record):?>
							<option value="<?php echo $record->ID?>" <?php if(isset($detail_riwayat->ID_SATUAN_KERJA))  echo  (trim($detail_riwayat->ID_SATUAN_KERJA)==trim($record->KODE_JABATAN)) ? "selected" : ""; ?>><?php echo $record->NAMA_UNOR; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                    <span class='help-inline'><?php echo form_error('ID_SATUAN_KERJA'); ?></span>
                </div>
            </div>            
			<div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">TMT PELANTIKAN</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='TMT_PELANTIKAN'  value="<?php echo set_value('TMT_PELANTIKAN', isset($detail_riwayat->TMT_PELANTIKAN) ? $detail_riwayat->TMT_PELANTIKAN : ''); ?>" />
					<span class='help-inline'><?php echo form_error('TMT_PELANTIKAN'); ?></span>
				</div>
			</div> 
			<div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">JABATAN AKTIF?</label>
				<div class='controls'>
                    <input id='IS_ACTIVE' type='checkbox' name='IS_ACTIVE' value="1" <?php echo $detail_riwayat->IS_ACTIVE == "1" ? "checked" : ""; ?> />
                    <span class='help-inline'><?php echo form_error('IS_ACTIVE'); ?></span>
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
	 $(".select2").select2({width: '100%'});
</script>
<script>
	$("#ID_UNOR").select2({
			placeholder: 'Cari Unit Kerja...',
			width: '100%',
			minimumInputLength: 3,
			allowClear: true,
			ajax: {
				url: '<?php echo site_url("pegawai/duk/ajax_unit_list");?>',
				dataType: 'json',
				data: function(params) {
					return {
						term: params.term || '',
						page: params.page || 1
					}
				},
				cache: true
			}
	});
	$('#ID_JENIS_JABATAN').change(function() {
		var valuejenisjabatan = $('#ID_JENIS_JABATAN').val();
			$("#ID_JABATAN").empty().append("<option>loading...</option>"); //show loading...
			 
			var json_url = "<?php echo base_url(); ?>admin/masters/ref_jabatan/getbyjenis?jenis=" + encodeURIComponent(valuejenisjabatan);
			//alert(json_url);
			$.getJSON(json_url,function(data){
				$("#ID_JABATAN").empty(); 
				if(data==""){
					$("#ID_JABATAN").append("<option value=\"\">Silahkan Pilih </option>");
				}
				else{
					$("#ID_JABATAN").append("<option value=\"\">Silahkan Pilih</option>");
					for(i=0; i<data.id.length; i++){
						$("#ID_JABATAN").append("<option value=\"" + data.id[i]  + "\">" + data.nama[i] +"</option>");
					}
				}
				
			});
			$("#ID_JABATAN").select2("updateResults");
			return false;
	});
    var form = $("#form-riwayat-jabatan-add");
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
	$("#frmA").submit(function(){
		submitdata();
		return false; 
	});	
	function submitdata(){
		
		var json_url = "<?php echo base_url() ?>pegawai/riwayatjabatan/save";
		 $.ajax({    
		 	type: "POST",
			url: json_url,
			data: $("#frm").serialize(),
            dataType: "json",
			success: function(data){ 
                if(data.success){
                    swal("Pemberitahuan!", data.msg, "success");
                    $("#modal-custom-global").trigger("sukses-tambah-riwayat-jabatan");
					 $("#modal-custom-global").modal("hide");
                }
                else {
                    $("#form-riwayat-jabatan-add .messages").empty().append(data.msg);
                }
			}});
		return false; 
	}
</script>