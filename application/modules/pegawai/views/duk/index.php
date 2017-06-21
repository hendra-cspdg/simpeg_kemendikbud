<?php 
	$TAB_ID = "DUK_CONTAINER";
?>
<style>
	.dt-center {
		text-align:center;
	}
</style>
<!--tab-pane-->
<div id="<?=$TAB_ID ?>" class="admin-box box box-primary">
	<div class="box-body">	
		<div class="form-group">
			<div class="row">
				<div class="col-md-10">
					<select id="unit_id" width="100%" class="format-control"></select>
				</div>
				<div class="col-md-2">
					<a type="button" class="show-modal-custom btn btn-default btn-warning margin pull-right " href="<?php echo base_url(); ?>pegawai/diklatfungsional/add/<?php echo $PNS_ID ?>" tooltip="Tambah Riwayat Diklat">
						<i class="fa fa-peint"></i> Cetak
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table id="duk_table" class="table table-data">
						<thead>
							<th class="bordertopbottom" width="35" valign="top" align="center"> No Urut </th>
							<th class="bordertop" width="183" align="center"> NAMA</th>
							<th class="bordertop" width="79" align="center"> PANGKAT/GOL </th>
							<th class="bordertop" width="200" align="center"> NAMA JABATAN </th>
							<th class="bordertop" width="76" align="center"> MASA KERJA </th>
							<th class="bordertop" width="111" align="center"> TMT CPNS </th>
							<th class="bordertop" width="111" align="center"> TMT GOLONGAN </th>
							<th class="bordertop" width="196" align="center">PENDIDIKAN </th>
							<th class="bordertop" width="61" align="center"> USIA </th>
							<th class="bordertopbottom" width="183" align="center"> Satuan Kerja</th> 
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
	</div>
</div>
<!--tab-pane-->


<script type="text/javascript">
	(function($){
		$("#unit_id").select2({
			placeholder: 'Cari Unit Kerja...',
			width: '100%',
			minimumInputLength: 3,
			allowClear: true,
			ajax: {
				url: '<?php echo site_url("pegawai/duk/ajax_unit_list");?>',
				dataType: 'json',
				data: function(params) {
					return {
						term: params.term || '',
						page: params.page || 1
					}
				},
				cache: true
			}
		}).on("change",function(){
			grid_daftar.ajax.reload();
		})
		var $container = $("#<?php echo $TAB_ID;?>");
		var grid_daftar = $(".table-data",$container).DataTable({
				ordering: false,
				processing: true,
				"bFilter": false,
				"bLengthChange": false,
				serverSide: true,
				"columnDefs": [
					{"className": "dt-center", "targets": [0,2,3,4]}
				],
				ajax: {
					url: "<?php echo base_url() ?>pegawai/duk/ajax_list",
					type:'POST',
					data : function(d){
						d.unit_id = $("#unit_id").val();
					}
				}
		});		
	})(jQuery);
</script>
