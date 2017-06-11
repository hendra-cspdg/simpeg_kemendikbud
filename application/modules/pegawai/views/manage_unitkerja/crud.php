<?php 
    $id = isset($detail_riwayat->ID) ? $detail_riwayat->ID : '';
?>
<div class='box box-warning' id="form-pendidikan-add">
	<div class="box-body">
        <div class="messages">
        </div>
    <?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
        <fieldset>
            <input id='ID' type='hidden' class="form-control" name='ID' maxlength='32' value="<?php echo set_value('ID', isset($ID) ? trim($ID) : ''); ?>" />
            
            <div class="control-group<?php echo form_error('NAMA_UNOR') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label("NAMA UNOR", 'NAMA_UNOR', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NAMA_UNOR' type='text' class="form-control" name='NAMA_UNOR'  value="<?php echo set_value('NAMA_UNOR', isset($data->NAMA_UNOR) ? $data->NAMA_UNOR : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NAMA_UNOR'); ?></span>
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
		
		var json_url = "<?php echo base_url() ?>pegawai/manage_unitkerja/save";
		 $.ajax({    
		 	type: "POST",
			url: json_url,
			data: $("#frm").serialize(),
            dataType: "json",
			success: function(data){ 
                if(data.success){
                    swal("Pemberitahuan!", data.msg, "success");
                    $("#modal-custom-global").trigger("sukses-crud-unitkerja");
					$("#modal-custom-global").modal("hide");
                }
                else {
                    $("#form-pendidikan-add .messages").empty().append(data.msg);
                }
			}});
		return false; 
	}
</script>