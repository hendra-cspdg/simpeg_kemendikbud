<?php defined('BASEPATH') || exit('No direct script access allowed');

class Riwayat_jabatan_model extends BF_Model
{
    protected $table_name	= 'rwt_jabatan';
	protected $key			= 'ID';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= false;
	protected $set_modified = false;
	protected $soft_deletes	= false;


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
			'field' => 'PNS_ID',
			'label' => 'PNS ID',
			'rules' => 'max_length[32]|required',
		),
		array(
			'field' => 'NOMOR_SK',
			'label' => 'NO SK',
			'rules' => 'required',
		),
		array(
			'field' => 'TANGGAL_SK',
			'label' => 'TANGGAL SK',
			'rules' => 'required',
		),
		array(
			'field' => 'TMT_JABATAN',
			'label' => 'TMT JABATAN',
			'rules' => 'required',
		),
		array(
			'field' => 'ID_JENIS_JABATAN',
			'label' => 'JENIS JABATAN',
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
    public function __construct()
    {
        parent::__construct();
    }
    public function find_all($PNS_ID ="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,satker."NAMA_UNOR" AS "NAMA_SATKER", unit."NAMA_UNOR",unit."ID" as "UNIT_ID"');
		}
		if($PNS_ID!=""){
			$this->db->where('PNS_ID',$PNS_ID);
		}
		$this->db->join("hris.unitkerja as unit","rwt_jabatan.ID_UNOR=unit.KODE_INTERNAL", 'left');
		$this->db->join("hris.unitkerja as satker",'unit.UNOR_INDUK=satker.ID', 'left');
		return parent::find_all();
	}
	public function update($id,$data,$posts){
		if(isset($posts['IS_ACTIVE']) and $posts['IS_ACTIVE'] == "1"){
			// update semua jadi inactive
			$dataupdate = array();
        	$dataupdate["IS_ACTIVE"] = '';
			$this->riwayat_jabatan_model->update_where("PNS_ID",$posts["PNS_ID"], $dataupdate);
			// update jadi active yang terpilih
			$dataupdate = array();
			$rec_jenis = $this->jenis_jabatan_model->find($posts["ID_JENIS_JABATAN"]);
        	$dataupdate["JENIS_JABATAN_ID"] = $posts["ID_JENIS_JABATAN"];
			$dataupdate["JENIS_JABATAN_NAMA"] = $rec_jenis->NAMA;
			$dataupdate['JABATAN_INSTANSI_ID']	= $posts['ID_JABATAN'];
			$rec_jabatan = $this->jabatan_model->find_by("KODE_JABATAN",$posts["ID_JABATAN"]);
        	$dataupdate["JABATAN_INSTANSI_NAMA"] = $rec_jabatan->NAMA_JABATAN;
			$this->pegawai_model->update_where("PNS_ID",$posts["PNS_ID"], $dataupdate);
			
			// update tabel unirkerja jika pilihan adalah pejabat struktural
			if($posts["ID_JENIS_JABATAN"] == "1"){
			 
			   $adata = array();
			   $this->pegawai_model->where("PNS_ID",$posts["PNS_ID"]);
			   $pegawai_data = $this->pegawai_model->find_first_row();  
			   $adata["NAMA_PEJABAT"] = $pegawai_data->NAMA;
			   $adata["PEMIMPIN_PNS_ID"] = trim($posts["PNS_ID"]);
			   $this->unitkerja_model->update_where("ID",TRIM($posts["ID_UNOR"]), $adata);
			   //die($posts["ID_UNOR").$pegawai_data->NAMA."masuk");
			}
			// end
			
		}
		return parent::update($id,$data);
	}
	public function insert($data,$posts){
		if(isset($posts['IS_ACTIVE']) and $posts['IS_ACTIVE'] == "1"){
			// update semua jadi inactive
			$dataupdate = array();
        	$dataupdate["IS_ACTIVE"] = '';
			$this->riwayat_jabatan_model->update_where("PNS_ID",$posts["PNS_ID"], $dataupdate);
			// update jadi active yang terpilih
			$dataupdate = array();
			$rec_jenis = $this->jenis_jabatan_model->find($posts["ID_JENIS_JABATAN"]);
        	$dataupdate["JENIS_JABATAN_ID"] = $posts["ID_JENIS_JABATAN"];
			$dataupdate["JENIS_JABATAN_NAMA"] = $rec_jenis->NAMA;
			$dataupdate['JABATAN_INSTANSI_ID']	= $posts['ID_JABATAN'];
			$rec_jabatan = $this->jabatan_model->find_by("KODE_JABATAN",$posts["ID_JABATAN"]);
        	$dataupdate["JABATAN_INSTANSI_NAMA"] = $rec_jabatan->NAMA_JABATAN;
			$this->pegawai_model->update_where("PNS_ID",$posts["PNS_ID"], $dataupdate);
			
			// update tabel unirkerja jika pilihan adalah pejabat struktural
			if($posts["ID_JENIS_JABATAN"] == "1"){
			 
			   $adata = array();
			   $this->pegawai_model->where("PNS_ID",$posts["PNS_ID"]);
			   $pegawai_data = $this->pegawai_model->find_first_row();  
			   $adata["NAMA_PEJABAT"] = $pegawai_data->NAMA;
			   $adata["PEMIMPIN_PNS_ID"] = trim($posts["PNS_ID"]);
			   $this->unitkerja_model->update_where("ID",TRIM($posts["ID_UNOR"]), $adata);
			   //die($posts["ID_UNOR").$pegawai_data->NAMA."masuk");
			}
			// end
			
		}
		return parent::insert($data);
	}
}