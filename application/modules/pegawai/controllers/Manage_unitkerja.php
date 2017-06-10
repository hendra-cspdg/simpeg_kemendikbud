<?php 

class Manage_unitkerja extends Admin_Controller {
    protected $permissionCreate = 'ManageUnitKerja.Kepegawaian.Create';
    protected $permissionDelete = 'ManageUnitKerja.Kepegawaian.Delete';
    protected $permissionEdit   = 'ManageUnitKerja.Kepegawaian.Edit';
    protected $permissionView   = 'ManageUnitKerja.Kepegawaian.View';
    
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        Template::set('toolbar_title', "Manage Unit Kerja");
        Template::render();
    }

    public function get_children($parent=null){
        if($parent==null){
            return $this->db->query('select parent."ID",parent."NAMA_UNOR",sum(case child."ID" when null then 0 else 1 end) as num_child from unitkerja parent
                left join unitkerja child on child."PARENT_ID" = parent."ID" 
                where parent."PARENT_ID"   is null
                group by parent."ID",parent."NAMA_UNOR"
                ORDER BY parent."NAMA_UNOR" asc 
            ')->result();
        }
        else {
            return $this->db->query('select parent."ID",parent."NAMA_UNOR",sum(case child."ID" when null then 0 else 1 end) as num_child from unitkerja parent
                left join unitkerja child on child."PARENT_ID" = parent."ID" 
                where parent."PARENT_ID"  = ?
                group by parent."ID",parent."NAMA_UNOR"
                ORDER BY parent."NAMA_UNOR" asc 
            ',array($parent))->result();
        }
    }
    public function ajax_tree(){
        $parent = $this->input->get("parent");
        $data = array();

        if ($parent == "#") {
            $children = $this->get_children(null);
            foreach($children as $record){
                $data [] =  array(
                    "x"=>$parent,
                    "id" => "node_" .$record->ID,  
                    "text" => $record->NAMA_UNOR,  
                    "icon" => "fa fa-folder icon-lg icon-state-success" ,
                    "children" => $record->num_child>1, 
                    "type" => "root"
                );
            }
        } else {
            $splitnode = split("_",$parent);
            $children = $this->get_children($splitnode[1]);
            foreach($children as $record){
                $data [] =  array(
                    "xy"=>$splitnode[1],
                    "id" => "node_" .$record->ID,  
                    "text" => $record->NAMA_UNOR,  
                    "icon" => "fa fa-folder icon-lg icon-state-success",
                    "children" => $record->num_child>1
                );
            }
        }

        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($data);
    }
}