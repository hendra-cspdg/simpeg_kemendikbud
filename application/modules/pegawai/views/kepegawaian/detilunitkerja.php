<?php 
    $id = isset($detail_riwayat->ID) ? $detail_riwayat->ID : '';
?>
<div class='box box-warning' id="form-diklat-fungsional-add">
	<div class="box-body">
        <div class="messages">
        </div>
    <?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
        <fieldset>
            <input id='ID' type='hidden' readonly class="form-control" name='ID' maxlength='32' value="<?php echo set_value('ID', isset($detail_riwayat->ID) ? trim($detail_riwayat->ID) : ''); ?>" />
            <input id='PNS_ID' type='hidden' readonly class="form-control" name='PNS_ID' maxlength='32' value="<?php echo set_value('PNS_ID', isset($PNS_ID) ? trim($PNS_ID) : ''); ?>" />
           
           <div class="control-group<?php echo form_error('ID_UNOR_BARU') ? ' error' : ''; ?> col-sm-12">
                <?php echo form_label('Unit Organisasi Baru', 'Unit Organisasi Baru', array('class' => 'control-label')); ?>
                <div class='controls'>
                	<select name="ID_UNOR_BARU" id="ID_UNOR_BARU" readonly class="form-control">
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
                	<select name="ID_INSTANSI" id="ID_INSTANSI" readonly class="form-control">
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
                    <input id='SK_NOMOR' type='text' readonly class="form-control" name='SK_NOMOR' maxlength='32' value="<?php echo set_value('SK_NOMOR', isset($detail_riwayat->SK_NOMOR) ? $detail_riwayat->SK_NOMOR : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('SK_NOMOR'); ?></span>
                </div>
            </div>
            <div class="control-group col-sm-3">
				<label for="inputNAMA" class="control-label">SK TANGGAL</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
					<input type='text' class="form-control pull-right datepicker" name='SK_TANGGAL'  value="<?php echo set_value('SK_TANGGAL', isset($detail_riwayat->SK_TANGGAL) ? $detail_riwayat->SK_TANGGAL : ''); ?>" />
					<span class='help-inline'><?php echo form_error('SK_TANGGAL'); ?></span>
				</div>
			</div> 
			
        </div>
  		 
    <?php echo form_close(); ?>
</div>
<script src="<?php echo base_url(); ?>themes/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
 