<?php 
    $id = isset($detail_riwayat->ID) ? $detail_riwayat->ID : '';
?>
<div class='box box-warning' id="form-diklat-fungsional-add">
	<div class="box-body">
        <div class="messages">
        </div>
    <?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
        <fieldset>
            <input id='ID' type='hidden' class="form-control" name='ID' maxlength='32' value="<?php echo set_value('ID', isset($detail_riwayat->ID) ? trim($detail_riwayat->ID) : ''); ?>" />
            <input id='PNS_ID' type='hidden' class="form-control" name='PNS_ID' maxlength='32' value="<?php echo set_value('ID_PNS', isset($PNS_ID) ? trim($PNS_ID) : ''); ?>" />
           
           <div class="control-group<?php echo form_error('ID_UNOR_BARU') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label('Unit Organisasi Baru', 'Unit Organisasi Baru', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ID_UNOR_BARU" id="ID_UNOR_BARU" class="form-control">
						<?php 
                            if($selectedUnorBaru){
                                echo "<option selected value='".$selectedUnorBaru->ID."'>".$selectedUnorBaru->NAMA."</option>";
                            }
                        ?>
					</select>
                    <span class='help-inline'><?php echo form_error('ID_UNOR_BARU'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('ID_INSTANSI') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label('INSTANSI BARU', 'ID INSTANSI', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ID_INSTANSI" id="ID_INSTANSI" class="form-control">
						<?php 
                            if($selectedInstansiBaru){
                                echo "<option selected value='".$selectedInstansiBaru->ID."'>".$selectedInstansiBaru->NAMA."</option>";
                            }
                        ?>
					</select>
                    <span class='help-inline'><?php echo form_error('ID_INSTANSI'); ?></span>
                </div>
            </div>

           
           
            <div class="control-group<?php echo form_error('SK_NOMOR') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("SK NOMOR", 'SK NOMOR', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='SK_NOMOR' type='text' class="form-control" name='SK_NOMOR' maxlength='32' value="<?php echo set_value('SK_NOMOR', isset($detail_riwayat->SK_NOMOR) ? $detail_riwayat->SK_NOMOR : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('SK_NOMOR'); ?></span>
                </div>
            </div>
            <div class="control-group col-sm-3">
				<label for="inputNama" class="control-label">SK TANGGAL</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='SK_TANGGAL'  value="<?php echo set_value('SK_TANGGAL', isset($detail_riwayat->SK_TANGGAL) ? $detail_riwayat->SK_TANGGAL : ''); ?>" />
					<span class='help-inline'><?php echo form_error('SK_TANGGAL'); ?></span>
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
    $("#ID_UNOR_BARU").select2({
        placeholder: 'Cari Unit Organisasi Baru...',
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        ajax: {
            url: '<?php echo site_url("pegawai/riwayatpindahunitkerja/get_unor_ajax");?>',
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
    $("#ID_INSTANSI").select2({
        placeholder: 'Cari Data Instansi..',
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        ajax: {
            url: '<?php echo site_url("pegawai/riwayatpindahunitkerja/get_instansi_ajax");?>',
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
	$("#btnsave").click(function(){
		submitdata();
		return false; 
	});	
	$("#frma").submit(function(){
		submitdata();
		return false; 
	});	
	function submitdata(){
		
		var json_url = "<?php echo base_url() ?>pegawai/riwayatpindahunitkerja/save";
		 $.ajax({    
		 	type: "POST",
			url: json_url,
			data: $("#frm").serialize(),
            dataType: "json",
			success: function(data){ 
                if(data.success){
                    swal("Pemberitahuan!", data.msg, "success");
                    $("#modal-custom-global").trigger("sukses-tambah-riwayat-pindah_unit_kerja");
					 $("#modal-custom-global").modal("hide");
                }
                else {
                    $("#form-diklat-fungsional-add .messages").empty().append(data.msg);
                }
			}});
		return false; 
	}
</script>