<?php 

class Manage_unitkerja extends Admin_Controller {
    protected $permissionCreate = 'ManageUnitKerja.Kepegawaian.Create';
    protected $permissionDelete = 'ManageUnitKerja.Kepegawaian.Delete';
    protected $permissionEdit   = 'ManageUnitKerja.Kepegawaian.Edit';
    protected $permissionView   = 'ManageUnitKerja.Kepegawaian.View';
    public $UNOR_ID = null;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pegawai/unitkerja_model");
        $this->load->model('pegawai/pegawai_model');
        // filter untuk role executive
		if($this->auth->role_id() =="5"){
			$this->UNOR_ID = $this->pegawai_model->getunor_id($this->auth->username());
		}
		if($this->auth->role_id() =="6"){
			$this->UNOR_ID = $this->pegawai_model->getunor_induk($this->auth->username());
		}
    }
    public function index(){
        Template::set('toolbar_title', "Manage Unit Kerja");
        Template::render();
    }

    public function get_children($parent=null){
        if($parent==null){
            return $this->db->query('
            select parent."ID",parent."NAMA_UNOR","IS_SATKER",(select count(*) from unitkerja children where children."DIATASAN_ID" = parent."ID")as num_child
            from unitkerja parent
            where 
            deleted is null 
            AND (parent."DIATASAN_ID"   is null OR parent."DIATASAN_ID" = \'\')
            ORDER BY parent."ORDER" asc 
            ')->result();
        }
        else {
            return $this->db->query('
                        select parent."ID",parent."NAMA_UNOR","IS_SATKER",(select count(*) from unitkerja children where children."DIATASAN_ID" = parent."ID")as num_child
                        from unitkerja parent
                        where 
                        deleted is null 
                        AND parent."DIATASAN_ID"  = ?
                        ORDER BY parent."ORDER" asc 
            ',array($parent))->result();
        }
    }
    public function moveNode(){
        $_position = $this->input->post("_position");
        $_currNodeId = $this->input->post("_currNodeId");
        $_parentNodeId = $this->input->post("_parentNodeId");
        $_oldParentId = $this->input->post("_oldParentId");
        $_nx = $this->input->post("_nx");
        $currNodeId = str_replace("node_","",$_currNodeId);
        $parentNodeId = str_replace("node_","",$_parentNodeId);
        $oldParentId = str_replace("node_","",$_oldParentId);

        $output = array(
            "success"=>false,
            "msg"=>'Transaksi tidak dapat dilanjutkan');
        if($currNodeId == $parentNodeId){
           echo json_encode($output);
           exit;
        }   
        $index = 1;
        $xyz = array();
        foreach($_nx as $nx){
            $nxid = str_replace("node_","",$nx);
            $xyz[] =  array(
                        'ORDER'=>$index,
                        'ID'=> $nxid
                );
            $index++;
        }
        

        $this->db->update_batch("hris.unitkerja",array_values($xyz),"ID");   
         $output = array(
            "success"=>true,
            "msg"=>'Transaksi berhasil'); 
        $this->db->where("ID",$currNodeId);
        $this->db->set("DIATASAN_ID",$parentNodeId);
        $this->db->update("hris.unitkerja");    
        echo json_encode($output);
        exit;     
       
       $siblings = $this->get_children($parentNodeId);
       $xyz = array();
       $index=1;
       foreach($siblings as $row){
           
            if($row->ID == $currNodeId){
                
            }
            else {
                $xyz[$row->ID] = array(
                        'ORDER'=>$index,
                        'ID'=>$row->ID
                );
            }
            $index++;
       }
       $tempxyz = $xyz;
       if($_position==0){
           $xyz = array_merge(array(array('ORDER'=>0,'ID'=>$currNodeId)),$xyz);
       }
       else {
           $index=1;
           $temp = array();
           $input = true;
           foreach($xyz as $row){
               $temp[] = $row;
                if($row['ORDER']>=$_position && $input){
                    $temp[] = array('ORDER'=>$_position,'ID'=>$currNodeId);
                    $input = false;
                }
                $index++;
           }
           $xyz = $temp;
       }
       $this->db->update_batch("hris.unitkerja",array_values($xyz),"ID");
       $output = array(
            "success"=>true,
            'xyz'=>$xyz,
            'tempxyz'=> $tempxyz,
            "msg"=>'Transaksi berhasil');
       echo json_encode($output);
        exit;
    }
    public function ajax_tree(){
        $parent = $this->input->get("parent");
        $data = array();
        $default_icon = "fa fa-folder icon-lg icon-state-success";
        if ($parent == "#") {
            $children = $this->get_children(null);
            foreach($children as $record){
                if($record->IS_SATKER) {
                    $icon = "fa fa-cogs icon-lg icon-state-warning";
                }
                else {
                    $icon = $default_icon;
                }
                $data [] =  array(
                    "x"=>$parent,
                    "id" => "node_" .$record->ID,  
                    "text" => $record->NAMA_UNOR,  
                    "icon" => $icon ,
                    "children" => $record->num_child>0, 
                    "state"=> array(
                           "opened"   => boolean  // is the node open 
                    ),
                    "type" => "root"
                );
            }
        } else {
            $splitnode = split("_",$parent);
            $children = $this->get_children($splitnode[1]);
            foreach($children as $record){
                if($record->IS_SATKER) {
                    $icon = "fa fa-cogs icon-lg icon-state-warning";
                }
                else {
                    $icon = $default_icon;
                }
                $data [] =  array(
                    "xy"=>$splitnode[1],
                    "id" => "node_" .$record->ID,  
                    "text" => $record->NAMA_UNOR,  
                    "icon" => $icon ,
                    "children" => $record->num_child>0
                );
            }
        }

        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($data);
    }
    public function createNew($parent_id=''){
        Template::set_view("manage_unitkerja/crud.php");
        Template::set('toolbar_title', "CRUD Unit Kerja");

        Template::render();
    }
    public function delete($node_id){
        $satker_id = str_replace("node_","",$node_id);
        $this->unitkerja_model->delete($satker_id);
    }
    public function edit($node_id){
        $satker_id = str_replace("node_","",$node_id);
        $this->unitkerja_model->where("ID",$satker_id);
        $data_unor =$this->unitkerja_model->find_first_row();
        Template::set("ID",$data_unor->ID);
        Template::set("data",$data_unor);
        Template::set_view("manage_unitkerja/crud.php");
        Template::set('toolbar_title', "CRUD Unit Kerja");

        Template::render();
    }
    public function save(){
        $this->cache->delete("unors");
        $this->cache->delete_group("unors");
        $this->form_validation->set_rules($this->unitkerja_model->get_validation_rules());

        if ($this->form_validation->run() === false) {
            $response['msg'] = "
            <div class='alert alert-block alert-error fade in'>
                <a class='close' data-dismiss='alert'>&times;</a>
                <h4 class='alert-heading'>
                    Error
                </h4>
                ".validation_errors()."
            </div>
            ";
            echo json_encode($response);
            exit();
        }
        $id = $this->input->post("ID");
        $data = $this->unitkerja_model->prep_data($this->input->post());

        $data['IS_SATKER']=isset($data['IS_SATKER']) ? 1: 0;
        if(isset($id) && !empty($id)){
            $this->unitkerja_model->update($id,$data);
        }
        else $this->unitkerja_model->insert($data);
        $response = array();
        $response ['success']= true;
        $response ['msg']= "Transaksi berhasil";
        echo json_encode($response);   
    }
    public function test_path(){
        $this->load->model('pegawai/unitkerja_model');
        echo $this->unitkerja_model->get_parent_path(103,true,false);    
    }
    public function test_parent(){
        $this->load->model('pegawai/unitkerja_model');
        echo json_encode($this->unitkerja_model->get_satker(103));    
        echo 123;
    }	
    public function ajax(){
        $json = array();
        $limit = 10;
        $page = $this->input->get('page') ? $this->input->get('page') : "1";
        $q= $this->input->get('term');
        $start = ($page-1)*$limit;
		
		if(!empty($q)){
            $json = $this->data_model($q,$start,$limit);
		}
        echo json_encode($json);
    }
    public function ajaxkodeinternal(){
        $json = array();
        $limit = 10;
        $page = $this->input->get('page') ? $this->input->get('page') : "1";
        $q= $this->input->get('term');
        $start = ($page-1)*$limit;
		if(!empty($q)){
            $json = $this->data_modelinternal($q,$start,$limit);
		}
        echo json_encode($json);
    }
    public function ajaxall(){
        $json = array();
        $limit = 10;
        $page = $this->input->get('page') ? $this->input->get('page') : "1";
        $q= $this->input->get('term');
        $start = ($page-1)*$limit;
		
		if(!empty($q)){
            $json = $this->data_modelall($q,$start,$limit);
		}
        echo json_encode($json);
    }
    private function data_model($key,$start,$limit){
          // update
            $this->db->start_cache();
            $this->db->like('lower("NAMA_UNOR")', strtolower($key));
            $this->db->from("hris.unitkerja");
            $this->db->stop_cache();
            $total = $this->db->get()->num_rows();
            $this->db->select('ID as id,NAMA_UNOR as text');

            $this->db->limit($limit,$start);

            $data = $this->db->get()->result();

            $endCount = $start + $limit;
            $morePages = $endCount > $total;
            $o = array(
            "results" => $data,
                "pagination" => array(
                    "more" =>$morePages,
                )
            );   
            $this->db->flush_cache();
            return $o;
    }
    private function data_modelinternal($key,$start,$limit){
          // update
          $where_clause = "";
          	if($this->UNOR_ID){
				$where_clause = 'AND ("ESELON_1" = \''.$this->UNOR_ID.'\' OR "ESELON_2" = \''.$this->UNOR_ID.'\' OR "ESELON_3" = \''.$this->UNOR_ID.'\' OR "ESELON_4" = \''.$this->UNOR_ID.'\')' ;
			}
            $this->db->start_cache();
            $this->db->like('lower("NAMA_UNOR")', strtolower($key));
            $this->db->from("hris.unitkerja");
            $this->db->stop_cache();
            $total = $this->db->get()->num_rows();
            $this->db->select('ID as id,NAMA_UNOR as text');
            $this->db->where('"ID" in (select "UNOR_INDUK" from hris.unitkerja) '.$where_clause);
				
            $this->db->limit($limit,$start);

            $data = $this->db->get()->result();

            $endCount = $start + $limit;
            $morePages = $endCount > $total;
            $o = array(
            "results" => $data,
                "pagination" => array(
                    "more" =>$morePages,
                )
            );   
            $this->db->flush_cache();
            return $o;
    }
    private function data_modelall($key,$start,$limit){
          
            $this->db->start_cache();
            $this->db->like('lower("NAMA_UNOR")', $key);
            $this->db->from("hris.unitkerja");
            $this->db->stop_cache();
            $total = $this->db->get()->num_rows();
            $this->db->select('ID as id,"NAMA_UNOR" as text');
            $this->db->limit($limit,$start);

            $data = $this->db->get()->result();

            $endCount = $start + $limit;
            $morePages = $endCount > $total;
            $o = array(
            "results" => $data,
                "pagination" => array(
                    "more" =>$morePages,
                )
            );   
            $this->db->flush_cache();
            return $o;
    }
    public function getbysatker()
	{
		$satker = $this->input->get('satker');
		$json = array(); 
		$records = $this->unitkerja_model->find_all($satker);
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) :
				$json['id'][] = $record->ID;
				$json['nama'][] = $record->NAMA_UNOR;
			endforeach;
		endif;
		echo json_encode($json);
		die();
	}
	public function getbysatkerID()
	{
		$satker = $this->input->get('satker');
		$json = array(); 
		$records = $this->unitkerja_model->find_all($satker);
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) :
				$json['id'][] = $record->KODE_INTERNAL;
				$json['nama'][] = $record->NAMA_UNOR;
			endforeach;
		endif;
		echo json_encode($json);
		die();
	}
	public function getnamajabatan()
	{
		$unor = $this->input->get('unor');
		$json = array(); 
		$records = $this->unitkerja_model->findnamajabatan($unor);
		echo isset($records->NAMA_JABATAN) ? $records->NAMA_JABATAN : "";
	}
}