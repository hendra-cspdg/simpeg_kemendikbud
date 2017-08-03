<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * reports controller
 */
class rekap extends Admin_Controller
{

	//--------------------------------------------------------------------

	public $satker_id= null;
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pegawai/pegawai_model', null, true);
		$this->load->model('golongan/golongan_model', null, true);
		$this->load->model('pegawai/unitkerja_model');
		Template::set_block('sub_nav', 'reports/_sub_nav');
		Assets::add_module_js('dashboard', 'dashboard.js');

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
		
		Template::render();
	}
	public function bup_usia(){
		$data_bup_per_range_umur = $this->pegawai_model->get_bup_per_range_umur($this->satker_id); 
		$index = 0;
		foreach($data_bup_per_range_umur as &$row){
			$row->color = $colors[$index];
			$index++;
		}
		Template::set('data_bup_per_range_umur', $data_bup_per_range_umur);
		Template::set_view('rekap/bup_usia');
		Template::render();
	}
	public function golongan_usia(){
		$data_rekap_golongan_per_usia = $this->pegawai_model->get_rekap_golongan_per_usia($this->satker_id);
		Template::set('data_rekap_golongan_per_usia', $data_rekap_golongan_per_usia);		
		Template::set_view('rekap/golongan_usia');
		Template::render();
	} 
	public function gender_usia(){
		$data_rekap_jenis_kelamin_per_usia = $this->pegawai_model->get_rekap_jenis_kelamin_per_usia($this->satker_id);
		
		Template::set('data_rekap_jenis_kelamin_per_usia', $data_rekap_jenis_kelamin_per_usia);
		
		Template::set_view('rekap/gender_usia');
		Template::render();
	} 
	public function pendidikan_usia(){
		$data_rekap_pendidikan_per_usia = $this->pegawai_model->get_rekap_pendidikan_per_usia($this->satker_id);
		Template::set('data_rekap_pendidikan_per_usia', $data_rekap_pendidikan_per_usia);
	
		Template::set_view('rekap/pendidikan_usia');
		Template::render();
	} 
	public function golongan_gender(){
		$data_rekap_golongan_per_jenis_kelamin = $this->pegawai_model->get_rekap_golongan_per_jenis_kelamin($this->satker_id);
		Template::set('data_rekap_golongan_per_jenis_kelamin', $data_rekap_golongan_per_jenis_kelamin);
	
		Template::set_view('rekap/golongan_gender');
		Template::render();
	} 
	public function golongan_pendidikan(){
		$data_rekap_golongan_per_pendidikan = $this->pegawai_model->get_rekap_golongan_per_pendidikan($this->satker_id);
		Template::set('data_rekap_golongan_per_pendidikan', $data_rekap_golongan_per_pendidikan);
	
		Template::set_view('rekap/golongan_pendidikan');
		Template::render();
	} 
	public function pendidikan_gender(){
		$data_rekap_pendidikan_per_jenis_kelamin = $this->pegawai_model->get_rekap_pendidikan_per_jenis_kelamin($this->satker_id);
		Template::set('data_rekap_pendidikan_per_jenis_kelamin', $data_rekap_pendidikan_per_jenis_kelamin);

	
		Template::set_view('rekap/pendidikan_gender');
		Template::render();
	} 
	public function agama_gender(){
		$data_jumlah_pegawai_per_agama_jeniskelamin = $this->pegawai_model->get_jumlah_pegawai_per_agama_jeniskelamin($this->satker_id);
		Template::set('data_jumlah_pegawai_per_agama_jeniskelamin', $data_jumlah_pegawai_per_agama_jeniskelamin);
	
		Template::set_view('rekap/agama_gender');
		Template::render();
	} 	
}