<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * reports controller
 */
class reports extends Admin_Controller
{

	//--------------------------------------------------------------------
	public $satker_id = null;
	protected $CI;
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->CI = &get_instance();
		$this->lang->load('dashboard');
		Template::set_block('sub_nav', 'reports/_sub_nav');
		Assets::add_module_js('dashboard', 'dashboard.js');
		$this->load->model('pegawai/unitkerja_model');
		$unit_id = $this->input->get("unit_id");
		
		if($unit_id){
			$satker = $this->unitkerja_model->find_unit('',$unit_id);
			
			$nama_unor = array();
			$this->satker_id= $satker->ID;
			
			Template::set('selectedSatker', $satker);
			
		}
	}
	//--------------------------------------------------------------------
	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->auth->restrict('Dashboard.Reports.View');
		$this->load->model('pegawai/pegawai_model', null, true);
		$this->load->model('golongan/golongan_model', null, true);
		
		$recsatker = $this->unitkerja_model->count_satker();
		Template::set('jmlsatker', $recsatker[0]->jumlah ? $recsatker[0]->jumlah : 0);
		// jml pegawai
		$total= $this->pegawai_model->count_all();
		Template::set('totalpegawai', $total);
		$jmlpensiun = $this->pegawai_model->count_pensiun($this->satker_id); 
		Template::set('jmlpensiun', $jmlpensiun);

		
		
		$jsonpendidikan = array();
		$recordpendidikan = $this->pegawai_model->grupbypendidikan($this->satker_id); 
		$dataprov = array();
		if (isset($recordpendidikan) && is_array($recordpendidikan) && count($recordpendidikan)) :
			foreach ($recordpendidikan as $record) :
				if($record->NAMA_PENDIDIKAN != "")
					$dataprov["NAMA"] = $record->NAMA_PENDIDIKAN;
				else
					$dataprov["NAMA"] = "-";
				$dataprov["jumlah"] = $record->jumlah;
				$jsonpendidikan[] 	= $dataprov;
			endforeach;
		endif;
		Template::set('jsonpendidikan', json_encode($jsonpendidikan));
		
		if($this->CI->auth->role_id() =="5"){
			$this->db->where("(unitkerja.ID = '".$this->UNOR_ID."' or unitkerja.ESELON_1 = '".$this->UNOR_ID."' or unitkerja.ESELON_2 = '".$this->UNOR_ID."' or unitkerja.ESELON_3 = '".$this->UNOR_ID."' or unitkerja.ESELON_4 = '".$this->UNOR_ID."')");
		}
		$recordumur = $this->pegawai_model->group_by_range_umur($this->satker_id);
		
		$colors=    array('#FCD202', '#B0DE09','#FF6600', '#0D8ECF', '#2A0CD0', '#CD0D74', '#CC0000', '#00CC00', '#0000CC', '#DDDDDD', '#999999', '#333333', '#990000');
		$ajsonumur = array();
		$index = 0 ;
		foreach(array_keys($recordumur[0]) as $key){
			$jsonumur = array("color"=>$colors[$index],"label"=>$key,"jumlah"=>isset($recordumur[0][$key]) ? $recordumur[0][$key] : 0);
			$ajsonumur[] 	= $jsonumur;
			$index++;
		}
		
		Template::set('jsonumur', json_encode($ajsonumur));
		
		// agama
		$agamas = $this->pegawai_model->find_grupagama($this->satker_id);
		Template::set('agamas', $agamas);
		
		// jenis kelamin
		$jks = $this->pegawai_model->grupbyjk($this->satker_id);
		$jsonjk = array();
		$datajk = array();
		if (isset($jks) && is_array($jks) && count($jks)) :
			foreach ($jks as $record) :
				if($record->JENIS_KELAMIN != "")
					$datajk["Jenis_Kelamin"] = $record->JENIS_KELAMIN;
				else
					$datajk["Jenis_Kelamin"] = "Belum ditentukan";
				$datajk["jumlah"] = $record->jumlah;
				$jsonjk[] 	= $datajk;
			endforeach;
		endif;
		Template::set('jsonjk', json_encode($jsonjk));
		// pensiun pertahun
		// belum di kasih filter buat role executive
		$pensiuntahun = $this->pegawai_model->stats_pensiun_pertahun($this->satker_id);
		
		$index = 0;
		foreach($pensiuntahun as &$row){
			$row['color'] = $colors[$index];
			$index++;
		}
		Template::set('jsonpensiuntahun', json_encode($pensiuntahun));
		
		// rekap_pangkat_golongan
		$data_jumlah_pegawai_per_golongan = $this->pegawai_model->get_jumlah_pegawai_per_golongan($this->satker_id);
		
		$index = 0;
		foreach($data_jumlah_pegawai_per_golongan as &$row){
			$row['color'] = $colors[$index];
			$index++;
		}
		Template::set('data_jumlah_pegawai_per_golongan', json_encode($data_jumlah_pegawai_per_golongan));
		
		
		Template::render();
	}
	 
}