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

    protected $deleted_field     = 'deleted';

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
			'field' => 'NAMA',
			'label' => 'lang:agama_field_NAMA',
			'rules' => 'required|unique[agama.NAMA,agama.ID]|max_length[20]',
		),
		array(
			'field' => 'NCSISTIME',
			'label' => 'lang:agama_field_NCSISTIME',
			'rules' => 'max_length[30]',
		),
	);
	protected $insert_validation_rules  = array();
	protected $skip_validation 			= true;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function find_eselon3($eselon2 ="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if($eselon2 != ""){
			$this->unitkerja_model->where('"ID" LIKE \''.strtoupper($eselon2).'%\'');
			$this->unitkerja_model->where('"ESELON" LIKE \'III.%\'');
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
			$this->unitkerja_model->where('"ID" LIKE \''.strtoupper($eselon2).'%\'');
			$this->unitkerja_model->where('"ESELON" LIKE \'IV.%\'');
		}
		return parent::find_all();
	}
}