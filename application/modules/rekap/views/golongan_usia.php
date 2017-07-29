<script src="<?php echo base_url(); ?>assets/js/amcharts/amcharts.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/serial.js" type="text/javascript" ></script>  
<script src="<?php echo base_url(); ?>assets/js/amcharts/pie.js" type="text/javascript" ></script>  
<script type="text/javascript" src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<?php
	$this->load->library('convert');
	$convert = new convert();
	$mainmenu = $this->uri->segment(2);
	$menu = $this->uri->segment(3);
	$submenu = $this->uri->segment(4);
?>
<div class="row margin">
	<div class="col-md-12">
		<table class="filter_pegawai" sborder=0 width='100%' cellpadding="10">
				<tr>
					<td width="200px"><label for="example-text-input" class="col-form-label">Satuan Kerja</label></td>
					<td colspan=2>
						<select id="unit_id_key" name="unit_id_key" width="100%" class=" col-md-10 format-control">
							<?php 
								if($selectedSatker){
									echo "<option value='$selectedSatker->ID' SELECTED>$selectedSatker->NAMA_UNOR</option>";
								}
							?>
						</select>
					</td>
				</tr>
		</table>		
	</div>
</div>

<script type="text/javascript">
	$("#unit_id_key").select2({
		placeholder: 'Cari Unit Kerja...',
		width: '100%',
		minimumInputLength: 0,
		allowClear: true,
		ajax: {
			url: '<?php echo site_url("pegawai/kepegawaian/ajax_satker_list");?>',
			dataType: 'json',
			data: function(params) {
				return {
					term: params.term || '',
					page: params.page || 1
				}
			},
			cache: true
		}
	}).change(function(){
		if($(this).val()){
			window.location = "?unit_id="+$(this).val();
		}
		else window.location = "?";
	});
</script>	
<div class="row">
	<div class="col-md-12">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Matriks Golongan dan Range Usia</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
							<div class="col-md-12">
								<table class="table table-list table-bordered">
											<thead>
												<tr>
														<th>Golongan</th>
														<th><25</th>
														<th>25-30</th>
														<th>31-35</th>
														<th>36-40</th>
														<th>41-45</th>
														<th>46-50</th>
														<th>>50</th>
												</tr>
											</thead>
											<tbody>
												
														<?php 
															foreach($data_rekap_golongan_per_usia as $row){
																?>
																<tr>
																		<td align='center'><?php echo $row['nama'];?></td>
																		<td align='center'><?php echo $row['<25'];?></td>
																		<td align='center'><?php echo $row['25-30'];?></td>
																		<td align='center'><?php echo $row['31-35'];?></td>
																		<td align='center'><?php echo $row['36-40'];?></td>
																		<td align='center'><?php echo $row['41-45'];?></td>
																		<td align='center'><?php echo $row['46-50'];?></td>
																		<td align='center'><?php echo $row['>50'];?></td>
																</tr>
																<?php 
															}
														?>
													
											</tbody>
								</table>
							</div>	
						</div>	
			</div>
		</div>	
					
	</div>
</div>	