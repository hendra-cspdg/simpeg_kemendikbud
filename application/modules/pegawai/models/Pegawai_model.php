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
			'rules' => 'max_length[11]',
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
    public function __construct()
    {
        parent::__construct();
    }
	public function find_first_row(){
		return $this->db->get($this->db->schema.".".$this->table_name)->first_row();
	}
	public function count_all() {
		$this->db->join("unitkerja","pegawai.UNOR_ID=unitkerja.ID", 'left');
		return parent::count_all();
	}
	public function find_all(){
		$this->db->select('pegawai.*,unitkerja."NAMA_UNOR",unitkerja."ID" as "UNIT_ID" ',false);
		$this->db->join("unitkerja","pegawai.UNOR_ID=unitkerja.ID", 'left');
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
	public function find_grupagama($eselon2 ="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.AGAMA_ID,agama.NAMA AS label,count(pegawai."AGAMA_ID") as value');
		}
		if($eselon2 != ""){
			$this->db->where('"UNOR_ID" LIKE \''.strtoupper($eselon2).'%\'');
		}
		$this->db->group_by("AGAMA_ID");
		$this->db->group_by("agama.NAMA");
		$this->db->join('agama', 'pegawai.AGAMA_ID = agama.ID', 'left');
		return parent::find_all();
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
	public function grupbypendidikan()
	{
		 
		if(empty($this->selects))
		{
			$this->select('tkpendidikan.NAMA as NAMA_PENDIDIKAN,count("PENDIDIKAN_ID") as jumlah');
		}
		$this->db->join('pendidikan', 'pegawai.PENDIDIKAN_ID = pendidikan.ID', 'left');
		$this->db->join('tkpendidikan', 'pendidikan.TINGKAT_PENDIDIKAN_ID = tkpendidikan.ID', 'left');
		$this->db->group_by('tkpendidikan.NAMA');
		$this->db->group_by('tkpendidikan.ID');
		$this->db->order_by('tkpendidikan.ID',"ASC");
		return parent::find_all();
	}
	public function grupbyjk()
	{
		 
		if(empty($this->selects))
		{
			$this->select('pegawai.JENIS_KELAMIN,count(pegawai."JENIS_KELAMIN") as jumlah');
		}
		$this->db->group_by('pegawai.JENIS_KELAMIN');
		return parent::find_all();
	}
	public function count_pensiun(){
		$this->db->select('pegawai.*');
		$this->db->where('EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) > 58');
		return parent::count_all();
	}
	public function find_all_pensiun(){
		$this->db->select('pegawai.*,unitkerja."NAMA_UNOR",EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) as umur');
		$this->db->where('EXTRACT(YEAR FROM age(cast("TGL_LAHIR" as date))) > 58');
		$this->db->join("unitkerja","pegawai.UNOR_ID=unitkerja.ID", 'left');
		return parent::find_all();
	}
	public function find_pentiunpertahun(){
		$this->db->select('EXTRACT(YEAR FROM "TMT_PENSIUN") TAHUN,count("ID") as jumlah');
		$this->db->where('TMT_PENSIUN IS NOT NULL');
		$this->db->group_by('EXTRACT(YEAR FROM "TMT_PENSIUN")');
		return parent::find_all();
	}
	public function stats_pensiun_pertahun($tahun_kedepan=5){
		$db_stats =$this->db->query('
			select perkiraan_tahun_pensiun,count(*)
				as total from (
				select "TGL_LAHIR","NIP_BARU","BUP","NAMA", date_part(\'year\', "TGL_LAHIR")+"BUP" as perkiraan_tahun_pensiun from hris.pegawai
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
		if($unit_id){
			$this->load->model("pegawai/unitkerja_model");
			$this->unitkerja_model->where("ID",$unit_id);
			$unor_data = $this->unitkerja_model->find_first_row();
			
			$ids  = array();
			if($unor_data){
				$this->unitkerja_model->getChildren($unor_data->ID ,$ids,$onlyID = true,$include_sub=TRUE,$includeMe=true,$first=true);
			}
			
			$total = $this->db->from("hris.pegawai peg")->join("hris.unitkerja uk","peg.UNOR_ID=uk.ID","LEFT")->where_in("uk.\"ID\"",$ids)->get()->num_rows();
			$data = $this->db->query('
				SELECT
					* FROM duk_list 
					
					where "UNITKERJA_ID" in ?					
					LIMIT ? OFFSET ?
			',array($ids,$length,$start))->result();
			
			$output = new stdClass;
			$output->total = $total;
			$output->data = $data;
		}
		else {
			$total = $this->db->from("hris.pegawai")->get()->num_rows();
			$data = $this->db->query('
				SELECT
					* FROM duk_list 				
					LIMIT ? OFFSET ?
			',array($length,$start))->result();
			
			$output = new stdClass;
			$output->total = $total;
			$output->data = $data;
		}
		
		return  $output;
	}	

	public function get_jumlah_pegawai_per_golongan(){
		return $this->db->query('
			select golongan."ID" as "id",golongan."NAMA" as "nama",count(*) as total from hris.golongan
			left join hris.pegawai on  golongan."ID" = pegawai."GOL_ID"
			group by golongan."ID",golongan."NAMA"
			order by golongan."ID" asc 
		')->result('array');
	}

	public function get_jumlah_pegawai_per_agama_jeniskelamin(){
		$data = $this->db->query('
			SELECT
				pegawai."JENIS_KELAMIN" as "jenis_kelamin",
				agama."ID" as "id",
				agama."NAMA" as "nama",
				COUNT (*) AS total
			FROM
				(
					hris.pegawai
					LEFT JOIN hris.agama ON (
						(
							pegawai."AGAMA_ID" = agama."ID"
						)
					)
				)
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
}