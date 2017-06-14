<?php
	$this->load->library('convert');
 	$convert = new convert();
?>
<div class="tab-pane active" id="<?php echo $TAB_ID;?>">
	
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
						  Tempat Lahir
					  </div>
					  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						  <b><?php echo isset($pegawai->TEMPAT_LAHIR_ID) ? $pegawai->TEMPAT_LAHIR_ID : ''; ?></b>
					  </div>
				  </div>
			  </div>
			 <div class="form-group col-sm-12">
				  <div class="row">
					  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						  Tanggal Lahir
					  </div>
					  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						  <b><?php echo isset($pegawai->TGL_LAHIR) ? $pegawai->TGL_LAHIR : ''; ?></b>
					  </div>
				  </div>
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
							 <b><?php echo isset($pegawai->PENDIDIKAN_ID) ? $pegawai->PENDIDIKAN_ID : ''; ?>/<?php echo isset($pegawai->TAHUN_LULUS) ? $pegawai->TAHUN_LULUS : ''; ?></b>
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
        <div class="form-group col-sm-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Jenis Jabatan
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($JENIS_JABATAN) ? $JENIS_JABATAN  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Jabatan Struktural
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($NAMA_JABATAN) ? $NAMA_JABATAN  : ""; ?></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    TMT Jabatan Struktural
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php if($pegawai->JENIS_JABATAN_ID == "1") { echo isset($pegawai->TMT_JABATAN) ? $convert->fmtDate($pegawai->TMT_JABATAN,"dd month yyyy")  : ""; } ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Jabatan Fungsional
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    TMT Jabatan Fungsional
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php if($pegawai->JENIS_JABATAN_ID == "2") { echo isset($pegawai->TMT_JABATAN) ? $convert->fmtDate($pegawai->TMT_JABATAN,"dd month yyyy")  : ""; } ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Jabatan Fungsional Umum
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b></b>
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
		  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
		  </button>
		</div>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
		
		<!-- /.table-responsive -->
	  </div>
	  <!-- /.box-body -->
	  
	  <!-- /.box-footer -->
	</div>
    <form role="form" action="#">
        
            
       
        
    </form>
</div>