<div class="admin-box box box-primary">
	<div class="box-header">
        
    </div>
	<div class="box-body">
        <div id="tree_satker" class="tree-demo"> </div>
    </div>
</div>    


<script type="application/javascript">
    $(document).ready(function(){
        //import { promiseAlert, swal } from 'promise-alert';
        //promiseAlert({  
          //  title: 'Name?',
           // text: 'Please enter your name.',
           // type: 'input',
           // showCancelButton: true,
           // closeOnConfirm: false
        //});
        $("#tree_satker").jstree({
                "core" : {
                    "themes" : {
                        "responsive": false
                    }, 
                    // so that create works
                    check_callback: function (op, node, parent, position, more) {
                        if ((op === "move_node" || op === "copy_node") && node.type && node.type == "root") {
                            return false;
                        }
                       
                      //  if ((op === "move_node" || op === "copy_node") && more && more.core && !confirm('Are you sure ...')) {
                     //       return false;
                     //   }
                        return true;
                    },
                    'data' : {
                        'url' : function (node) {
                            return 'ajax_tree';
                        },
                        'data' : function (node) {
                            return { 'parent' : node.id };
                        }
                    }
                },
                "types" : {
                    "default" : {
                        "icon" : "fa fa-folder icon-state-warning icon-lg"
                    },
                    "file" : {
                        "icon" : "fa fa-file icon-state-warning icon-lg"
                    }
                },
                "state" : { "key" : "demo3" },
                "plugins" : [ "dnd",  "types","contextmenu" ]
            }).bind("move_node.jstree", function (e,data) {
                swal({
					title: "Anda Yakin?",
					text: "Data akan di pindah!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: 'btn-danger',
					confirmButtonText: 'Ya, Pindah!',
					cancelButtonText: "Tidak, Batalkan!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function (isConfirm) {
					if (isConfirm) {
						$.post({
								url: "<?php echo base_url() ?>pegawai/manage_unitkerja/changenode",
                                data:{
                                    parent : data.par,
                                    old_parent : data.old_par,
                                    position : data.position,
                                    currNode : data.node
                                },
								timeout:180000,
								success: function (result) {
									swal("Data berhasil di hapus!", result, "success");
									$("#tree_satker").jstree(true).refresh();
							},
							error : function(error) {
								swal("ERROR", "", "error");
							} 
						});        
						
					} else {
						 $("#tree_satker").jstree(true).refresh();
                         swal("Batal", "", "error");
					}
				});
               
            });
        
    });
</script>