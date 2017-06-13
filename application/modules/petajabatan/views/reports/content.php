<?php
$can_delete	= $this->auth->has_permission('Petajabatan.Reports.Delete');
$can_edit		= $this->auth->has_permission('Petajabatan.Reports.Edit');
$can_add		= $this->auth->has_permission('Petajabatan.Reports.Create');
?>
<center>
	<div class="col-sm-12">
		<div class="box-small col-sm-12"  style="border: 1px solid black;min-height:50px; padding:10px;margin-bottom:20px;background:#3c8dbc;color:white;">
			<b>
			<?php echo isset($datadetil->NAMA_UNOR) ? $datadetil->NAMA_UNOR : ""; ?>
			</b>
		</div>
	</div>
		<?php 
		$width = 3;
		if(count($eselon3) < 4){
			$width = 4;
		} ?>
		<?php for($s=0;$s < count($eselon3);$s++){ ?>
			<div class="box-small  col-sm-<?php echo $width; ?>">
			   <div class="box-small  col-sm-12" style="border: 1px solid black;background:green;min-height:50px;color:white;padding-top:10px;">
				  <b> <?php echo $eselon3['NAMA_UNOR'][$s]; ?></b>
			   </div>
			   
				   <?php
					   $ideselon3 = isset($eselon3['ID'][$s]) ? $eselon3['ID'][$s] : "";
					   
					   for($i=0;$i < count($aeselon4[$ideselon3]);$i++){
					   ?>
					   	<div class="box-small  col-sm-12" style="margin-top:20px;border: 1px solid black;background:yellow;min-height:50px;padding-top:10px;">
							<?php
								$ideselon4 = $aeselon4[$ideselon3."-ID"][$i];
								//echo $ideselon4;
								echo $aeselon4[$ideselon3][$i];
							?>
							<?php if($can_add): ?>
							   <div class="btn-group">
								  <button type="button" class="btn btn-warning">Pilih</button>
								  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
									<li><a href="<?php echo base_url(); ?>admin/reports/petajabatan/addkuota/<?php echo $ideselon4; ?>" class="show-modal" tooltip="Tambah Kuota Jabatan <?php echo $aeselon4[$ideselon3][$i]; ?>">Tambah Jabatan</a></li>
								  </ul>
								</div>
						   <?php endif; ?>
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
								 if(isset($akuota[$ideselon4."-ID_JABATAN"])){
								  for($a=0;$a < count($akuota[$ideselon4."-ID_JABATAN"]);$a++){
								  
								  ?>
								  <tr>
									  <td>
										  <?php echo $no; ?>.
									  </td>
									  <td>
									  	<?php if($can_edit): ?>
										  <a href="<?php echo base_url(); ?>admin/reports/petajabatan/editkuota/<?php echo $ideselon4; ?>/<?php echo $akuota[$ideselon4."-ID_JABATAN"][$a]; ?>" class="show-modal"  tooltip="Ubah Kuota Jabatan <?php echo $akuota[$ideselon4."-NAMA_Jabatan"][$a]; ?>"><?php echo $akuota[$ideselon4."-NAMA_Jabatan"][$a]; ?></a>
										<?php else: ?>
											<?php echo $akuota[$ideselon4."-NAMA_Jabatan"][$a]; ?>
										<?php endif; ?>
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
								  }
								 ?>
							</table>
						</div>
						<?php
					   }
				   ?>
			</div>
			
		<?php }?>
</center>