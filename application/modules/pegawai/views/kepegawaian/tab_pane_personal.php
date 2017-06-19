<?php
	$this->load->library('convert');
 	$convert = new convert();
?>
<div class="tab-pane active" id="<?php echo $TAB_ID;?>">
	<form role="form" action="#" id="frmprofile">
	<input id='ID' type='hidden' class="form-control" name='ID' maxlength='25' value="<?php echo set_value('ID', isset($pegawai->ID) ? $pegawai->ID : ''); ?>" />
	<div class="box box-info">
            <div class="box-header no-border">
              <h3 class="box-title">Data Pribadi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
			  <div class="form-group col-sm-12">
				  <div class="row">
					  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						  Tempat/Tanggal Lahir
					  </div>
					  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						  <b><?php echo isset($pegawai->TEMPAT_LAHIR) ? $pegawai->TEMPAT_LAHIR : ''; ?></b>/
						  <b><?php echo isset($pegawai->TGL_LAHIR) ? $convert->fmtDate($pegawai->TGL_LAHIR,"dd month yyyy") : 'TGL_LAHIR'; ?></b>
					  </div>
				  </div>
			  </div>
			 <div class="form-group col-sm-12">
				
			 <div class="form-group col-sm-12">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 EMAIL
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->EMAIL) ? $pegawai->EMAIL : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group col-sm-12">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 ALAMAT
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->ALAMAT) ? $pegawai->ALAMAT : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group col-sm-12">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 NO HP
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->NOMOR_HP) ? $pegawai->NOMOR_HP : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group col-sm-12">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Jenis Pegawai
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->JENIS_PEGAWAI) ? $pegawai->JENIS_PEGAWAI : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group col-sm-12">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Kedudukan PNS
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->KEDUDUKAN_HUKUM) ? $pegawai->KEDUDUKAN_HUKUM : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group col-sm-6">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Status Pegawai
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-12 col-xs-8">
							 <b><?php echo $pegawai->STATUS_CPNS_PNS == "P" ? "PNS": ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group col-sm-6">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 TMT PNS
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->TMT_PNS) ? $convert->fmtDate($pegawai->TMT_PNS,"dd month yyyy"): ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group col-sm-12">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Pendidikan Terakhir/ Tahun Lulus
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->PENDIDIKAN) ? $pegawai->PENDIDIKAN : ''; ?>/<?php echo isset($pegawai->TAHUN_LULUS) ? $pegawai->TAHUN_LULUS : ''; ?></b>
					 </div>
				 </div>
			 </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer -->
          </div>
    </div>
	<div class="box box-info collapsed-box"">
	  <div class="box-header with-border">
		<h3 class="box-title">Posisi & Jabatan</h3>

		<div class="box-tools pull-right">
		  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
		  </button>
		</div>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
	  <!--
	  	<div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Instansi Induk
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->INSTANSI_INDUK_ID) ? $pegawai->INSTANSI_INDUK_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Instansi Kerja
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->INSTANSI_KERJA_ID) ? $pegawai->INSTANSI_KERJA_ID  : ""; ?></b>
                </div>
            </div>
        </div>
       
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Satuan Kerja Induk
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->INSTANSI_KERJA_INDUK_ID) ? $pegawai->INSTANSI_KERJA_INDUK_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Satuan kerja
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->INSTANSI_KERJA_KERJA_ID) ? $pegawai->INSTANSI_KERJA_KERJA_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Kanreg
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
        
         <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Kanreg
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
         
        <div class="form-group col-sm-9">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Unit Organisasi
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-3">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Eselon
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Unit Organisasi Induk
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
        -->
        <div class="form-group col-sm-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                    Jenis Jabatan
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-8">
                    <b><?php echo isset($pegawai->JENIS_JABATAN_NAMA) ? $pegawai->JENIS_JABATAN_NAMA  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                    Jabatan Struktural
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-8">
                    <b><?php if($pegawai->JENIS_JABATAN_ID == "1") { echo isset($NAMA_JABATAN) ? $NAMA_JABATAN  : ""; } ?></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-4">
                    TMT
                </div>
                <div class="col-lg-8 col-md-6 col-sm-8 col-xs-8">
                    <b><?php if($pegawai->JENIS_JABATAN_ID == "1") { echo isset($pegawai->TMT_JABATAN) ? $convert->fmtDate($pegawai->TMT_JABATAN,"dd month yyyy")  : ""; } ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                    JFT
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-8">
                    <b><?php if($pegawai->JENIS_JABATAN_ID == "2") { echo isset($NAMA_JABATAN) ? $NAMA_JABATAN  : ""; } ?></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                    TMT
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-8">
                    <b><?php if($pegawai->JENIS_JABATAN_ID == "2") { echo isset($pegawai->TMT_JABATAN) ? $convert->fmtDate($pegawai->TMT_JABATAN,"dd month yyyy")  : ""; } ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    JFU
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php if($pegawai->JENIS_JABATAN_ID == "4") { echo isset($NAMA_JABATAN) ? $NAMA_JABATAN  : ""; } ?></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    TMT
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php if($pegawai->JENIS_JABATAN_ID == "4") { echo isset($pegawai->TMT_JABATAN) ? $convert->fmtDate($pegawai->TMT_JABATAN,"dd month yyyy")  : ""; } ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Lokasi Kerja
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->LOKASI_KERJA) ? $pegawai->LOKASI_KERJA  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-5">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Golongan Ruang Awal
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($GOLONGAN_AWAL) ? $GOLONGAN_AWAL  : "-"; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-5">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Golongan Ruang Terakhir
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($GOLONGAN_AKHIR) ? $GOLONGAN_AKHIR  : "-"; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-2">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    TMT Golongan
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->TMT_GOLONGAN) ? $convert->fmtDate($pegawai->TMT_GOLONGAN ,"dd month yyyy") : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Gaji Pokok
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Masa Kerja (Tahun/Bulan)
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->MK_TAHUN) ? $pegawai->MK_TAHUN  : ""; ?>/<?php echo isset($pegawai->MK_BULAN) ? $pegawai->MK_BULAN  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    No.SPMT
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Tgl SPMT1
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    KPPN
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->KPPN_ID) ? $pegawai->KPPN_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    KTUA
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->KTUA_ID) ? $pegawai->KTUA_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        
		<div class="form-group">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Status Kepegawaian
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->STATUS_CPNS_PNS) ? $pegawai->STATUS_CPNS_PNS == "P" ? "PNS" : "" : ''; ?>   (<?php echo $this->convert->fmtDate($pegawai->TMT_PNS,"dd month yyyy"); ?>)</b>
                </div>
            </div>
        </div>
         
		<!-- /.table-responsive -->
	  </div>
	  <!-- /.box-body -->
	  
	  <!-- /.box-footer -->
	</div>
	<div class="box box-info collapsed-box"">
	  <div class="box-header with-border">
		<h3 class="box-title">Data Lainnya</h3>

		<div class="box-tools pull-right">
			<?php if ($this->auth->has_permission('Pegawai.Kepegawaian.Updatemandiri')) : ?>
			<input type='button' name='save' id="btnsaveprofile" class='btn btn-warning' value="Simpan" />
			<?PHP endif; ?>
		  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
		  </button>
		</div>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
			   <div class="control-group<?php echo form_error('JENIS_KAWIN_ID') ? ' error' : ''; ?> col-sm-12">
				   <?php echo form_label(lang('pegawai_field_JENIS_KAWIN_ID'), 'JENIS_KAWIN_ID', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <select name="JENIS_KAWIN_ID" id="JENIS_KAWIN_ID" class="form-control select2">
						   <option value="">-- Silahkan Pilih --</option>
						   <?php if (isset($jenis_kawins) && is_array($jenis_kawins) && count($jenis_kawins)):?>
						   <?php foreach($jenis_kawins as $record):?>
							   <option value="<?php echo $record->ID?>" <?php if(isset($pegawai->JENIS_KAWIN_ID))  echo  ($pegawai->JENIS_KAWIN_ID==$record->ID) ? "selected" : ""; ?>><?php echo $record->NAMA; ?></option>
							   <?php endforeach;?>
						   <?php endif;?>
					   </select>
					   <span class='help-inline'><?php echo form_error('JENIS_KAWIN_ID'); ?></span>
				   </div>
			   </div>
			   <div class="control-group<?php echo form_error('NO_SURAT_DOKTER') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label("NO SURAT KETERANGAN SEHAT DOKTER", 'NO_SURAT_DOKTER', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <input id='NO_SURAT_DOKTER' type='text' class="form-control" name='NO_SURAT_DOKTER' maxlength='25' value="<?php echo set_value('NO_SURAT_DOKTER', isset($pegawai->NO_SURAT_DOKTER) ? $pegawai->NO_SURAT_DOKTER : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('NO_SURAT_DOKTER'); ?></span>
				   </div>
			   </div>
			   <div class="control-group col-sm-6">
				   <label for="inputNAMA" class="control-label">TANGGAL</label>
				   <div class="input-group date">
					 <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					 </div>
					   <input id='TGL_SURAT_DOKTER' type='text' class="form-control pull-right datepicker" name='TGL_SURAT_DOKTER' maxlength='25' value="<?php echo set_value('TGL_SURAT_DOKTER', isset($pegawai->TGL_SURAT_DOKTER) ? $pegawai->TGL_SURAT_DOKTER : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('TGL_SURAT_DOKTER'); ?></span>
				   </div>
			   </div> 
			   <div class="control-group<?php echo form_error('NO_BEBAS_NARKOBA') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label("NO SURAT BEBAS NARKOBA", 'NO_BEBAS_NARKOBA', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <input id='NO_BEBAS_NARKOBA' type='text' class="form-control" name='NO_BEBAS_NARKOBA' maxlength='25' value="<?php echo set_value('NO_BEBAS_NARKOBA', isset($pegawai->NO_BEBAS_NARKOBA) ? $pegawai->NO_BEBAS_NARKOBA : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('NO_BEBAS_NARKOBA'); ?></span>
				   </div>
			   </div>
			   <div class="control-group col-sm-6">
				   <label for="inputNAMA" class="control-label">TANGGAL</label>
				   <div class="input-group date">
					 <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					 </div>
					   <input id='TGL_BEBAS_NARKOBA' type='text' class="form-control pull-right datepicker" name='TGL_BEBAS_NARKOBA' maxlength='25' value="<?php echo set_value('TGL_BEBAS_NARKOBA', isset($pegawai->TGL_BEBAS_NARKOBA) ? $pegawai->TGL_BEBAS_NARKOBA : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('TGL_BEBAS_NARKOBA'); ?></span>
				   </div>
			   </div> 
			   <div class="control-group<?php echo form_error('NO_CATATAN_POLISI') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label("NO CATATAN KEPOLISIAN", 'NO_CATATAN_POLISI', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <input id='NO_CATATAN_POLISI' type='text' class="form-control" name='NO_CATATAN_POLISI' maxlength='25' value="<?php echo set_value('NO_CATATAN_POLISI', isset($pegawai->NO_CATATAN_POLISI) ? $pegawai->NO_CATATAN_POLISI : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('NO_CATATAN_POLISI'); ?></span>
				   </div>
			   </div>
			   <div class="control-group col-sm-6">
				   <label for="inputNAMA" class="control-label">TANGGAL</label>
				   <div class="input-group date">
					 <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					 </div>
					   <input id='TGL_CATATAN_POLISI' type='text' class="form-control pull-right datepicker" name='TGL_CATATAN_POLISI' maxlength='25' value="<?php echo set_value('TGL_CATATAN_POLISI', isset($pegawai->TGL_CATATAN_POLISI) ? $pegawai->TGL_CATATAN_POLISI : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('TGL_CATATAN_POLISI'); ?></span>
				   </div>
			   </div> 
			   <div class="control-group<?php echo form_error('AKTE_KELAHIRAN') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label("AKTE KELAHIRAN", 'AKTE_KELAHIRAN', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <input id='AKTE_KELAHIRAN' type='text' class="form-control" name='AKTE_KELAHIRAN' maxlength='25' value="<?php echo set_value('AKTE_KELAHIRAN', isset($pegawai->AKTE_KELAHIRAN) ? $pegawai->AKTE_KELAHIRAN : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('AKTE_KELAHIRAN'); ?></span>
				   </div>
			   </div>
			   <div class="control-group<?php echo form_error('STATUS_HIDUP') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label("STATUS HIDUP", 'STATUS_HIDUP', array('class' => 'control-label')); ?>
				   <div class='controls'>
					<select class="validate[required] text-input form-control" name="STATUS_HIDUP" id="STATUS_HIDUP" class="chosen-select-deselect">
						 <option value="">-- Pilih  --</option>
						 <option value="Hidup" <?php if(isset($pegawai->STATUS_HIDUP))  echo  ("Hidup"==TRIM($pegawai->STATUS_HIDUP)) ? "selected" : ""; ?>>Hidup</option>
						 <option value="Meninggal" <?php if(isset($pegawai->STATUS_HIDUP))  echo  ("Meninggal"== TRIM($pegawai->STATUS_HIDUP)) ? "selected" : ""; ?>>Meninggal</option>
					 </select>
				   </div>
			   </div>
				<div class="control-group<?php echo form_error('AKTE_MENINGGAL') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label("AKTE MENINGGAL", 'AKTE_MENINGGAL', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <input id='AKTE_MENINGGAL' type='text' class="form-control" name='AKTE_MENINGGAL' maxlength='25' value="<?php echo set_value('AKTE_MENINGGAL', isset($pegawai->AKTE_MENINGGAL) ? $pegawai->AKTE_MENINGGAL : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('AKTE_MENINGGAL'); ?></span>
				   </div>
			   </div>
			   <div class="control-group col-sm-6">
				   <label for="inputNAMA" class="control-label">TANGGAL</label>
				   <div class="input-group date">
					 <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					 </div>
					   <input id='TGL_MENINGGAL' type='text' class="form-control pull-right datepicker" name='TGL_MENINGGAL' maxlength='25' value="<?php echo set_value('TGL_MENINGGAL', isset($pegawai->TGL_MENINGGAL) ? $pegawai->TGL_MENINGGAL : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('TGL_MENINGGAL'); ?></span>
				   </div>
			   </div> 
				<div class="control-group<?php echo form_error('BPJS') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label(lang('pegawai_field_BPJS'), 'BPJS', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <input id='BPJS' type='text' class="form-control" name='BPJS' maxlength='25' value="<?php echo set_value('BPJS', isset($pegawai->BPJS) ? $pegawai->BPJS : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('BPJS'); ?></span>
				   </div>
			   </div>
			   <div class="control-group<?php echo form_error('NO_TASPEN') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label("NO TASPEN", 'NO_TASPEN', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <input id='NO_TASPEN' type='text' class="form-control" name='NO_TASPEN' maxlength='50' value="<?php echo set_value('NO_TASPEN', isset($pegawai->NO_TASPEN) ? $pegawai->NO_TASPEN : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('NO_TASPEN'); ?></span>
				   </div>
			   </div>
			   <div class="control-group<?php echo form_error('NPWP') ? ' error' : ''; ?> col-sm-6">
				   <?php echo form_label(lang('pegawai_field_NPWP'), 'NPWP', array('class' => 'control-label')); ?>
				   <div class='controls'>
					   <input id='NPWP' type='text' class="form-control" name='NPWP' maxlength='25' value="<?php echo set_value('NPWP', isset($pegawai->NPWP) ? $pegawai->NPWP : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('NPWP'); ?></span>
				   </div>
			   </div>
			   <div class="control-group col-sm-6">
				   <label for="inputNAMA" class="control-label">TGL NPWP</label>
				   <div class="input-group date">
					 <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					 </div>
					   <input id='TGL_NPWP' type='text' class="form-control pull-right datepicker" name='TGL_NPWP' maxlength='25' value="<?php echo set_value('TGL_NPWP', isset($pegawai->TGL_NPWP) ? $pegawai->TGL_NPWP : ''); ?>" />
					   <span class='help-inline'><?php echo form_error('TGL_NPWP'); ?></span>
				   </div>
			   </div> 
		<!-- /.table-responsive -->
	  </div>
	  <!-- /.box-body -->
	  
	  <!-- /.box-footer -->
	</div>        
    </form>
</div>
<script>
	$("#btnsaveprofile").click(function(){
		submitdata();
		return false; 
	});	
	 
	function submitdata(){
		
		var json_url = "<?php echo base_url() ?>admin/kepegawaian/pegawai/updatemandiri";
		 $.ajax({    
		 	type: "post",
			url: json_url,
			data: $("#frmprofile").serialize(),
            dataType: "json",
			success: function(data){ 
                if(data.success){
                    swal("Pemberitahuan!", data.msg, "success");
                }
                else {
                    $(".messages").empty().append(data.msg);
                }
			}});
		return false; 
	}
</script>