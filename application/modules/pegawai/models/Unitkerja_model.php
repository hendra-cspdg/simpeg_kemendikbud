<?php defined('BASEPATH') || exit('No direct script access allowed');

class Unitkerja_model extends BF_Model
{
    protected $table_name	= 'unitkerja';
	protected $key			= 'ID';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= false;
	protected $set_modified = false;
	protected $soft_deletes	= true;


	// Customize the operations of the model without recreating the insert,
    // update, etc. methods by adding the method names to act as callbacks here.
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 	    = array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	// For performance reasons, you may require your model to NOT return the id
	// of the last inserted row as it is a bit of a slow method. This is
    // primarily helpful when running big loops over data.
	protected $return_insert_id = true;

	// The default type for returned row data.
	protected $return_type = 'object';

	// Items that are always removed from data prior to inserts or updates.
	protected $protected_attributes = array();

	// You may need to move certain rules (like required) into the
	// $insert_validation_rules array and out of the standard validation array.
	// That way it is only required during inserts, not updates which may only
	// be updating a portion of the data.
	protected $validation_rules 		= array(
		array(
			'field' => 'NAMA_UNOR',
			'label' => 'NAMA UNOR',
			'rules' => 'required',
		),
		
	);
	protected $insert_validation_rules  = array();
	protected $skip_validation 			= false;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
	public function get_satker($unor_id_inc,$withme = true){
		$data = $this->cache->get('unors');
		if($data==null){
			$rows = $this->db->from("hris.unitkerja")->get()->result();
			foreach($rows as $row){
				$data[$row->ID] = $row;
			}
			$this->cache->write($data,'unors');
		}
		if($data!=null){
			$node = isset($data[$unor_id_inc])?$data[$unor_id_inc] : null;
			$parent = isset($data[$data[$unor_id_inc]->PARENT_ID])?$data[$data[$unor_id_inc]->PARENT_ID]:null;
			while($parent!=NULL){
				echo "tx";
				if($parent->IS_SATKER) {
					echo "found";
					return $parent;
				}					
				$parent = isset($data[$data[$parent->ID]->PARENT_ID])?$data[$data[$parent->ID]->PARENT_ID]:null;
			}
		}
		return null;
	}
	public function get_parent_path($unor_id_inc,$withme = true,$as_array = true){
		$data = $this->cache->get('unors');
		if($data==null){
			$rows = $this->db->from("hris.unitkerja")->get()->result();
			foreach($rows as $row){
				$data[$row->ID] = $row;
			}
			$this->cache->write($data,'unors');
		}
		$path = array();
		if($data!=null){
			$node = isset($data[$unor_id_inc])?$data[$unor_id_inc] : null;
			if($node && $withme){
				$path[] = $node;
			}
			$parent = isset($data[$data[$unor_id_inc]->PARENT_ID])?$data[$data[$unor_id_inc]->PARENT_ID]:null;
			while($parent!=NULL){
				$path[] = $parent;
				if($parent->IS_SATKER) break;
				$parent = isset($data[$data[$parent->ID]->PARENT_ID])?$data[$data[$parent->ID]->PARENT_ID]:null;
			}
		}
		if($as_array){
			return $path;		
		}
		else {
			$path_string = array();
			foreach($path as $row){
				$path_string[] = $row->NAMA_UNOR;
			}
			return implode(" - ",$path_string);
		}
	}
	public function find_first_row(){
		return $this->db->get($this->db->schema.".".$this->table_name)->first_row();
	}
	public function getFullNameWithData($data){
		if(!$data){
			return "";
		}
		$names = array();
		if(!empty($data->NAMA_ESELON_I)){
			$names[] = $data->NAMA_ESELON_I;
		}
		if(!empty($data->NAMA_ESELON_II)){
			$names[] = $data->NAMA_ESELON_II;
		}
		if(!empty($data->NAMA_ESELON_III)){
			$names[] = $data->NAMA_ESELON_III;
		}
		if(!empty($data->NAMA_ESELON_IV)){
			$names[] = $data->NAMA_ESELON_IV;
		}
		return implode(" - ",$names);
	}
	public function getFullName($id){
		$data = $this->find($id);
		$names = array();
		if(!empty($data->NAMA_ESELON_I)){
			$names[] = $data->NAMA_ESELON_I;
		}
		if(!empty($data->NAMA_ESELON_II)){
			$names[] = $data->NAMA_ESELON_II;
		}
		if(!empty($data->NAMA_ESELON_III)){
			$names[] = $data->NAMA_ESELON_III;
		}
		if(!empty($data->NAMA_ESELON_IV)){
			$names[] = $data->NAMA_ESELON_IV;
		}
		return implode(" - ",$names);
	}
	public function getShortNameWithData($data){
		$names = array();
		$eselon = $data->ESELON;
		$eselon_arr = explode(".",$eselon);
		if($eselon_arr[0]=="I"){
			return $data->NAMA_ESELON_I;
		}
		else if($eselon_arr[0]=="II"){
			return $data->NAMA_ESELON_II;
		}
		else if($eselon_arr[0]=="III"){
			return $data->NAMA_ESELON_III;
		}
		else if($eselon_arr[0]=="IV"){
			return $data->NAMA_ESELON_IV;
		}
		return "-";
	}
	public function getShortName($id){
		$data = $this->find($id);
		$names = array();
		$eselon = $data->ESELON;
		$eselon_arr = explode(".",$eselon);
		if($eselon_arr[0]=="I"){
			return $data->NAMA_ESELON_I;
		}
		else if($eselon_arr[0]=="II"){
			return $data->NAMA_ESELON_II;
		}
		else if($eselon_arr[0]=="III"){
			return $data->NAMA_ESELON_III;
		}
		else if($eselon_arr[0]=="IV"){
			return $data->NAMA_ESELON_IV;
		}
		return "-";
	}
	public function getChildren($parents=array(),&$children=array(),$onlyID = true,$include_sub=false,$includeMe = false,$first = true){
		$data = $this->cache->get('unors');
		if(!is_array($parents)){
			$parents = array($parents);
		}
		
		foreach($parents as $parent){
			foreach($data as $node){
				if($first && $includeMe){ //memasukan me sebagai child dari me
					if($node->ID == $parent){
						if($onlyID){
							$children[] = $node->ID;
						}
						else $children[] = $node;
					}
				}
				if($node->PARENT_ID == $parent){
					if($onlyID){
							$children[] = $node->ID;
					}
					else $children[] = $node;
					if($include_sub){
						$this->getChildren($node->ID,$children,$onlyID,$include_sub,$includeMe,false);
					}
				}
			}
		}
	}
}