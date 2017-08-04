<?php defined('BASEPATH') || exit('No direct script access allowed');

class Pegawai_model extends BF_Model
{
    protected $table_name	= 'pegawai';
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
			'field' => 'NIP_LAMA',
			'label' => 'lang:pegawai_field_NIP_LAMA',
			'rules' => 'max_length[9]',
		),
		array(
			'field' => 'NIP_BARU',
			'label' => 'lang:pegawai_field_NIP_BARU',
			'rules' => 'max_length[18]',
		),
		array(
			'field' => 'NAMA',
			'label' => 'lang:pegawai_field_NAMA',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'GELAR_DEPAN',
			'label' => 'lang:pegawai_field_GELAR_DEPAN',
			'rules' => 'max_length[20]',
		),
		array(
			'field' => 'GELAR_BELAKANG',
			'label' => 'lang:pegawai_field_GELAR_BELAKANG',
			'rules' => 'max_length[20]',
		),
		array(
			'field' => 'TEMPAT_LAHIR_ID',
			'label' => 'lang:pegawai_field_TEMPAT_LAHIR_ID',
			'rules' => 'max_length[60]',
		),
		array(
			'field' => 'TGL_LAHIR',
			'label' => 'lang:pegawai_field_TGL_LAHIR',
			'rules' => '',
		),
		array(
			'field' => 'JENIS_KELAMIN',
			'label' => 'lang:pegawai_field_JENIS_KELAMIN',
			'rules' => 'max_length[2]|required',
		),
		array(
			'field' => 'AGAMA_ID',
			'label' => 'lang:pegawai_field_AGAMA_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'JENIS_KAWIN_ID',
			'label' => 'lang:pegawai_field_JENIS_KAWIN_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'NIK',
			'label' => 'lang:pegawai_field_NIK',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'NOMOR_DARURAT',
			'label' => 'lang:pegawai_field_NOMOR_DARURAT',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'NOMOR_HP',
			'label' => 'lang:pegawai_field_NOMOR_HP',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'EMAIL',
			'label' => 'lang:pegawai_field_EMAIL',
			'rules' => 'max_length[200]',
		),
		array(
			'field' => 'ALAMAT',
			'label' => 'lang:pegawai_field_ALAMAT',
			'rules' => '',
		),
		array(
			'field' => 'NPWP',
			'label' => 'lang:pegawai_field_NPWP',
			'rules' => 'max_length[25]',
		),
		array(
			'field' => 'BPJS',
			'label' => 'lang:pegawai_field_BPJS',
			'rules' => 'max_length[25]',
		),
		array(
			'field' => 'JENIS_PEGAWAI_ID',
			'label' => 'lang:pegawai_field_JENIS_PEGAWAI_ID',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'KEDUDUKAN_HUKUM_ID',
			'label' => 'lang:pegawai_field_KEDUDUKAN_HUKUM_ID',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'STATUS_CPNS_PNS',
			'label' => 'lang:pegawai_field_STATUS_CPNS_PNS',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'KARTU_PEGAWAI',
			'label' => 'lang:pegawai_field_KARTU_PEGAWAI',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'NOMOR_SK_CPNS',
			'label' => 'lang:pegawai_field_NOMOR_SK_CPNS',
			'rules' => 'max_length[30]',
		),
		array(
			'field' => 'TGL_SK_CPNS',
			'label' => 'lang:pegawai_field_TGL_SK_CPNS',
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
			'field' => 'GOL_AWAL_ID',
			'label' => 'lang:pegawai_field_GOL_AWAL_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'GOL_ID',
			'label' => 'lang:pegawai_field_GOL_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'TMT_GOLONGAN',
			'label' => 'lang:pegawai_field_TMT_GOLONGAN',
			'rules' => '',
		),
		array(
			'field' => 'MK_TAHUN',
			'label' => 'lang:pegawai_field_MK_TAHUN',
			'rules' => 'max_length[4]',
		),
		array(
			'field' => 'MK_BULAN',
			'label' => 'lang:pegawai_field_MK_BULAN',
			'rules' => 'max_length[10]',
		),
		array(
			'field' => 'JENIS_JABATAN_ID',
			'label' => 'lang:pegawai_field_JENIS_JABATAN_ID',
			'rules' => 'max_length[21]',
		),
		array(
			'field' => 'JABATAN_ID',
			'label' => 'lang:pegawai_field_JABATAN_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'TMT_JABATAN',
			'label' => 'lang:pegawai_field_TMT_JABATAN',
			'rules' => '',
		),
		array(
			'field' => 'PENDIDIKAN_ID',
			'label' => 'lang:pegawai_field_PENDIDIKAN_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'TAHUN_LULUS',
			'label' => 'lang:pegawai_field_TAHUN_LULUS',
			'rules' => 'max_length[4]',
		),
		array(
			'field' => 'KPKN_ID',
			'label' => 'lang:pegawai_field_KPKN_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'LOKASI_KERJA_ID',
			'label' => 'lang:pegawai_field_LOKASI_KERJA_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'UNOR_ID',
			'label' => 'lang:pegawai_field_UNOR_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'UNOR_INDUK_ID',
			'label' => 'lang:pegawai_field_UNOR_INDUK_ID',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'INSTANSI_INDUK_ID',
			'label' => 'lang:pegawai_field_INSTANSI_INDUK_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'INSTANSI_KERJA_ID',
			'label' => 'lang:pegawai_field_INSTANSI_KERJA_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'SATUAN_KERJA_INDUK_ID',
			'label' => 'lang:pegawai_field_SATUAN_KERJA_INDUK_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'SATUAN_KERJA_KERJA_ID',
			'label' => 'lang:pegawai_field_SATUAN_KERJA_KERJA_ID',
			'rules' => 'max_length[11]',
		),
		array(
			'field' => 'GOLONGAN_DARAH',
			'label' => 'lang:pegawai_field_GOLONGAN_DARAH',
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
   	protected $CI;
   	protected $UNOR_ID;
	function __construct()
    {
		$this->CI = &get_instance();
		if($this->CI->auth->role_id() =="5"){
			$this->UNOR_ID = $this->getunor_id($this->CI->auth->username());
		}
		$selected_unit = $this->CI->input->get('unit_id');
		if($selected_unit){
			$this->UNOR_ID = $selected_unit;
		}
    }//end __construct
	public function find_first_row(){
		return $this->db->get($this->db->schema.".".$this->table_name)->first_row();
	}
	public function count_all($satker_id){
		
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		$this->db->join("vw_unit_list as vw","pegawai.\"UNOR_ID\"=vw.\"ID\" $where_clause ", 'left',false);
		$this->db->where('vw."ID" is not null');
		
		return parent::count_all();
	}
	public function find_all($satker_id){
		
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		$this->db->select('pegawai.*,vw."NAMA_UNOR_FULL"',false);
		$this->db->join("vw_unit_list as vw","pegawai.\"UNOR_ID\"=vw.\"ID\" $where_clause ", 'left',false);
		$this->db->where('vw."ID" is not null');
		$this->db->order_by("NAMA","ASC");
		return parent::find_all();
	}
	
	
	public function find_kelompokjabatan(){
		$this->db->select('pegawai."ID",pegawai."NAMA","NIP_BARU",golongan."NAMA"  as "NAMA_GOLONGAN"',false);
		$this->db->join('golongan', 'pegawai.GOL_ID = golongan.ID', 'left');
		$this->db->order_by("pegawai.GOL_ID","DESC");
		return parent::find_all();
	}
	public function count_kelompokjabatan(){
		$this->db->select('pegawai."ID",pegawai."NAMA","NIP_BARU",golongan."NAMA"  as "NAMA_GOLONGAN"',false);
		$this->db->join('golongan', 'pegawai.GOL_ID = golongan.ID', 'left');
		return parent::count_all();
	}
    public function find_detil($ID ="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,jenis_pegawai.NAMA as JENIS_PEGAWAI,kedudukan_hukum.NAMA AS KEDUDUKAN_HUKUM');
		}
		$this->db->join('jenis_pegawai', 'pegawai.JENIS_PEGAWAI_ID = jenis_pegawai.ID', 'left');
		$this->db->join('kedudukan_hukum', 'pegawai.KEDUDUKAN_HUKUM_ID = kedudukan_hukum.ID', 'left');
		
		return parent::find($ID);
	}
	public function find_grupjabatan($eselon2 ="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.JABATAN_ID,UNOR_ID,count(pegawai."JABATAN_ID") as jumlah');
		}
		if($eselon2 != ""){
			$this->db->where('"UNOR_ID" LIKE \''.strtoupper($eselon2).'%\'');
		}
		//$this->db->join('ref_jabatan', 'ref_jabatan.ID_Jabatan = JABATAN_ID', 'left');
		$this->db->group_by("JABATAN_ID");
		$this->db->group_by("UNOR_ID");
		return parent::find_all();
	}
	// update yanarazor
	public function find_grupagama($satker_id){		
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		$this->db->join("vw_unit_list as vw","pegawai.\"UNOR_ID\"=vw.\"ID\" $where_clause ", 'left',false);
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.AGAMA_ID,agama.NAMA AS label,sum(case when vw."ID" is not null  then 1 else 0  end) as value');
		}
		if($eselon2 != ""){
			$this->db->where('"UNOR_ID" LIKE \''.strtoupper($eselon2).'%\'');
		}
		$this->db->group_by("AGAMA_ID");
		$this->db->group_by("agama.NAMA");
		$this->db->join('agama', 'pegawai.AGAMA_ID = agama.ID', 'left');
		return parent::find_all();
	}
	public function group_by_range_umur($satker_id){		
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		$this->db->select('	 sum(CASE WHEN vw."ID" is not null AND  "AGE" < 25 THEN 1 else 0 END) "<25"
							,sum(CASE WHEN vw."ID" is not null AND  "AGE" >= 25  AND "AGE" <= 30 THEN 1 else 0 END) "25-30"
							,sum(CASE WHEN vw."ID" is not null AND  "AGE" >= 31  AND "AGE" <= 35 THEN 1 else 0 END) "31-35"
							,sum(CASE WHEN vw."ID" is not null AND  "AGE" >= 36  AND "AGE" <= 40 THEN 1 else 0 END) "36-40"
							,sum(CASE WHEN vw."ID" is not null AND  "AGE" >= 41  AND "AGE" <= 45 THEN 1 else 0 END) "41-45"
							,sum(CASE WHEN vw."ID" is not null AND  "AGE" >= 46  AND "AGE" <= 50 THEN 1 else 0 END) "46-50"
							,sum(CASE WHEN vw."ID" is not null AND  "AGE" > 50 THEN 1 END) ">50"
										',false);
		$this->db->from("daftar_pegawai");
		$this->db->join("vw_unit_list as vw","daftar_pegawai.\"UNOR_ID\"=vw.\"ID\" $where_clause ", 'left',false);
		return $this->db->get()->result('array');								
	}
	public function grupbygolongan()
	{
		 
		if(empty($this->selects))
		{
			$this->select('golongan.NAMA,count(pegawai."GOL_ID") as jumlah');
		}
		 
		$this->db->join('golongan', 'pegawai.GOL_ID = golongan.ID', 'left');
		$this->db->group_by('pegawai.GOL_ID');
		$this->db->group_by('golongan.NAMA');
		return parent::find_all();
	}
	public function grupbypangkat()
	{
		 
		if(empty($this->selects))
		{
			$this->select('count(pegawai."JABATAN_ID") as jumlah');
		}
		//$this->db->join('ref_jabatan', 'pegawai.JABATAN_ID = ref_jabatan.ID_JABATAN', 'left');
		$this->db->group_by('JABATAN_ID');
		return parent::find_all();
	}
	public function grupbypendidikan($satker_id){		
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}

		if(empty($this->selects))
		{
			$this->select('tkpendidikan.NAMA as NAMA_PENDIDIKAN,sum(case when vw."ID" is not null  then 1 else 0  end) as jumlah');
		}
		$this->db->join('pendidikan', 'pegawai.PENDIDIKAN_ID = pendidikan.ID', 'left');
		$this->db->join('tkpendidikan', 'pendidikan.TINGKAT_PENDIDIKAN_ID = tkpendidikan.ID', 'left');
		$this->db->join("vw_unit_list as vw","pegawai.\"UNOR_ID\"=vw.\"ID\" $where_clause ", 'left',false);
		$this->db->group_by('tkpendidikan.NAMA');
		$this->db->group_by('tkpendidikan.ID');
		$this->db->order_by('tkpendidikan.ID',"ASC");
		return parent::find_all();
	}
	public function grupbyjk($satker_id){		
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		if($this->CI->auth->role_id() =="5"){
			$this->db->where("(unitkerja.ID = '".$this->UNOR_ID."' or unitkerja.ESELON_1 = '".$this->UNOR_ID."' or unitkerja.ESELON_2 = '".$this->UNOR_ID."' or unitkerja.ESELON_3 = '".$this->UNOR_ID."' or unitkerja.ESELON_4 = '".$this->UNOR_ID."')");
		}
		if(empty($this->selects))
		{
			$this->select('pegawai.JENIS_KELAMIN,sum(case when vw."ID" is not null  then 1 else 0  end) as jumlah');
		}
		$this->db->group_by('pegawai.JENIS_KELAMIN');
		$this->db->join("vw_unit_list as vw","pegawai.\"UNOR_ID\"=vw.\"ID\" $where_clause ", 'left',false);
		return parent::find_all();
	}
	public function count_pensiun(){
		if($this->CI->auth->role_id() =="5"){
			$this->db->where("(unit.ID = '".$this->UNOR_ID."' or unit.ESELON_1 = '".$this->UNOR_ID."' or unit.ESELON_2 = '".$this->UNOR_ID."' or unit.ESELON_3 = '".$this->UNOR_ID."' or unit.ESELON_4 = '".$this->UNOR_ID."')");
		}		
		$this->db->select('pegawai.*');
		$this->db->where('EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) > 58');
		$this->db->join("hris.unitkerja as unit","pegawai.UNOR_ID=unit.ID", 'left');
		return parent::count_all();
	}
	public function find_all_pensiun(){
		if($this->CI->auth->role_id() =="5"){
			$this->db->where("(unitkerja.ID = '".$this->UNOR_ID."' or unitkerja.ESELON_1 = '".$this->UNOR_ID."' or unitkerja.ESELON_2 = '".$this->UNOR_ID."' or unitkerja.ESELON_3 = '".$this->UNOR_ID."' or unitkerja.ESELON_4 = '".$this->UNOR_ID."')");
		}
		$this->db->select('pegawai.*,unitkerja."NAMA_UNOR",EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) as umur');
		$this->db->where('EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) > 58');
		$this->db->join("unitkerja","pegawai.UNOR_ID=unitkerja.ID", 'left');
		return parent::find_all();
	}
	public function find_pentiunpertahun(){
		if($this->CI->auth->role_id() =="5"){
			$this->db->where("(unit.ID = '".$this->UNOR_ID."' or unit.ESELON_1 = '".$this->UNOR_ID."' or unit.ESELON_2 = '".$this->UNOR_ID."' or unit.ESELON_3 = '".$this->UNOR_ID."' or unit.ESELON_4 = '".$this->UNOR_ID."')");
		}
		$this->db->select('EXTRACT(YEAR FROM "TMT_PENSIUN") TAHUN,count("ID") as jumlah');
		$this->db->where('TMT_PENSIUN IS NOT NULL');
		$this->db->group_by('EXTRACT(YEAR FROM "TMT_PENSIUN")');
		$this->db->join("hris.unitkerja as unit","pegawai.UNOR_ID=unit.ID", 'left');
		return parent::find_all();
	}
	public function stats_pensiun_pertahun($satker_id,$tahun_kedepan=5){		
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}

		$db_stats =$this->db->query('
			select perkiraan_tahun_pensiun,sum(CASE  WHEN  temp."ID" is not null THEN 1 else 0 END) 
				as total from (
				select vw."ID","TGL_LAHIR","NIP_BARU","BUP","NAMA", date_part(\'year\', "TGL_LAHIR")+"BUP" as perkiraan_tahun_pensiun 
					from hris.pegawai
					left join vw_unit_list as vw on pegawai."UNOR_ID" = vw."ID" '.$where_clause.'
					where 1=1  
				) as temp
				group by perkiraan_tahun_pensiun
				order by  perkiraan_tahun_pensiun asc 
		')->result('array');
		$tahun = date('Y');
		$tahuns = array();
		for($t=$tahun;$t<=$tahun+$tahun_kedepan;$t++){
			$tahuns[] = array("tahun"=>$t,"jumlah"=>0);
		}
		foreach($tahuns as &$tahun){
			foreach($db_stats as $row){
				if($tahun['tahun']==$row['perkiraan_tahun_pensiun']){
					$tahun['jumlah'] = $row['total'];
					break;
				}
			}
		}
		return $tahuns;
	}
	public function get_duk_list($unit_id=null,$start,$length){
		$output = new stdClass;
		$this->db->start_cache();
		if($unit_id){
			$this->db->group_start();
			$this->db->or_where("ESELON_1",$unit_id);
			$this->db->or_where("ESELON_2",$unit_id);
			$this->db->or_where("ESELON_3",$unit_id);
			$this->db->or_where("ESELON_4",$unit_id);
			$this->db->group_end();
		}
		$this->db->from('vw_duk_list');
		$this->db->stop_cache();
		$total = $this->db->get()->num_rows();
		$this->db->limit($length,$start);
		$data = $this->db->get()->result();
		$output->total = $total;
		$output->data = $data;
		$this->db->flush_cache();
		return $output;
	}	

	public function get_jumlah_pegawai_per_golongan($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		return $this->db->query('
			select golongan."ID" as "id",golongan."NAMA" as "nama",count(vw."ID") as total from hris.golongan
			left join hris.pegawai on  golongan."ID" = pegawai."GOL_ID"
			left join vw_unit_list vw on pegawai."UNOR_ID"= vw."ID" '.$where_clause.'
			group by golongan."ID",golongan."NAMA"
			order by golongan."ID" asc 
		')->result('array');
	}
	public function get_bup_per_range_umur($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
			$data = $this->db->query('
				select 
					 sum(CASE  WHEN  TEMPX."ID" is not null AND age < 25 THEN 1 END) "<25"
					,sum(CASE  WHEN  TEMPX."ID" is not null AND age >= 25  AND age <= 30 THEN 1 END) "25-30"
					,sum(CASE  WHEN  TEMPX."ID" is not null AND age >= 31  AND age <= 35 THEN 1 END) "31-35"
					,sum(CASE  WHEN  TEMPX."ID" is not null AND age >= 36  AND age <= 40 THEN 1 END) "36-40"
					,sum(CASE  WHEN  TEMPX."ID" is not null AND age >= 41  AND age <= 45 THEN 1 END) "41-45"
					,sum(CASE  WHEN  TEMPX."ID" is not null AND age >= 46  AND age <= 50 THEN 1 END) "46-50"
					,sum(CASE  WHEN  TEMPX."ID" is not null AND age > 50 THEN 1 END) ">50",TEMPx."bup"
				FROM (
				SELECT vw."ID",EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) age,pegawai."BUP" as "bup"
				FROM hris.pegawai
				left join vw_unit_list vw on pegawai."UNOR_ID"= vw."ID" '.$where_clause.'
				where 1=1  
				) AS TEMPx 
				group by TEMPx."bup"
			')->result('array');
		$bups = array('58','60');
		$range_umur = array('<25'=>array(),'25-30'=>array(),'31-35'=>array(),'36-40'=>array(),'41-45'=>array(),'46-50'=>array(),'>50'=>array());

		foreach($range_umur as $key=>&$rumur){
			$rumur['range'] = $key;
			foreach($bups as $bup){
				$rumur["bup_".$bup] = 0;	
				foreach($data as $row){
					$rec = new stdClass;
					if(isset($row[$key]) && $row['bup'] == $bup){
						$rumur["bup_".$bup] = $row[$key];	
					}
					else if( !isset($row[$key]) && $row['bup'] == $bup){
						$rumur["bup_".$bup] = 0;	
					}
				}
			}
		}
		return array_values($range_umur);
	}
	public function get_rekap_golongan_per_jenis_kelamin($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
			$data = $this->db->query('
			select TEMPx."nama",sum(CASE  WHEN TEMPX."ID" is not null and jenis_kelamin =\'M\' THEN 1 ELSE 0 END) "M"
																			,sum(CASE  WHEN TEMPX."ID" is not null and jenis_kelamin =\'F\' THEN 1 ELSE 0 END) "F"
																			,sum(CASE  WHEN TEMPX."ID" is not null and jenis_kelamin =NULL THEN 1 ELSE 0 END) "-"
								FROM (
										select vw."ID",golongan."NAMA" as "nama",pegawai."JENIS_KELAMIN" as "jenis_kelamin" from hris.golongan  
										left join hris.pegawai on golongan."ID" = pegawai."GOL_ID"
										left join vw_unit_list vw on pegawai."UNOR_ID"= vw."ID" '.$where_clause.'
										where 1=1 
			)AS TEMPx 
								group by TEMPx."nama"
			order by TEMPx."nama"
		')->result('array');
		return $data;
	}
	public function get_rekap_golongan_per_pendidikan($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		$data = $this->db->query('
			select TEMPx."golongan" as "GOLONGAN"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'SLTP Kejuruan\' then 1 else 0  end) as "SLTP Kejuruan"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'SLTA Kejuruan\' then 1 else 0  end) as "SLTA Kejuruan"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'Sekolah Dasar\' then 1 else 0  end) as "Sekolah Dasar"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'SLTP\' then 1 else 0  end) as "SLTP"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'SLTA\' then 1 else 0  end) as "SLTA"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'Diploma I\' then 1 else 0  end) as "Diploma I"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'Diploma II\' then 1 else 0  end) as "Diploma II"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'Diploma III/Sarjana Muda\' then 1 else 0  end) as "Diploma III/Sarjana Muda"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'Diploma IV\' then 1 else 0  end) as "Diploma IV"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'S-1/Sarjana\' then 1 else 0  end) as "S-1/Sarjana"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'S-2\' then 1 else 0  end) as "S-2"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'S-3/Doktor\' then 1 else 0  end) as "S-3/Doktor"
				,sum(case when TEMPx."ID" is not null AND TEMPx."nama" = \'SLTA Keguruan\' then 1 else 0  end) as "SLTA Keguruan"
								FROM (
										select vw."ID",golongan."NAMA" as "golongan",tkpendidikan."NAMA" as "nama" from hris.golongan  
										left join hris.pegawai on golongan."ID" = pegawai."GOL_ID"
										left join vw_unit_list vw on pegawai."UNOR_ID"= vw."ID" '.$where_clause.'
										left join hris.pendidikan on pendidikan."ID" = pegawai."PENDIDIKAN_ID"
										left join hris.tkpendidikan on tkpendidikan."ID" = pendidikan."TINGKAT_PENDIDIKAN_ID"
										where 1=1 

			)AS TEMPx 
								group by TEMPx."golongan"
			order by TEMPx."golongan"	
		')->result('array');
		return $data;
	}
	public function get_rekap_jenis_kelamin_per_usia($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		$data = $this->db->query('
			select tempx."JENIS KELAMIN"
				,sum(CASE  WHEN tempx."ID" is not null AND age < 25 THEN 1 else 0 END) "<25"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 25  AND age <= 30 THEN 1 else 0  END) "25-30"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 31  AND age <= 35 THEN 1 else 0  END) "31-35"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 36  AND age <= 40 THEN 1 else 0  END) "36-40"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 41  AND age <= 45 THEN 1 else 0  END) "41-45"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 46  AND age <= 50 THEN 1 else 0  END) "46-50"
				,sum(CASE WHEN tempx."ID" is not null AND age > 50 THEN 1 else 0 END) ">50"
			from (
										select vw."ID",pegawai."JENIS_KELAMIN" as "JENIS KELAMIN",EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) age 
										from (select \'M\' as sex union select \'F\') as d
										left join hris.pegawai on  d.sex = pegawai."JENIS_KELAMIN"
										left join vw_unit_list vw on 1=1 and pegawai."UNOR_ID"= vw."ID" '.$where_clause.'
										WHERE 1=1
			) as tempx
			group by tempx."JENIS KELAMIN"

		')->result('array');
		return $data;
	}
	public function get_rekap_pendidikan_per_jenis_kelamin($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}

		$data = $this->db->query('
			select tempx."nama",sum(CASE  WHEN tempx."ID" is not null AND tempx.jenis_kelamin = \'M\' THEN 1 else 0 END) "M"
																,sum(CASE  WHEN tempx."ID" is not null AND tempx.jenis_kelamin = \'F\' THEN 1 else 0 END) "F"
																,sum(CASE  WHEN tempx."ID" is not null AND tempx.jenis_kelamin = null  THEN 1 else 0 END) "-"
			from (
										select vw."ID",tkpendidikan."NAMA" as "nama",pegawai."JENIS_KELAMIN" as "jenis_kelamin" 
										from hris.tkpendidikan 
										left join hris.pendidikan on tkpendidikan."ID" = pendidikan."TINGKAT_PENDIDIKAN_ID"
										left join hris.pegawai  on pendidikan."ID" = pegawai."PENDIDIKAN_ID" 
										left join vw_unit_list vw on pegawai."UNOR_ID"= vw."ID"  '.$where_clause.'
										WHERE 1=1 
			) as tempx
			group by tempx."nama"
		')->result('array');
		
		return $data;
	}
	public function get_rekap_pendidikan_per_usia ($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
		$data = $this->db->query('
			select tempx."TK PENDIDIKAN"
				,sum(CASE  WHEN tempx."ID" is not null AND age < 25 THEN 1 else 0 END) "<25"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 25  AND age <= 30 THEN 1 else 0  END) "25-30"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 31  AND age <= 35 THEN 1 else 0  END) "31-35"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 36  AND age <= 40 THEN 1 else 0  END) "36-40"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 41  AND age <= 45 THEN 1 else 0  END) "41-45"
				,sum(CASE  WHEN tempx."ID" is not null AND age >= 46  AND age <= 50 THEN 1 else 0  END) "46-50"
				,sum(CASE WHEN tempx."ID" is not null AND age > 50 THEN 1 else 0 END) ">50"
			from (
										select vw."ID",tkpendidikan."NAMA" as "TK PENDIDIKAN",EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) age 
										from hris.tkpendidikan 
										left join hris.pendidikan on tkpendidikan."ID" = pendidikan."TINGKAT_PENDIDIKAN_ID"
										left join hris.pegawai  on  pendidikan."ID" = pegawai."PENDIDIKAN_ID"
										left join vw_unit_list vw on 1=1 and pegawai."UNOR_ID"= vw."ID" '.$where_clause.'
										where 1=1 
			) as tempx
			group by tempx."TK PENDIDIKAN"

		')->result('array');
		return $data;
	}
	public function get_rekap_golongan_per_usia($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
			$data = $this->db->query('
			select TEMPx."nama" ,sum(CASE  WHEN TEMPX."ID" IS NOT NULL AND age < 25 THEN 1 ELSE 0 END) "<25"
								,sum(CASE  WHEN TEMPX."ID" IS NOT NULL AND age >= 25  AND age <= 30 THEN 1 else 0 END) "25-30"
								,sum(CASE  WHEN TEMPX."ID" IS NOT NULL AND age >= 31  AND age <= 35 THEN 1 else 0 END) "31-35"
								,sum(CASE  WHEN TEMPX."ID" IS NOT NULL AND age >= 36  AND age <= 40 THEN 1 else 0 END) "36-40"
								,sum(CASE  WHEN TEMPX."ID" IS NOT NULL AND age >= 41  AND age <= 45 THEN 1 else 0 END) "41-45"
								,sum(CASE  WHEN TEMPX."ID" IS NOT NULL AND age >= 46  AND age <= 50 THEN 1 else 0 END) "46-50"
								,sum(CASE WHEN TEMPX."ID" IS NOT NULL AND age > 50 THEN 1 else 0 END) ">50"
								FROM (
										select vw."ID",golongan."NAMA" as "nama",EXTRACT(YEAR FROM age(cast(pegawai."TGL_LAHIR" as date))) age from hris.golongan  
										left join hris.pegawai on  golongan."ID" = pegawai."GOL_ID"
										left join vw_unit_list vw on  pegawai."UNOR_ID"= vw."ID" '.$where_clause.'
										where 1=1
			)AS TEMPx 
								group by TEMPx."nama"
			order by TEMPx."nama"
		')->result('array');
		
		return $data;
	}
	public function get_jumlah_pegawai_per_agama_jeniskelamin($satker_id){
		$where_clause = '';
		if($satker_id){
			$where_clause = 'AND (vw."ESELON_1" = \''.$satker_id.'\' OR vw."ESELON_2" = \''.$satker_id.'\' OR vw."ESELON_3" = \''.$satker_id.'\' OR vw."ESELON_4" = \''.$satker_id.'\')' ;
		}
			$data = $this->db->query('
				SELECT
					pegawai."JENIS_KELAMIN" as "jenis_kelamin",
					agama."ID" as "id",
					agama."NAMA" as "nama",
					COUNT (vw."ID") AS total
				FROM
					hris.agama 
					LEFT JOIN hris.pegawai ON pegawai."AGAMA_ID" = agama."ID"
					left join vw_unit_list vw on pegawai."UNOR_ID"= vw."ID"   '.$where_clause.'
					where 1=1
				GROUP BY
					pegawai."JENIS_KELAMIN",
					agama."ID",
					agama."NAMA"
				ORDER BY
					agama."NAMA";
			')->result('array');
		$agamas = array('Budha','Hindu','Islam','Katholik','Protestan','Lainnya','Belum terdata');
		$output = array();
		foreach($agamas as $agama){
			if(isset($output[$agama])){
				$rec = new stdClass;
			}
			else {
				$rec = $output[$agama];
			}
			$rec->nama = $agama;
			$rec->m = 0;
			$rec->f = 0;
			foreach($data as $row){
				if($agama==$row['nama']){
					if($row['jenis_kelamin']=='M'){
						$rec->m =  $row['total'];
					}
					else if($row['jenis_kelamin']=='F'){
						$rec->f =  $row['total'];
					}
				}
				else if('Kristen'==$row['nama'] && $agama=='Protestan'){ 
					if($row['jenis_kelamin']=='M'){
						$rec->m =  $row['total'];
					}
					else if($row['jenis_kelamin']=='F'){
						$rec->f =  $row['total'];
					}
				}
				else if(null==$row['nama'] && $agama=='Belum terdata'){ 
					if($row['jenis_kelamin']=='M'){
						$rec->m =  $row['total'];
					}
					else if($row['jenis_kelamin']=='F'){
						$rec->f =  $row['total'];
					}
				}
			}
			$output[$agama] = $rec;
		}
		
		return array_values($output);
	}
	public function getunor_id($nip = ""){
		$where_clause = 'AND pegawai."NIP_BARU" = \''.trim($nip).'\'' ;
		$unor_id = "";
		$data = $this->db->query('
				SELECT
					"UNOR_ID" 
				FROM
					hris.pegawai
					 
					where 1=1 '.$where_clause.';
			')->result('array');
		foreach($data as $row){
			//echo "masuk bro";
			$unor_id = $row['UNOR_ID'];
		}
		return $unor_id;
	}
}