<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * reports controller
 */
class rekap extends Admin_Controller
{

	//--------------------------------------------------------------------


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
		
		
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("IDx",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		Template::render();
	}
	public function bup_usia(){
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		$data_bup_per_range_umur = $this->pegawai_model->get_bup_per_range_umur($satker_id); 
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
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		$data_rekap_golongan_per_usia = $this->pegawai_model->get_rekap_golongan_per_usia($satker_id);
		Template::set('data_rekap_golongan_per_usia', $data_rekap_golongan_per_usia);		
		Template::set_view('rekap/golongan_usia');
		Template::render();
	} 
	public function gender_usia(){
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		$data_rekap_jenis_kelamin_per_usia = $this->pegawai_model->get_rekap_jenis_kelamin_per_usia($satker_id);
		Template::set('data_rekap_jenis_kelamin_per_usia', $data_rekap_jenis_kelamin_per_usia);
		
		Template::set_view('rekap/gender_usia');
		Template::render();
	} 
	public function pendidikan_usia(){
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		$data_rekap_pendidikan_per_usia = $this->pegawai_model->get_rekap_pendidikan_per_usia($satker_id);
		Template::set('data_rekap_pendidikan_per_usia', $data_rekap_pendidikan_per_usia);
	
		Template::set_view('rekap/pendidikan_usia');
		Template::render();
	} 
	public function golongan_gender(){
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		$data_rekap_golongan_per_jenis_kelamin = $this->pegawai_model->get_rekap_golongan_per_jenis_kelamin($satker_id);
		Template::set('data_rekap_golongan_per_jenis_kelamin', $data_rekap_golongan_per_jenis_kelamin);
	
		Template::set_view('rekap/golongan_gender');
		Template::render();
	} 
	public function golongan_pendidikan(){
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		$data_rekap_golongan_per_pendidikan = $this->pegawai_model->get_rekap_golongan_per_pendidikan($satker_id);
		Template::set('data_rekap_golongan_per_pendidikan', $data_rekap_golongan_per_pendidikan);
	
		Template::set_view('rekap/golongan_pendidikan');
		Template::render();
	} 
	public function pendidikan_gender(){
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		$data_rekap_pendidikan_per_jenis_kelamin = $this->pegawai_model->get_rekap_pendidikan_per_jenis_kelamin($satker_id);
		Template::set('data_rekap_pendidikan_per_jenis_kelamin', $data_rekap_pendidikan_per_jenis_kelamin);

	
		Template::set_view('rekap/pendidikan_gender');
		Template::render();
	} 
	public function agama_gender(){
		$unit_id = $this->input->get("unit_id");
		$satker_id = null;
		if($unit_id){
			$this->unitkerja_model->where("ID",$unit_id);
			$satker = $this->unitkerja_model->find_first_row();
			$satker_id = $satker->ID;
			Template::set('selectedSatker', $satker);
			
		}
		$data_jumlah_pegawai_per_agama_jeniskelamin = $this->pegawai_model->get_jumlah_pegawai_per_agama_jeniskelamin($satker_id);
		Template::set('data_jumlah_pegawai_per_agama_jeniskelamin', $data_jumlah_pegawai_per_agama_jeniskelamin);
	
		Template::set_view('rekap/agama_gender');
		Template::render();
	} 	
}