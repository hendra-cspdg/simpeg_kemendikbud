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
		minimumInputLength: 3,
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
			window.location = "<?php echo site_url('pegawai/rekap/index?unit_id=');?>"+$(this).val();
		}
		else window.location = "<?php echo site_url('pegawai/rekap/index');?>";
	});
</script>	
<div class="row">
	<div class="col-md-8">
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
					
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Matriks Jenis Kelamin dan Usia</h3>

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
								<?php 
									if(sizeof($data_rekap_jenis_kelamin_per_usia)>0){
										?>
											<table class="table table-list table-bordered">
												<thead>
													<tr>
															<?php 
																foreach($data_rekap_jenis_kelamin_per_usia as $row){
																		foreach(array_keys($row) as $column){ ?>
																				<th align='center'><?php echo $column;?></th>
																		<?php 
																		}
																		break;
																}
															?>
													</tr>
												</thead>
												<tbody>
													
															<?php 
																foreach($data_rekap_jenis_kelamin_per_usia as $row){
																	?>
																	<tr>
																			<?php foreach(array_keys($row) as $column){ ?>
																							<td align='center'><?php echo $row[$column];?></td>
																			<?php }	?>
																	</tr>
																	<?php 
																}
															?>
														
												</tbody>
									</table>
									<?php 	
									}
									else echo "Data tidak ada";
								?>
							</div>	
						</div>	
			</div>
		</div>	

		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Matriks Pendidikan dan Usia</h3>

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
								<?php 
									if(sizeof($data_rekap_pendidikan_per_usia)>0){
										?>
											<table class="table table-list table-bordered">
												<thead>
													<tr>
															<?php 
																foreach($data_rekap_pendidikan_per_usia as $row){
																		foreach(array_keys($row) as $column){ ?>
																				<th align='center'><?php echo $column;?></th>
																		<?php 
																		}
																		break;
																}
															?>
													</tr>
												</thead>
												<tbody>
													
															<?php 
																foreach($data_rekap_pendidikan_per_usia as $row){
																	?>
																	<tr>
																			<?php foreach(array_keys($row) as $column){ ?>
																							<td align='center'><?php echo $row[$column];?></td>
																			<?php }	?>
																	</tr>
																	<?php 
																}
															?>
														
												</tbody>
									</table>
									<?php 	
									}
									else echo "Data tidak ada";
								?>
							</div>	
						</div>	
			</div>
		</div>	

	</div>

	<div class="col-md-4">
				
								
	<div class="box box-success ">
		<div class="box-header with-border">
			<h3 class="box-title">Matriks BUP dan Umur</h3>

			<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body ">	
				<div class="row">
										<div class="col-md-12">
											<table class="table table-list table-bordered">
														<thead>
															<tr>
																	<th>Usia</th>
																	<th>58</th>
																	<th>60</th>
															</tr>
														</thead>
														<tbody>
															
																	<?php 
																		foreach($data_bup_per_range_umur as $row){
																			?>
																			<tr>
																					<td align='center'><?php echo $row['range'];?></td>
																					<td align='center'><?php echo $row['bup_58'];?></td>
																					<td align='center'><?php echo $row['bup_60'];?></td>
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
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">Matriks Golongan dan Jenis Kelamin</h3>

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
														<th>M</th>
														<th>F</th>
														<th>Belum terdata</th>
												</tr>
											</thead>
											<tbody>
												
														<?php 
															foreach($data_rekap_golongan_per_jenis_kelamin as $row){
																?>
																<tr>
																		<td align='center'><?php echo $row['nama'];?></td>
																		<td align='center'><?php echo $row['M'];?></td>
																		<td align='center'><?php echo $row['F'];?></td>
																		<td align='center'><?php echo $row['-'];?></td>
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

	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">Matriks Pendidikan dan Jenis Kelamin</h3>

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
							<?php 
								if(sizeof($data_rekap_pendidikan_per_jenis_kelamin)>0){
									?>
										<table class="table table-list table-bordered">
											<thead>
												<tr>
														<?php 
															foreach($data_rekap_pendidikan_per_jenis_kelamin as $row){
																	foreach(array_keys($row) as $column){ ?>
																			<th align='center'><?php echo $column;?></th>
																	<?php 
																	}
																	break;
															}
														?>
												</tr>
											</thead>
											<tbody>
												
														<?php 
															foreach($data_rekap_pendidikan_per_jenis_kelamin as $row){
																?>
																<tr>
																		<?php foreach(array_keys($row) as $column){ ?>
																						<td align='center'><?php echo $row[$column];?></td>
																		<?php }	?>
																</tr>
																<?php 
															}
														?>
													
											</tbody>
								</table>
								<?php 	
								}
								else echo "Data tidak ada";
							?>
						</div>	
					</div>	
			</div>
		</div>	

		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Matriks Agama dan Jenis Kelamin</h3>

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
							<?php 
								echo "<table class='table table-list table-bordered'><thead><tr><th>Agama</th><th>Laki-Laki</th><th>Perempuan</th></tr></thead><tbody>";
									foreach($data_jumlah_pegawai_per_agama_jeniskelamin as $agama){
										echo "<tr><td>$agama->nama</td><td>$agama->m</td><td>$agama->f</td></tr>";
									}
									echo "</tbody></table>";
							?>
					</div>
				</div>
			</div>
		</div>	
						
           
          
         
    </div>
</div>
<div class="row">
	<div class="col-md-12">
			<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Matriks Golongan dan Pendidikan</h3>

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
									<?php 
										if(sizeof($data_rekap_golongan_per_pendidikan)>0){
											?>
												<table class="table table-list table-bordered">
													<thead>
														<tr>
																<?php 
																	foreach($data_rekap_golongan_per_pendidikan as $row){
																			foreach(array_keys($row) as $column){ ?>
																					<th align='center'><?php echo $column;?></th>
																			<?php 
																			}
																			break;
																	}
																?>
														</tr>
													</thead>
													<tbody>
														
																<?php 
																	foreach($data_rekap_golongan_per_pendidikan as $row){
																		?>
																		<tr>
																				<?php foreach(array_keys($row) as $column){ ?>
																								<td align='center'><?php echo $row[$column];?></td>
																				<?php }	?>
																		</tr>
																		<?php 
																	}
																?>
															
													</tbody>
										</table>
										<?php 	
										}
										else echo "Data tidak ada";
									?>
								</div>	
							</div>	
				</div>
			</div>	
		
	</div>
</div>
<script src="<?php echo base_url() ?>themes/admin/plugins/chartjs/Chart.min.js"></script>
<script type="text/javascript">
var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  	var pieChart = new Chart(pieChartCanvas);
 	var PieData = <?php echo json_encode($agamas); ?>;
  	var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=value %> <%=label%> "
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  
</script>
<script type="text/javascript">  
var colors=    [ '#FCD202', '#B0DE09','#FF6600', '#0D8ECF', '#2A0CD0', '#CD0D74', '#CC0000', '#00CC00', '#0000CC', '#DDDDDD', '#999999', '#333333', '#990000']
var input=<?php echo $jsonpangkat; ?>;
//inject color attribute with value
for (i = 0; i < input.length; i++) {input[i].color = colors[i];}	

	 var chart = AmCharts.makeChart("chartgolongan", {
				  "type": "serial",
				  "dataProvider":  input,
				   "theme": "light",
				  "categoryField": "NAMA",
				  "rotate": false,
				  "startDuration": 0,
				  "depth3D": 2,
				  "angle": 30,
				  
				  "chartCursor": {
					  "categoryBalloonEnabled": false,
					  "cursorAlpha": 0,
					  "zoomable": false,
				  },    
				   "categoryAxis": {
					 "gridPosition": "start",
					 "labelRotation": 45,
					 "axisAlpha": 0,
					 "autoWrap":false,
					 minHorizontalGap:0,
				   },
				   
					"titles" : [{
						  "text": "NAMA"
					  }, {
						  "text": "",
						  "bold": false
					  }],
				  "trendLines": [],
				  "graphs": [
					  {
						  "balloonText": "<b>[[category]]: [[value]]</b>",
						  "colorField": "color",
						  "fillAlphas": 0.8,
						  "id": "AmGraph-1",
						  "lineAlpha": 0.2,
						  "type": "column",
						  "valueField": "jumlah"
					  } 
				  ],
				  "guides": [],
				  "valueAxes": [
					  {
						  "id": "ValueAxis-1",
						  "position": "top",
						  "axisAlpha": 0
					  }
				  ],
				  "allLabels": [],
				  "balloon": {},
				  "titles": [],
				  
				  "export": {
					  "enabled": true
				   }

	});

var inputpendidikan = <?php echo $jsonpendidikan; ?>;
//inject color attribute with value
for (i = 0; i < inputpendidikan.length; i++) {inputpendidikan[i].color = colors[i];}	
	var chart = AmCharts.makeChart("chartpendidikan", {
				  "type": "serial",
				  "dataProvider":  inputpendidikan,
				   "theme": "light",
				  "categoryField": "NAMA",
				  "rotate": false,
				  "startDuration": 0,
				  "depth3D": 0,
				  "colorField" : "#ffd900",
				  "angle": 30,
				  
				  "chartCursor": {
					  "categoryBalloonEnabled": false,
					  "cursorAlpha": 0,
					  "zoomable": false,
				  },    
				   "categoryAxis": {
					 "gridPosition": "start",
					 "labelRotation": 45,
					 "axisAlpha": 0,
					 "autoWrap":false,
					 minHorizontalGap:0,
				   },
				   
					"titles" : [{
						  "text": "NAMA"
					  }, {
						  "text": "",
						  "bold": false
					  }],
				  "trendLines": [],
				  "graphs": [
					  {
						  "balloonText": "<b>[[category]]: [[value]]</b>",
						  "fillAlphas": 0.8,
						  "id": "AmGraph-1",
						  "lineAlpha": 0.2,
						  "title": "Pendidikan",
						  "type": "column",
						  "colorField": "color",
						  "valueField": "jumlah"
					  } 
				  ],
				  "guides": [],
				  "valueAxes": [
					  {
						  "id": "ValueAxis-1",
						  "position": "top",
						  "axisAlpha": 0
					  }
				  ],
				  "allLabels": [],
				  "balloon": {},
				  "titles": [],
				  
				  "export": {
					  "enabled": true
				   }

	});
	
	var chartPensiunTahun = AmCharts.makeChart("chartpensiuntahun", {
				  "type": "serial",
				  "dataProvider":   <?php echo $jsonpensiuntahun; ?>,
				   "theme": "light",
				  "categoryField": "tahun",
				  "rotate": false,
				  "startDuration": 0,
				  "depth3D": 2,
				  "angle": 30,
				  
				  "chartCursor": {
					  "categoryBalloonEnabled": false,
					  "cursorAlpha": 0,
					  "zoomable": false,
				  },    
				   "categoryAxis": {
					 "gridPosition": "start",
					 "labelRotation": 45,
					 "axisAlpha": 0,
					 "autoWrap":false,
					 minHorizontalGap:0,
				   },
				   
					"titles" : [{
						  "text": "tahun"
					  }, {
						  "text": "",
						  "bold": false
					  }],
				  "trendLines": [],
				  "graphs": [
					  {
						  "balloonText": "<b>[[category]]: [[value]]</b>",
						  "colorField": "color",
						  "fillAlphas": 0.8,
						  "id": "AmGraph-1",
						  "lineAlpha": 0.2,
						  "type": "column",
						  "valueField": "jumlah"
					  } 
				  ],
				  "guides": [],
				  "valueAxes": [
					  {
						  "id": "ValueAxis-1",
						  "position": "top",
						  "axisAlpha": 0
					  }
				  ],
				  "allLabels": [],
				  "balloon": {},
				  "titles": [],
				  
				  "export": {
					  "enabled": true
				   }

	});
			  
			  
	 AmCharts.makeChart("divjeniskelamin", {
		 "type": "pie",
		 "theme": "light",
		 "dataProvider":  <?php echo $jsonjk; ?>,
		 "titleField": "Jenis_Kelamin",
		 "valueField": "jumlah",
		 "pulledField": "pullOut",
		 labelsEnabled: false,
		 "categoryBalloonEnabled": false,
		 "export": {
		   "enabled": true
		 },
		 "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
		 "legend": {
			 "align": "center",
			 "markerType": "circle"
		 }

	 });
	 
	 var chartDivUmur = AmCharts.makeChart("divumur", {
				  "type": "serial",
				  "dataProvider":   <?php echo $jsonumur; ?>,
				   "theme": "light",
				  "categoryField": "label",
				  "rotate": false,
				  "startDuration": 0,
				  "depth3D": 2,
				  "angle": 30,
				  
				  "chartCursor": {
					  "categoryBalloonEnabled": false,
					  "cursorAlpha": 0,
					  "zoomable": false,
				  },    
				   "categoryAxis": {
					 "gridPosition": "start",
					 "labelRotation": 45,
					 "axisAlpha": 0,
					 "autoWrap":false,
					 minHorizontalGap:0,
				   },
				   
					"titles" : [{
						  "text": "label"
					  }, {
						  "text": "",
						  "bold": false
					  }],
				  "trendLines": [],
				  "graphs": [
					  {
						  "balloonText": "<b>[[category]]: [[value]]</b>",
						  "colorField": "color",
						  "fillAlphas": 0.8,
						  "id": "AmGraph-1",
						  "lineAlpha": 0.2,
						  "type": "column",
						  "valueField": "jumlah"
					  } 
				  ],
				  "guides": [],
				  "valueAxes": [
					  {
						  "id": "ValueAxis-1",
						  "position": "top",
						  "axisAlpha": 0
					  }
				  ],
				  "allLabels": [],
				  "balloon": {},
				  "titles": [],
				  
				  "export": {
					  "enabled": true
				   }

	});
	
	 var chartRekapGolongan =  AmCharts.makeChart("chart_rekap_pegawai_pangkat_golongan", {
				  "type": "serial",
				  "dataProvider":   <?php echo $data_jumlah_pegawai_per_golongan; ?>,
				   "theme": "light",
				  "categoryField": "nama",
				  "rotate": false,
				  "startDuration": 0,
				  "depth3D": 2,
				  "angle": 30,
				  
				  "chartCursor": {
					  "categoryBalloonEnabled": false,
					  "cursorAlpha": 0,
					  "zoomable": false,
				  },    
				   "categoryAxis": {
					 "gridPosition": "start",
					 "labelRotation": 45,
					 "axisAlpha": 0,
					 "autoWrap":false,
					 minHorizontalGap:0,
				   },
				   
					"titles" : [{
						  "text": "nama"
					  }, {
						  "text": "",
						  "bold": false
					  }],
				  "trendLines": [],
				  "graphs": [
					  {
						  "balloonText": "<b>[[category]]: [[value]]</b>",
						  "colorField": "color",
						  "fillAlphas": 0.8,
						  "id": "AmGraph-1",
						  "lineAlpha": 0.2,
						  "type": "column",
						  "valueField": "total"
					  } 
				  ],
				  "guides": [],
				  "valueAxes": [
					  {
						  "id": "ValueAxis-1",
						  "position": "top",
						  "axisAlpha": 0
					  }
				  ],
				  "allLabels": [],
				  "balloon": {},
				  "titles": [],
				  
				  "export": {
					  "enabled": true
				   }

	});
 </script>
