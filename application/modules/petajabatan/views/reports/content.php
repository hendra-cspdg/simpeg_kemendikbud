<center>
	<div class="col-sm-12">
		<div class="box-small col-sm-12"  style="border: 1px solid green;min-height:50px; padding:10px;margin-bottom:20px;background:#3c8dbc;"><?php echo isset($datadetil->NAMA_ESELON_II) ? $datadetil->NAMA_ESELON_II : ""; ?></div>
	</div>
	<?php if (isset($eselon3) && is_array($eselon3) && count($eselon3)):?>
		<?php foreach($eselon3 as $record):?>
			<div class="box-small  col-sm-3">
			   <div class="box-small  col-sm-12" style="border: 1px solid green;background:green;min-height:50px;">
				   <?php echo $record->NAMA_ESELON_III; ?>
			   </div>
			   
				   <?php
					   $ideselon3 = isset($record->ID) ? substr($record->ID,0,8) : "";
					   for($i=0;$i < count($aeselon4[$ideselon3]);$i++){
					   ?>
					   	<div class="box-small  col-sm-12" style="margin-top:20px;border: 1px solid yellow;background:yellow;min-height:50px;">
					   	<?php
					   		$ideselon4 = $aeselon4[$ideselon3."-ID"][$i];
						   	echo $aeselon4[$ideselon3][$i];
						?>
						</div>
						<div class="box-small  col-sm-12" style="margin-top:20px;min-height:50px;">
							<table class="table table-bordered">
								<tr>
									<td>
										No
									</td>
									<td>
										Jabatan
									</td>
									<td>
										KLS
									</td>
									<td>
										B
									</td>
									<td>
										K
									</td>
									<td>
										-/+
									</td>
								</tr>
								 <?php
								 $no = 1;
								  for($a=0;$a < count($akuota[$ideselon4."-ID_JABATAN"]);$a++){
								  
								  ?>
								  <tr>
									  <td>
										  <?php echo $no; ?>.
									  </td>
									  <td>
										  <?php echo $akuota[$ideselon4."-ID_JABATAN"][$a]; ?>
									  </td>
									  <td>
										  -
									  </td>
									  <td>
										  -
									  </td>
									  <td>
										  <?php echo $akuota[$ideselon4."-JML"][$a]; ?>
									  </td>
									  <td>
										  -/+
									  </td>
								  </tr>
								<?php
								$no++;
								  }
								 ?>
							</table>
						</div>
						<?php
					   }
				   ?>
			</div>
			
		<?php endforeach;?>
	<?php endif;?>
</center>