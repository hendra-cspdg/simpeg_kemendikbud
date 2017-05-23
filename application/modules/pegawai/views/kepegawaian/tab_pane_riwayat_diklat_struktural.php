
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
            <a href="<?php echo base_url(); ?>pegawai/diklatstruktural/add/<?php echo $PNS_ID ?>" class="show-modal" tooltip="Tambah Riwayat Diklat">
                <button type="button" class="btn btn-default btn-warning margin pull-right "><i class="fa fa-plus"></i> Tambah</button>
            </a>
            <?php endif; ?>
            <table class="table table-datatable">
            <thead>
                <tr>
                    <th width='100px' >No</th>
                    <th>Nama Diklat</th>
                    <th width='100px' >Tanggal</th>
                    <th width='100px' >Tahun</th>
                    <th width='100px' align="center">#</th>
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
function showModalX(event) {
	$('.perhatian').fadeOut(300, function(){});
	  event.preventDefault();
	  var currentBtn = $(this);
	  var title = currentBtn.attr("tooltip");
	  //alert(currentBtn.attr("href"));
	  $.ajax({
	  url: currentBtn.attr("href"),
	  type: 'post',
	  beforeSend: function (xhr) {
		  $("#loading-all").show();
	  },
	  success: function (content, status, xhr) {
		  var json = null;
		  var is_json = true;
		  try {
		  	json = $.parseJSON(content);
		  } catch (err) {
		  	is_json = false;
		  }
		  if (is_json == false) {
		  	$("#modal-body").html(content);
		  	$("#myModalLabel").html(title);
		  	$("#modal-global").modal('show');
		  	$("#loading-all").hide();
		  } else {
		  	alert("Error");
		  }
	  }
	  }).fail(function (data, status) {
	  if (status == "error") {
		  alert("Error");
	  } else if (status == "timeout") {
		  alert("Error");
	  } else if (status == "parsererror") {
		  alert("Error");
	  }
	  });
  }
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
					{"className": "dt-center", "targets": [0,2,3,4]}
				],
				ajax: {
					url: "<?php echo base_url() ?>pegawai/diklatstruktural/ajax_list",
					type:'POST',
					data : {
						PNS_ID:'<?php echo $PNS_ID;?>'
					}
				}
		});
		$container.on('click','.show-modal',showModalX);
		$container.on('click','.btn-hapus',function(){
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
