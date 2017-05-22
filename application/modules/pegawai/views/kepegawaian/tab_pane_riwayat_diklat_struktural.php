
<!--tab-pane-->
<div class="tab-pane" id="<?php echo $TAB_ID;?>">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-21 col-xs-12">
            <?php if ($this->auth->has_permission('DiklatStruktural.Kepegawaian.Create')) : ?>
            <a href="<?php echo base_url(); ?>pegawai/diklatstruktural/add/<?php echo $PNS_ID ?>" class="show-modal" tooltip="Tambah Riwayat Diklat">
                <button type="button" class="btn btn-default btn-warning margin pull-right "><i class="fa fa-plus"></i> Tambah</button>
            </a>
            <?php endif; ?>
            <table class="table table-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Diklat</th>
                    <th>Tanggal</th>
                    <th>Tahun</th>
                    <th>#</th>
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

	$(document).ready(function(){
			var grid_daftar = $("#<?php echo $TAB_ID;?> .table-datatable").DataTable({
				ordering: false,
				processing: true,
				serverSide: true,
				ajax: {
					url: "<?php echo base_url() ?>pegawai/diklatstruktural/ajax_list",
					type:'POST',
					data : {
						PNS_ID:'<?php echo $PNS_ID;?>'
					}
				}
			});

			$('body').on('click','.btn-hapus',function () { 
				var kode =$(this).attr("kode");
				swal({
					title: "Anda Yakin?",
					text: "Hapus data Agama!",
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
								url: "<?php echo base_url() ?>admin/masters/agama/delete",
								type:"POST",
								data: post_data,
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

	});
</script>
