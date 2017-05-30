<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('golongan_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($golongan->ID) ? $golongan->ID : '';

?>
<div class='admin-box'>
    <h3>golongan</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('NAMA') ? ' error' : ''; ?>">
                <?php echo form_label(lang('golongan_field_NAMA'), 'NAMA', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NAMA' type='text' name='NAMA' maxlength='255' value="<?php echo set_value('NAMA', isset($golongan->NAMA) ? $golongan->NAMA : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NAMA'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('NAMA_PANGKAT') ? ' error' : ''; ?>">
                <?php echo form_label(lang('golongan_field_NAMA_PANGKAT'), 'NAMA_PANGKAT', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='NAMA_PANGKAT' type='text' name='NAMA_PANGKAT' maxlength='255' value="<?php echo set_value('NAMA_PANGKAT', isset($golongan->NAMA_PANGKAT) ? $golongan->NAMA_PANGKAT : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('NAMA_PANGKAT'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('golongan_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/masters/golongan', lang('golongan_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>