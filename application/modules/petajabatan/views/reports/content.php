<center>
	<div class="col-sm-12">
		<div class="box-small col-sm-12"  style="border: 1px solid black;min-height:50px; padding:10px;margin-bottom:20px;background:#3c8dbc;color:white;">
			<b>
			<?php echo isset($datadetil->NAMA_ESELON_II) ? $datadetil->NAMA_ESELON_II : ""; ?>
			</b>
		</div>
	</div>
	<?php if (isset($eselon3) && is_array($eselon3) && count($eselon3)):?>
		<?php 
		$width = 3;
		if(count($eselon3) < 4){
			$width = 4;
		} ?>
		<?php foreach($eselon3 as $record):?>
			<div class="box-small  col-sm-<?php echo $width; ?>">
			   <div class="box-small  col-sm-12" style="border: 1px solid black;background:green;min-height:50px;color:white;">
				  <b> <?php echo $record->NAMA_ESELON_III; ?></b>
			   </div>
			   
				   <?php
					   $ideselon3 = isset($record->ID) ? substr($record->ID,0,8) : "";
					   for($i=0;$i < count($aeselon4[$ideselon3]);$i++){
					   ?>
					   	<div class="box-small  col-sm-12" style="margin-top:20px;border: 1px solid black;background:yellow;min-height:50px;">
					   	<?php
					   		$ideselon4 = $aeselon4[$ideselon3."-ID"][$i];
					   		echo $ideselon4;
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
									  	<!--[<?php echo $akuota[$ideselon4."-ID_JABATAN"][$a]; ?>]-->
										  <?php echo $akuota[$ideselon4."-Nama_Jabatan"][$a]; ?>
									  </td>
									  <td>
										  -
									  </td>
									  <td>
									  <?php 
									  	$jmlada = isset($apegawai[$ideselon4."-jml-".$akuota[$ideselon4."-ID_JABATAN"][$a]]) ? $apegawai[$ideselon4."-jml-".$akuota[$ideselon4."-ID_JABATAN"][$a]] : "";
									  	//echo $ideselon4."-jml-".$akuota[$ideselon4."-ID_JABATAN"][$a]; ?>
									  	<?php echo $jmlada; ?>
										  
									  </td>
									  <td>
										  <?php 
										  $quota = $akuota[$ideselon4."-JML"][$a];
										  echo $quota; 
										  ?>
									  </td>
									  <td>
										  <?php
										  $sisa = (int)$jmlada - (int)$quota;
										  echo $sisa;
										  ?>
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