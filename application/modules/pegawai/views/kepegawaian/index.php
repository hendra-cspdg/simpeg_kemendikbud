
<?php
$checkSegment = $this->uri->segment(4);
$areaUrl = SITE_AREA . '/kepegawaian/pegawai';
$num_columns	= 44;
$can_delete	= $this->auth->has_permission('Pegawai.Kepegawaian.Delete');
$can_edit		= $this->auth->has_permission('Pegawai.Kepegawaian.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class="admin-box box box-primary">
	<div class="box-header">
              <h3 class="box-title">Data Pegawai</h3>
              
              <?php if ($this->auth->has_permission('Pegawai.Kepegawaian.Create')) : ?>
              <a href="<?php echo site_url($areaUrl . '/create'); ?>">
              	<button type="button" class="btn btn-default btn-warning margin pull-right "><i class="fa fa-plus"></i> Tambah</button>
			</a>
              <?php endif; ?>
            </div>
	<div class="box-body">
	<?php echo form_open($this->uri->uri_string(),"id=form_search_pegawai"); ?>
		<div class="row">
			<div class="col-md-3">
				<select class="form-control" name="searchKey">
					<option value="nama_pegawai">Nama Pegawai</option>
					<option value="nip_baru">NIP Baru</option>
					<option value="nip_lama">NIP Lama</option>
					<option style="display:none" value="nama_unit">Nama Unit</option>

				</select>
			</div>
			<div class="col-md-9">
				<input class="form-control" name="key" maxlength="200" value="" type="text">
			</div>				
		</div>
		<table class="slug-table table table-bordered table-striped table-responsive dt-responsive table-data table-hover">
				 <thead>
				 <tr><th style="width:10px">No</th>
				 <th>NIP</th><th>NAMA Pegawai</th><th>Unit Kerja</th><th width="70px">#</th></tr>
				 </thead>
				 </table>
	<?php
    echo form_close();    
    ?>
</div>
</div>


<script type="text/javascript">
$table = $(".table-data").DataTable({
	ordering: false,
	dom : "<'row'<'col-sm-6'><'col-sm-6'>>" +
	"<'row'<'col-sm-12'tr>>" +
	"<'row'<'col-sm-2'l><'col-sm-3'i><'col-sm-7'p>>",
	processing: true,
	serverSide: true,
	ajax: {
	  url: "<?php echo base_url() ?>admin/kepegawaian/pegawai/getdata",
	  type:'POST',
	  "data": function ( d ) {
			d.search['value']=  $("[name=key]").val();
			d.search['key'] = $("[name=searchKey]").val();
		}
	}
});
$("#form_search_pegawai").submit(function(){
	$table.ajax.reload(null,false);
	return false;
});


$('body').on('click','.btn-hapus',function () { 
	var kode =$(this).attr("kode");
	swal({
		title: "Anda Yakin?",
		text: "Delete data Pegawai!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: 'btn-danger',
		confirmButtonText: 'Ya, Delete!',
		cancelButtonText: "Tidak, Batalkan!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function (isConfirm) {
		if (isConfirm) {
			var post_data = "kode="+kode;
			$.ajax({
					url: "<?php echo base_url() ?>admin/kepegawaian/pegawai/deletedata",
					type:"POST",
					data: post_data,
					dataType: "html",
					timeout:180000,
					success: function (result) {
						 swal("Deleted!", result, "success");
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

</script>