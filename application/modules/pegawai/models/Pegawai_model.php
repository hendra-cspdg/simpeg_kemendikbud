<?php defined('BASEPATH') || exit('No direct script access allowed');

class Pegawai_model extends BF_Model
{
    protected $table_name	= 'pegawai';
	protected $key			= 'id';
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
			'field' => 'NIP_Lama',
			'label' => 'lang:pegawai_field_NIP_Lama',
			'rules' => 'max_length[9]|required',
		),
		array(
			'field' => 'Nip_Baru',
			'label' => 'lang:pegawai_field_Nip_Baru',
			'rules' => 'max_length[18]',
		),
		array(
			'field' => 'Nama',
			'label' => 'lang:pegawai_field_Nama',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'Gelar_Depan',
			'label' => 'lang:pegawai_field_Gelar_Depan',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Gelar_Blk',
			'label' => 'lang:pegawai_field_Gelar_Blk',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Tempat_Lahir_ID',
			'label' => 'lang:pegawai_field_Tempat_Lahir_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Tgl_Lahir',
			'label' => 'lang:pegawai_field_Tgl_Lahir',
			'rules' => '',
		),
		array(
			'field' => 'Jenis_Kelamin',
			'label' => 'lang:pegawai_field_Jenis_Kelamin',
			'rules' => 'max_length[2]',
		),
		array(
			'field' => 'Agama_ID',
			'label' => 'lang:pegawai_field_Agama_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'Jenis_Kawin_ID',
			'label' => 'lang:pegawai_field_Jenis_Kawin_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'NIK',
			'label' => 'lang:pegawai_field_NIK',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'Nomor_Darurat',
			'label' => 'lang:pegawai_field_Nomor_Darurat',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'Nomor_HP',
			'label' => 'lang:pegawai_field_Nomor_HP',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'Email',
			'label' => 'lang:pegawai_field_Email',
			'rules' => 'max_length[200]',
		),
		array(
			'field' => 'Alamat',
			'label' => 'lang:pegawai_field_Alamat',
			'rules' => '',
		),
		array(
			'field' => 'NPWP_Nomor',
			'label' => 'lang:pegawai_field_NPWP_Nomor',
			'rules' => 'max_length[25]',
		),
		array(
			'field' => 'BPJS',
			'label' => 'lang:pegawai_field_BPJS',
			'rules' => 'max_length[25]',
		),
		array(
			'field' => 'Jenis_Pegawai_ID',
			'label' => 'lang:pegawai_field_Jenis_Pegawai_ID',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'Kedudukan_Hukum_ID',
			'label' => 'lang:pegawai_field_Kedudukan_Hukum_ID',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'Status_CPNS_PNS',
			'label' => 'lang:pegawai_field_Status_CPNS_PNS',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Kartu_Pegawai',
			'label' => 'lang:pegawai_field_Kartu_Pegawai',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Nomor_SK_CPNS',
			'label' => 'lang:pegawai_field_Nomor_SK_CPNS',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Tgl_SK_CPNS',
			'label' => 'lang:pegawai_field_Tgl_SK_CPNS',
			'rules' => '',
		),
		array(
			'field' => 'TMT_CPNS',
			'label' => 'lang:pegawai_field_TMT_CPNS',
			'rules' => '',
		),
		array(
			'field' => 'TMT_PNS',
			'label' => 'lang:pegawai_field_TMT_PNS',
			'rules' => '',
		),
		array(
			'field' => 'Gol_Awal_ID',
			'label' => 'lang:pegawai_field_Gol_Awal_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Gol_ID',
			'label' => 'lang:pegawai_field_Gol_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'TMT_Golongan',
			'label' => 'lang:pegawai_field_TMT_Golongan',
			'rules' => '',
		),
		array(
			'field' => 'MK_Tahun',
			'label' => 'lang:pegawai_field_MK_Tahun',
			'rules' => 'max_length[4]',
		),
		array(
			'field' => 'MK_Bulan',
			'label' => 'lang:pegawai_field_MK_Bulan',
			'rules' => 'max_length[10]',
		),
		array(
			'field' => 'Jenis_Jabatan_ID',
			'label' => 'lang:pegawai_field_Jenis_Jabatan_ID',
			'rules' => 'max_length[21]',
		),
		array(
			'field' => 'Jabatan_ID',
			'label' => 'lang:pegawai_field_Jabatan_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'TMT_Jabatan',
			'label' => 'lang:pegawai_field_TMT_Jabatan',
			'rules' => '',
		),
		array(
			'field' => 'Pendidkan_ID',
			'label' => 'lang:pegawai_field_Pendidkan_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'Tahun_Lulus',
			'label' => 'lang:pegawai_field_Tahun_Lulus',
			'rules' => 'max_length[4]',
		),
		array(
			'field' => 'KPKN_ID',
			'label' => 'lang:pegawai_field_KPKN_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'Lokasi_Kerja_ID',
			'label' => 'lang:pegawai_field_Lokasi_Kerja_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'Unor_ID',
			'label' => 'lang:pegawai_field_Unor_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'Unor_induk_ID',
			'label' => 'lang:pegawai_field_Unor_induk_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Instansi_Induk_ID',
			'label' => 'lang:pegawai_field_Instansi_Induk_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Instansi_Kerja_ID',
			'label' => 'lang:pegawai_field_Instansi_Kerja_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Satuan_kerja_Induk_ID',
			'label' => 'lang:pegawai_field_Satuan_kerja_Induk_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Satuan_Kerja_Kerja_ID',
			'label' => 'lang:pegawai_field_Satuan_Kerja_Kerja_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'Golongan_Darah',
			'label' => 'lang:pegawai_field_Golongan_Darah',
			'rules' => 'max_length[11]',
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
	public function find_first_row(){
		return $this->db->get($this->db->schema.".".$this->table_name)->first_row();
	}
    public function find_detil($ID ="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,jenis_pegawai.NAMA as Jenis_Pegawai,kedudukan_hukum.NAMA AS Kedudukan_Hukum');
		}
		 
		$this->db->join('jenis_pegawai', 'pegawai.Jenis_Pegawai_ID = jenis_pegawai.ID', 'left');
		$this->db->join('kedudukan_hukum', 'pegawai.Kedudukan_Hukum_ID = kedudukan_hukum.ID', 'left');
		return parent::find($ID);
	}
}