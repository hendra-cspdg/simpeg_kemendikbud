
<style>
	.dt-center {
		text-align:center;
	}
</style>
<!--tab-pane-->
<div class="tab-pane" id="<?php echo $TAB_ID;?>">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-21 col-xs-12">
            <?php if ($this->auth->has_permission('DiklatStruktural.Kepegawaian.Create')) : ?>
            <a type="button" class="show-modal-custom btn btn-default btn-warning margin pull-right " href="<?php echo base_url(); ?>pegawai/diklatstruktural/add/<?php echo $PNS_ID ?>" tooltip="Tambah Riwayat Diklat">
				<i class="fa fa-plus"></i> Tambah
            </a>
            <?php endif; ?>
            <table class="table table-datatable">
            <thead>
                <tr>
                    <th width='20px' >No</th>
                    <th>Nama Diklat</th>
                    <th>Nomor</th>
                    <th width='100px' >Tanggal</th>
                    <th width='100px' >Tahun</th>
                    <th width='100px' align="center">AKSI</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                        
                </tr>
            </tfoot>
            <tbody>
               
            </tbody>
        </table>  
        </div>
        </div>
    </div>
</div>
<!--tab-pane-->


<script type="text/javascript">

	(function($){
		var $container = $("#<?php echo $TAB_ID;?>");
		var grid_daftar = $(".table-datatable",$container).DataTable({
				ordering: false,
				processing: true,
				"bFilter": false,
				"bLengthChange": false,
				serverSide: true,
				"columnDefs": [
					//{"className": "dt-center", "targets": "_all"}
					{"className": "dt-center", "targets": [0,5]}
				],
				ajax: {
					url: "<?php echo base_url() ?>pegawai/diklatstruktural/ajax_list",
					type:'POST',
					data : {
						PNS_ID:'<?php echo $PNS_ID;?>'
					}
				}
		});
		//$container.on('click','.show-modal-custom',{callableName:'sukses-tambah-riwayat-diklat',callableFn:function(){
		//	grid_daftar.ajax.reload();	
		//},parent:this},showModalX);
		$container.on('click','.show-modal-custom',function(event){
			showModalX.call(this,'sukses-tambah-riwayat-diklat-struktural',function(){
				grid_daftar.ajax.reload();
			},this);
			event.preventDefault();
		});
		$container.on('click','.show-modal',showModalX);

		$container.on('click','.btn-hapus',function(event){
			event.preventDefault();
			var kode =$(this).attr("kode");
				swal({
					title: "Anda Yakin?",
					text: "Hapus data Riwayat Diklat!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: 'btn-danger',
					confirmButtonText: 'Ya, Hapus!',
					cancelButtonText: "Tidak, Batalkan!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function (isConfirm) {
					if (isConfirm) {
						var post_data = "kode="+kode;
						$.ajax({
								url: "<?php echo base_url() ?>pegawai/diklatstruktural/delete/"+kode,
								dataType: "html",
								timeout:180000,
								success: function (result) {
									swal("Data berhasil di hapus!", result, "success");
									grid_daftar.ajax.reload();
							},
							error : function(error) {
								alert(error);
							} 
						});        
						
					} else {
						swal("Batal", "", "error");
					}
				});
		});
				
	})(jQuery);
</script>
