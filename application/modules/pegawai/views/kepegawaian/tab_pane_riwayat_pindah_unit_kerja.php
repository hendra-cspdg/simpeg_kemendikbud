
<!--tab-pane-->
<div class="tab-pane" id="<?php echo $TAB_ID;?>">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-21 col-xs-12">
            <?php if ($this->auth->has_permission('Pegawai.Kepegawaian.Addpendidikan')) : ?>
            <a href="<?php echo base_url(); ?>admin/kepegawaian/pegawai/addpendidikan/<?php echo $PNS_ID ?>" class="show-modal" tooltip="Tambah Riwayat Pendidikan">
                <button type="button" class="btn btn-default btn-warning margin pull-right "><i class="fa fa-plus"></i> Tambah</button>
            </a>
            <?php endif; ?>
            <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pendidikan</th>
                    <th>Tgl. Lulus</th>
                    <th>Tahun Lulus</th>
                    <th>Nomor Ijazah</th>
                    <th>Nama Sekolah</th>
                    <th>Pendidikan Pertama</th>
                    <th>#</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                        
                </tr>
            </tfoot>
            <tbody>
                <?php
                $NO = 1;
                $has_records	= isset($records) && is_array($records) && count($records);
                if ($has_records) :
                    foreach ($records as $record) :
                ?>
                <tr>
                    <td><?php e($NO); ?>.</td>
                    <td><?php e($record->NAMA_PENDIDIKAN); ?></td>
                    <td><?php e($record->Tanggal_Lulus) ?></td>
                    <td><?php e($record->Tahun_Lulus) ?></td>
                    <td><?php e($record->Nomor_Ijasah) ?></td>
                    <td><?php e($record->Nama_Sekolah) ?></td>
                    <td><?php e($record->Pendidikan_Pertama) ?></td>
                    <td>
                    <a href="<?php echo base_url(); ?>admin/kepegawaian/pegawai/addpendidikan/<?php echo $record->PNS_ID; ?>/<?php echo $record->ID; ?>"  data-toggle='tooltip' title='Edit data' class="show-modal"><span class='fa-stack'>
                        <i class='fa fa-square fa-stack-2x'></i>
                        <i class='fa fa-pencil fa-stack-1x fa-inverse'></i>
                        </span>
                        </a>
                        <a href="#" url="<?php echo base_url() ?>admin/kepegawaian/pegawai/deletependidikan" kode="<?php echo $record->ID; ?>" class='delete' data-toggle='tooltip' title='Hapus Data' >
                        <span class='fa-stack'>
                        <i class='fa fa-square fa-stack-2x'></i>
                        <i class='fa fa-trash-o fa-stack-1x fa-inverse'></i>
                        </span>
                        </a>
                        </td>
                </tr>
                <?php
                    endforeach;
                else:
                ?>
                <tr>
                    <td colspan="7">Data tidak ada</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>  
        </div>
        </div>
    </div>
</div>
<!--tab-pane-->


<script type="text/javascript">
$(".delete","#<?php echo $TAB_ID;?>").click(function(event){
			event.preventDefault();
	var kode =$(this).attr("kode");
	var url =$(this).attr("url");
	swal({
		title: "Anda Yakin?",
		text: "Hapus data riwayat pendidikan!",
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
					url: url,
					type:"POST",
					data: post_data,
					dataType: "html",
					timeout:180000,
					success: function (result) {
						 swal("Deleted!", result, "success");
						 location.reload(true);
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