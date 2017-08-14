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
	protected $skip_validation 			= true;

    /**
     * Constructor
     *
     * @return void
     */
    
    public function find_all($satker = "")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if($satker != ""){
			$this->unitkerja_model->where('UNOR_INDUK',$satker);
		}
		return parent::find_all();
	}
	public function get_cache(){
		$data = $this->cache->get('unors');
		if($data==null){
			$rows=  $this->db->query('
				select unor.* from (
					select uk."ID",uk."NO",uk."NAMA_UNOR",uk."NAMA_JABATAN",uk."NAMA_PEJABAT",uk."DIATASAN_ID",count(children."ID")as "TOTAL_CHILD",uk."PEMIMPIN_PNS_ID" 
					from hris.unitkerja uk
					left join  hris.unitkerja children on uk."ID" = children."DIATASAN_ID"
					group by uk."ID",uk."NO",uk."NAMA_UNOR",uk."DIATASAN_ID",uk."PEMIMPIN_PNS_ID",uk."NAMA_JABATAN",uk."NAMA_PEJABAT"
				) as unor 
				left join hris.pegawai pejabat on pejabat."PNS_ID" = unor."PEMIMPIN_PNS_ID"	
			')->result();
			foreach($rows as $row){
				$data[$row->ID] = $row;
			}
			$this->cache->write($data,'unors');
		}
		return $data;
	}
	public function get_satker($unor_id_inc,$withme = true){
		$data = $this->get_cache();
		if($data!=null){
			$node = isset($data[$unor_id_inc])?$data[$unor_id_inc] : null;
			$parent = isset($data[$data[$unor_id_inc]->DIATASAN_ID])?$data[$data[$unor_id_inc]->DIATASAN_ID]:null;
			while($parent!=NULL){
				echo "tx";
				if($parent->IS_SATKER) {
					echo "found";
					return $parent;
				}					
				$parent = isset($data[$data[$parent->ID]->DIATASAN_ID])?$data[$data[$parent->ID]->DIATASAN_ID]:null;
			}
		}
		return null;
	}
	public function get_parent_path($unor_id_inc,$withme = true,$as_array = true){
		$data = $data = $this->get_cache();
		$path = array();
		$maxlooping = 10;
		$loop = 0;
		if($data!=null){
			$node = isset($data[$unor_id_inc])?$data[$unor_id_inc] : null;
			if($node && $withme){
				$path[] = $node;
			}
			$parent = isset($data[$data[$unor_id_inc]->DIATASAN_ID])?$data[$data[$unor_id_inc]->DIATASAN_ID]:null;
			
			while($parent!=NULL){
				if($loop>$maxlooping) break;
				$path[] = $parent;
				if($parent->IS_SATKER) break;
				$parent = isset($data[$data[$parent->ID]->DIATASAN_ID])?$data[$data[$parent->ID]->DIATASAN_ID]:null;
				
				$loop++;
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
	public function getChildren($parents=array(),&$children=array(),$onlyID = true,$include_sub=false,$includeMe = false,$first = true,$propertyKey="ID"){
		$data = $this->get_cache();
		if(!is_array($parents)){
			$parents = array($parents);
		}
		
		foreach($parents as $parent){
			foreach($data as $node){
				if($first && $includeMe){ //memasukan me sebagai child dari me
					if($node->ID == $parent){
						if($onlyID){
							if($propertyKey=="ID"){
								$children[] = $node->ID;
							}
							else {
								$children[] = $node->ID;
							}
						}
						else $children[] = $node;
					}
				}
				if($node->DIATASAN_ID == $parent){
					if($onlyID){
							if($propertyKey=="ID"){
								$children[] = $node->ID;
							}
							else {
								$children[] = $node->ID;
							}
					}
					else $children[] = $node;
					if($include_sub){
						$this->getChildren($node->ID,$children,$onlyID,$include_sub,$includeMe,false,$propertyKey);
					}
				}
			}
		}
	}
	public function find_eselon3($eselon2 ="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if($eselon2 != ""){
			//$this->unitkerja_model->where("DIATASAN_ID",strtoupper($eselon2));
			$this->unitkerja_model->where('"KODE_INTERNAL" LIKE \''.strtoupper($eselon2).'%\'');
			//$this->unitkerja_model->where('"ESELON" LIKE \'III.%\'');
		}
		return parent::find_all();
	}
	public function find_eselon4($eselon2 ="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if($eselon2 != ""){
			//$this->unitkerja_model->where("DIATASAN_ID",strtoupper($eselon2));
			$this->unitkerja_model->where('"KODE_INTERNAL" LIKE \''.strtoupper($eselon2).'%\'');
			//$this->unitkerja_model->where('"ESELON" LIKE \'IV.%\'');
		}
		return parent::find_all();
	}
	public function find_satker()
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		$this->unitkerja_model->where('"ID" in (select "UNOR_INDUK" from hris.unitkerja)');
		return parent::find_all();
	}
	public function find_by_id($id='')
	{
		$this->db->from('vw_unit_list vw');
		$this->db->like('lower(vw."NAMA_UNOR")',strtolower($key),"BOTH");
		if($id!=''){
			$this->db->group_start();
			$this->db->where('vw."ID"',$id);
			$this->db->group_end();
		}
		$this->db->order_by('vw."NAMA_UNOR_ESELON_1"',"ASC");
		$this->db->order_by('vw."NAMA_UNOR_ESELON_2"',"ASC");
		$this->db->order_by('vw."NAMA_UNOR_ESELON_3"',"ASC");
		$this->db->order_by('vw."NAMA_UNOR_ESELON_4"',"ASC");
		if($id!=''){ 
			$row=  $this->db->get()->first_row();
			
			return $row;
		}
		return $this->db->get()->result();
	}
	public function find_unit($key='',$id='')
	{
		$this->db->from('vw_unit_list vw');
		$this->db->like('lower(vw."NAMA_UNOR")',strtolower($key),"BOTH");
		if($id!=''){
			$this->db->group_start();
			$this->db->where('vw."ID"',$id);
			$this->db->or_where('vw."ESELON_1"',$id);
			$this->db->or_where('vw."ESELON_2"',$id);
			$this->db->or_where('vw."ESELON_3"',$id);
			$this->db->or_where('vw."ESELON_4"',$id);
			$this->db->group_end();
		}
		$this->db->order_by('vw."NAMA_UNOR_FULL"',"ASC");
		return $this->db->get()->result();
	}
	public function count_satker($unor_id='')
	{
		if($unor_id !=''){
			$this->db->where("(ID = '".$unor_id."' or ESELON_1 = '".$unor_id."' or ESELON_2 = '".$unor_id."' or ESELON_3 = '".$unor_id."' or ESELON_4 = '".$unor_id."')");
		}
		if(empty($this->selects))
		{
			$this->select('count(distinct "UNOR_INDUK") AS jumlah');
		}
		return parent::find_all();
	}
	public function find_satkerold()
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		$this->unitkerja_model->where('IS_SATKER',1);
		return parent::find_all();
	}
	public function findnamajabatan($UNOR = "")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		return parent::find_by('KODE_INTERNAL',$UNOR);
	}
}