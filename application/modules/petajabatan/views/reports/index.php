<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/select2/select2.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/datepicker/datepicker3.css">
<div class="callout callout-info">
   <h4>Peta Jabatan!</h4>

   <p>Silahkan cari Unitkerja untuk melihat peta jabatan pada unit tersebut.</p>
 </div>
<div class="admin-box box box-primary">
	<div class="box-header">
	  <div class="control-group">
			 <div class='controls'>
				 <select name="Unit_Kerja_ID" id="Unit_Kerja_ID" class="form-control select2" style="width:700px">
                        <?php 
                            if($selectedLokasiPegawai){
                                echo "<option selected value='".$selectedLokasiPegawai->ID."'>".$selectedLokasiPegawai->NAMA."</option>";
                            }
                        ?>
					</select>
			 </div>
		 </div>
	</div>
	<div class="box-body" id="divcontent">
	
	</div>
</div>
<script>
	$("#Unit_Kerja_ID").change(function(){
		 var ValUnit_Kerja_ID = $("#Unit_Kerja_ID").val();
			var json_url = "<?php echo base_url() ?>admin/reports/petajabatan/viewdata?unitkerja="+ValUnit_Kerja_ID;
			//alert(json_url);
			$.ajax({    type: "POST",
			   url: json_url,
			   data: "unitkerja="+ValUnit_Kerja_ID,
			   success: function(data){ 
			   
			    
				   $('#divcontent').html(data);
			   }});
			return false; 
		 return false;
	 }); 
    $("#Unit_Kerja_ID").select2({
        placeholder: 'Cari Unit Kerja...',
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        ajax: {
            url: '<?php echo site_url("admin/masters/unitkerja/ajax");?>',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });
</script>