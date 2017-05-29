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
          
          <div class="control-group<?php echo form_error('JABATAN_TIPE') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label('JENIS JABATAN', 'JENIS JABATAN', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="JABATAN_TIPE" id="JABATAN_TIPE" class="form-control">
						<?php 
                            foreach($jenis_jabatans as $record){
                                echo "<option value='".$record->ID."'>$record->NAMA</option> ";
                            }
                        ?>
					</select>
                    <span class='help-inline'><?php echo form_error('JABATAN_TIPE'); ?></span>
                </div>
            </div>
           <div class="control-group<?php echo form_error('ATASAN_LANGSUNG_PNS_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label('ATASAN LANGSUNG PNS ID', 'ATASAN LANGSUNG PNS ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ATASAN_LANGSUNG_PNS_ID" id="ATASAN_LANGSUNG_PNS_ID" class="form-control">
						<?php 
                            if($selectedAtasan){
                                echo "<option selected value='".$selectedUnorBaru->ID."'>".$selectedUnorBaru->NAMA."</option>";
                            }
                        ?>
					</select>
                    <span class='help-inline'><?php echo form_error('ATASAN_LANGSUNG_PNS_ID'); ?></span>
                </div>
            </div>
           <div class="control-group<?php echo form_error('ATASAN_ATASAN_LANGSUNG_PNS_ID') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label('ATASAN ATASAN LANGSUNG PNS ID', 'ATASAN ATASANLANGSUNG PNS ID', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ATASAN_ATASAN_LANGSUNG_PNS_ID" id="ATASAN_ATASAN_LANGSUNG_PNS_ID" class="form-control">
						<?php 
                            if($selectedAtasanAtasan){
                                echo "<option selected value='".$selectedUnorBaru->ID."'>".$selectedUnorBaru->NAMA."</option>";
                            }
                        ?>
					</select>
                    <span class='help-inline'><?php echo form_error('ATASAN_ATASAN_LANGSUNG_PNS_ID'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('NILAI_SKP') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("NILAI SKP", 'NILAI SKP', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NILAI_SKP' type='text' class="form-control" name='NILAI_SKP' maxlength='32' value="<?php echo set_value('NILAI_PPK', isset($detail_riwayat->NILAI_SKP) ? $detail_riwayat->NILAI_SKP : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NILAI_SKP'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('PERILAKU_KOMITMEN') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("PERILAKU KOMITMEN", 'PERILAKU KOMITMEN', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='PERILAKU_KOMITMEN' type='text' class="form-control" name='PERILAKU_KOMITMEN' maxlength='32' value="<?php echo set_value('PERILAKU_KOMITMEN', isset($detail_riwayat->NILAI_PPK) ? $detail_riwayat->PERILAKU_KOMITMEN : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('PERILAKU_KOMITMEN'); ?></span>
                </div>
            </div>
             <div class="control-group<?php echo form_error('PERILAKU_INTEGRITAS') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("PERILAKU INTEGRITAS", 'PERILAKU INTEGRITAS', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='PERILAKU_INTEGRITAS' type='text' class="form-control" name='PERILAKU_INTEGRITAS' maxlength='32' value="<?php echo set_value('PERILAKU_INTEGRITAS', isset($detail_riwayat->PERILAKU_INTEGRITAS) ? $detail_riwayat->PERILAKU_INTEGRITAS : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('PERILAKU_INTEGRITAS'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('PERILAKU_DISIPLIN') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("PERILAKU DISIPLIN", 'PERILAKU DISIPLIN', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='PERILAKU_DISIPLIN' type='text' class="form-control" name='PERILAKU_DISIPLIN' maxlength='32' value="<?php echo set_value('NILAI_PPK', isset($detail_riwayat->NILAI_PPK) ? $detail_riwayat->NILAI_PPK : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('PERILAKU_DISIPLIN'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('PERILAKU_KERJASAMA') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("PERILAKU KERJASAMA", 'PERILAKU KERJASAMA', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='PERILAKU_KERJASAMA' type='text' class="form-control" name='PERILAKU_KERJASAMA' maxlength='32' value="<?php echo set_value('NILAI_PPK', isset($detail_riwayat->NILAI_PPK) ? $detail_riwayat->NILAI_PPK : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('PERILAKU_KERJASAMA'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('PERILAKU_ORIENTASI_PELAYANAN') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("PERILAKU ORIENTASI PELAYANAN", 'PERILAKU ORIENTASI PELAYANAN', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='PERILAKU_ORIENTASI_PELAYANAN' type='text' class="form-control" name='PERILAKU_ORIENTASI_PELAYANAN' maxlength='32' value="<?php echo set_value('NILAI_PPK', isset($detail_riwayat->NILAI_PPK) ? $detail_riwayat->NILAI_PPK : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('PERILAKU_ORIENTASI_PELAYANAN'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('PERILAKU_KEPEMIMPINAN') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("PERILAKU KEPEMIMPINAN", 'PERILAKU KEPEMIMPINAN', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='PERILAKU_KEPEMIMPINAN' type='text' class="form-control" name='PERILAKU_KEPEMIMPINAN' maxlength='32' value="<?php echo set_value('NILAI_PPK', isset($detail_riwayat->PERILAKU_KEPEMIMPINAN) ? $detail_riwayat->PERILAKU_KEPEMIMPINAN : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('PERILAKU_KEPEMIMPINAN'); ?></span>
                </div>
            </div>
             <div class="control-group<?php echo form_error('NILAI_PERILAKU_AKHIR') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("PERILAKU ORIENTASI PELAYANAN", 'PERILAKU ORIENTASI PELAYANAN', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NILAI_PERILAKU_AKHIR' type='text' class="form-control" name='NILAI_PERILAKU_AKHIR' maxlength='32' value="<?php echo set_value('NILAI_PPK', isset($detail_riwayat->NILAI_PPK) ? $detail_riwayat->NILAI_PPK : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NILAI_PERILAKU_AKHIR'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('NILAI_PPK') ? ' error' : ''; ?> col-sm-9">
                <?php echo form_label("NILAI PPK", 'NILAI PPK', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NILAI_PPK' type='text' class="form-control" name='NILAI_PPK' maxlength='32' value="<?php echo set_value('NILAI_PPK', isset($detail_riwayat->NILAI_PPK) ? $detail_riwayat->NILAI_PPK : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NILAI_PPK'); ?></span>
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
    $("#ATASAN_LANGSUNG_PNS_ID").select2({
        placeholder: 'Cari Atasan Langsung...',
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        ajax: {
            url: '<?php echo site_url("pegawai/riwayatprestasikerja/get_atasan_langsung_ajax");?>',
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
    $("#ATASAN_ATASAN_LANGSUNG_PNS_ID").select2({
        placeholder: 'Cari Atasan Atasan Langsung...',
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        ajax: {
            url: '<?php echo site_url("pegawai/riwayatprestasikerja/get_atasan_langsung_ajax");?>',
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
            url: '<?php echo site_url("pegawai/riwayatprestasikerja/get_instansi_ajax");?>',
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
		
		var json_url = "<?php echo base_url() ?>pegawai/riwayatprestasikerja/save";
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