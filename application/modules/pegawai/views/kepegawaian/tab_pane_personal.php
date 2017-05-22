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
                
			  <div class="form-group">
				  <div class="row">
					  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						  Tempat Lahir
					  </div>
					  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						  <b><?php echo isset($pegawai->Tempat_Lahir_ID) ? $pegawai->Tempat_Lahir_ID : ''; ?></b>
					  </div>
				  </div>
			  </div>
			 <div class="form-group">
				  <div class="row">
					  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						  Tanggal Lahir
					  </div>
					  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						  <b><?php echo isset($pegawai->Tgl_Lahir) ? $pegawai->Tgl_Lahir : ''; ?></b>
					  </div>
				  </div>
			 <div class="form-group">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Email
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->Email) ? $pegawai->Email : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Alamat
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->Alamat) ? $pegawai->Alamat : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 NO HP
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->Nomor_HP) ? $pegawai->Nomor_HP : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Jenis Pegawai
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->Jenis_Pegawai_ID) ? $pegawai->Jenis_Pegawai_ID : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Kedudukan PNS
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->Kedudukan_Hukum_ID) ? $pegawai->Kedudukan_Hukum_ID : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Status Pegawai
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->Status_CPNS_PNS) ? $pegawai->Status_CPNS_PNS : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 TMT PNS
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->TMT_PNS) ? $pegawai->TMT_PNS : ''; ?></b>
					 </div>
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						 Pendidikan Terakhir/ Tahun Lulus
					 </div>
					 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							 <b><?php echo isset($pegawai->Pendidikan_ID) ? $pegawai->Pendidikan_ID : ''; ?>/<?php echo isset($pegawai->Tahun_Lulus) ? $pegawai->Tahun_Lulus : ''; ?></b>
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
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Instansi Kerja
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Satuan Kerja Induk
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Satuan kerja
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Kanreg
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Kanreg
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-9">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Unit Organisasi
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-3">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Eselon
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Unit Organisasi Induk
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Jenis Jabatan
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-9">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Jabatan Struktural
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-3">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    TMT Jabatan Struktural
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-9">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Jabatan Fungsional
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-3">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    TMT Jabatan Fungsional
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-9">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Jabatan Fungsional Umum
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
         <div class="form-group col-sm-3">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    TMT
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-9">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Lokasi Kerja
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-3">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Golongan Ruang Awal
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-3">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Golongan Ruang Akhir
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    TMT Golongan
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-4">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Gaji Pokok
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-8">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Masa Kerja (Tahun/Bulan)
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?>/</b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    No.SPMT
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Tgl SPMT1
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    KPPN
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    KTUA
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Instansi_Induk_ID) ? $pegawai->Instansi_Induk_ID  : ""; ?></b>
                </div>
            </div>
        </div>
        
		<div class="form-group">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Status Kepegawaian
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Status_CPNS_PNS) ? $pegawai->Status_CPNS_PNS == "P" ? "PNS" : "" : ''; ?>   (<?php echo $this->convert->fmtDate($pegawai->TMT_PNS,"dd month yyyy"); ?>)</b>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Golongan
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <b><?php echo isset($pegawai->Gol_ID) ? $pegawai->Gol_ID : ''; ?></b>
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
		<h3 class="box-title">Data Lainny</h3>

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